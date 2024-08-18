<?php

namespace Narsil\Settings;

#region USE

use Illuminate\Support\ServiceProvider;

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

    #endregion
}
