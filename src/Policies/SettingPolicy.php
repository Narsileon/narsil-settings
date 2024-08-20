<?php

namespace Narsil\Settings\Policies;

#region USE

use Narsil\Policies\Policies\AbstractPolicy;
use Narsil\Settings\Models\Setting;

#endregion

/**
 * @version 1.0.0
 *
 * @author Jonathan Rigaux
 */
final class SettingPolicy extends AbstractPolicy
{
    #region CONSTRUCTOR

    /**
     * @return void
     */
    public function __construct()
    {
        parent::__construct(
            Setting::class,
            canCreate: false,
            canDelete: false,
        );
    }

    #endregion
}
