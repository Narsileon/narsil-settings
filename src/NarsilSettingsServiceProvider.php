<?php

namespace Narsil\Settings;

#region USE

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Narsil\Settings\Models\Setting;
use Narsil\Settings\Policies\SettingPolicy;

#endregion

/**
 * @version 1.0.0
 *
 * @author Jonathan Rigaux
 */
final class NarsilSettingsServiceProvider extends ServiceProvider
{
    #region PUBLIC METHODS

    /**
     * @return void
     */
    public function boot(): void
    {
        $this->bootMigrations();
        $this->bootPolicies();
    }

    #endregion

    #region PRIVATE METHODS

    /**
     * @return void
     */
    private function bootMigrations(): void
    {
        $this->loadMigrationsFrom([
            __DIR__ . '/../database/migrations',
        ]);
    }

    /**
     * @return void
     */
    private function bootPolicies(): void
    {
        Gate::policy(Setting::class, SettingPolicy::class);
    }

    #endregion
}
