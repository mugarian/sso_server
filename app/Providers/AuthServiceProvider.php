<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Laravel\Passport\Passport;
use App\Models\Passport as ModelsPassport;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // if (!$this->app->routesAreCached()) {
        //     Passport::routes();
        // }

        Passport::tokensExpireIn(now()->addDays(1));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        Passport::tokensCan([
            'view-user' => "View User Information",
        ]);

        Passport::useClientModel(ModelsPassport::class);

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->greeting('Halo!')
                ->subject('Verifikasi Email Address SSO Polsub')
                ->line('Klik Tombol di bawah ini untuk verifikasi email address yang dimaksud.')
                ->action('Verify Email Address', $url)
                ->line('Jika terdapat masalah terkait verifikasi email akun. Silahkan hubungi bagian UPT TIK');
        });
    }
}
