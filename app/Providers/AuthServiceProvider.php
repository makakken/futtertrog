<?php

namespace App\Providers;

use App\Meal;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Order' => 'App\Policies\OrderPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            if ($ability === 'order') {
                return null;
            }

            if ($user->is_admin) {
                return true;
            }
        });

        Gate::define('order', function (User $user, Meal $meal) {
            return $meal->date > today();
        });
    }
}
