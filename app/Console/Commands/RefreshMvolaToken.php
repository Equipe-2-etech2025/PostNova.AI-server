<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class RefreshMvolaToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mvola:refresh-mvola-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh and cache the MVola access token';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $baseUrl = config('services.mvola.base_url');
        $clientId = config('services.mvola.client_id');
        $clientSecret = config('services.mvola.client_secret');
        $scope = config('services.mvola.scope');

        $response = Http::asForm()->post("{$baseUrl}/oauth2/token", [
            "grant_type" => "client_credentials",
            "client_id" => $clientId,
            "client_secret" => $clientSecret,
            "scope" => $scope,
        ]);

        if ($response->failed()) {
            $this->error("MVola authentication failed: " . $response->body());
            return 1;
        }

        $data = $response->json();
        cache()->put('mvola_access_token', $data['access_token'], $data['expires_in'] - 60);

        $this->info("✅ MVola token refreshed successfully");
        return 0;
    }
}
