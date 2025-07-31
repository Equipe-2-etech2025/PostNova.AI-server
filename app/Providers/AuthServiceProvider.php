<?php
namespace App\Providers;

use App\Models\CampaignFeatures;
use App\Models\Features;
use App\Models\Prompt;
use App\Models\Social;
use App\Models\SocialPost;
use App\Models\Tarif;
use App\Models\TarifFeature;
use App\Models\TarifUser;
use App\Models\TypeCampaign;
use App\Policies\CampaignFeaturesPolicy;
use App\Policies\ImagePolicy;
use App\Policies\LandingPagePolicy;
use App\Policies\PromptPolicy;
use App\Policies\SocialPostPolicy;
use App\Policies\TarifFeaturePolicy;
use App\Policies\TarifPolicy;
use App\Policies\TarifUserPolicy;
use App\Policies\TypeCampaignPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Campaign;
use App\Policies\CampaignPolicy;
use App\Policies\SocialPolicy;
use App\Policies\FeaturesPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Campaign::class => CampaignPolicy::class,
        Social::class => SocialPolicy::class,
        Features::class => FeaturesPolicy::class,
        TypeCampaign::class => TypeCampaignPolicy::class,
        Tarif::class => TarifPolicy::class,
        CampaignFeatures::class => CampaignFeaturesPolicy::class,
        TarifFeature::class => TarifFeaturePolicy::class,
        TarifUser::class => TarifUserPolicy::class,
        SocialPost::class => SocialPostPolicy::class,
        LandingPagePolicy::class => LandingPagePolicy::class,
        ImagePolicy::class => ImagePolicy::class,
        Prompt::class => PromptPolicy::class,

    ];
    public function boot(): void
    {
        $this->registerPolicies();
    }
}

