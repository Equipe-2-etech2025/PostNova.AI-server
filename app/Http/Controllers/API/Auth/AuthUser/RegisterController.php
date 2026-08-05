<?php

namespace App\Http\Controllers\API\Auth\AuthUser;

use App\DTOs\TarifUser\TarifUserDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\Interfaces\TarifUserServiceInterface;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Swift_SmtpTransport;

class RegisterController extends Controller
{
    protected TarifUserServiceInterface $tarifUserService;

    public function __construct(TarifUserServiceInterface $tarifUserService)
    {
        $this->tarifUserService = $tarifUserService;
    }

    public function __invoke(RegisterRequest $request): JsonResponse
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => User::ROLE_USER,
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            $tarifUserDto = new TarifUserDto(
                null,
                1,
                $user->id,
                now(),
                null,
            );
            $this->tarifUserService->createTarifUser($tarifUserDto);

            $emailSent = $this->sendVerificationEmailWithFreshConnection($user);

            Log::info('Nouvel utilisateur inscrit', [
                'user_id' => $user->id,
                'email_sent' => $emailSent
            ]);

            return response()->json([
                'success' => true,
                'message' => $emailSent
                    ? 'Inscription réussie. Un email de vérification vous a été envoyé.'
                    : 'Inscription réussie.',
                'data' => [
                    'user' => new UserResource($user),
                    'token' => $token,
                    'token_type' => 'Bearer',
                    'email_sent' => $emailSent,
                ],
            ], 201);

        } catch (\Exception $e) {
            Log::error('Erreur inscription', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'inscription: ' . $e->getMessage(),
            ], 500);
        }
    }

    private function sendVerificationEmailWithFreshConnection(User $user): bool
    {
        try {
            $config = config('mail.mailers.smtp');
            
            $transport = new Swift_SmtpTransport(
                $config['host'],
                $config['port'],
                $config['encryption'] ?? 'tls'
            );
            $transport->setUsername($config['username']);
            $transport->setPassword($config['password']);
            $transport->setTimeout(30);
            $transport->setLocalDomain(config('mail.ehlo_domain', 'render.com'));
            
            $mailer = new \Swift_Mailer($transport);
            
            $message = (new \Swift_Message('Vérification de votre email'))
                ->setFrom([
                    config('mail.from.address') => config('mail.from.name')
                ])
                ->setTo([$user->email => $user->name])
                ->setBody(
                    view('emails.verify', ['user' => $user])->render(),
                    'text/html'
                );
            
            $result = $mailer->send($message);
            
            $transport->stop();
            
            Log::info('Email envoyé avec connexion fraîche', [
                'user_id' => $user->id,
                'email' => $user->email,
                'result' => $result
            ]);
            
            return true;

        } catch (\Exception $e) {
            Log::warning('Échec envoi email avec connexion fraîche', [
                'user_id' => $user->id,
                'email' => $user->email,
                'error' => $e->getMessage()
            ]);
            
            return $this->sendVerificationEmailStandard($user);
        }
    }

    private function sendVerificationEmailStandard(User $user): bool
    {
        try {
            event(new Registered($user));
            
            Log::info('Email envoyé via méthode standard', [
                'user_id' => $user->id
            ]);
            
            return true;
            
        } catch (\Exception $e) {
            Log::warning('Échec envoi email standard', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);
            
            return false;
        }
    }
}