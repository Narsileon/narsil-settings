<?php

#region USE

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Narsil\Settings\Models\Setting;

#endregion

return new class extends Migration
{
    #region MIGRATIONS

    /**
     * @return void
     */
    public function up(): void
    {
        $this->createSettingsTable();
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(Setting::TABLE);
    }

    #endregion

    #region TABLES

    /**
     * @return void
     */
    private function createSettingsTable(): void
    {
        if (Schema::hasTable(Setting::TABLE))
        {
            return;
        }

        Schema::create(Setting::TABLE, function (Blueprint $table)
        {
            $table
                ->string(Setting::KEY)
                ->primary();
            $table
                ->json(Setting::VALUE);
            $table
                ->timestamps();
        });
    }

    #endregion
};
