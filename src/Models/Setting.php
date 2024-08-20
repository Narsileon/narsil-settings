<?php

namespace Narsil\Settings\Models;

#region USE

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

#endregion

/**
 * @version 1.0.0
 *
 * @author Jonathan Rigaux
 */
class Setting extends Model
{
    #region CONSTRUCTOR

    /**
     * @param array $attributes
     *
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->table = self::TABLE;

        $this->casts = [
            self::VALUE => 'json',
        ];

        $this->fillable = [
            self::KEY,
            self::VALUE,
        ];

        $this->incrementing = false;

        $this->primaryKey = self::KEY;

        parent::__construct($attributes);
    }

    #endregion

    #region CONSTANTS

    /**
     * @var string
     */
    final public const KEY = 'key';
    /**
     * @var string
     */
    final public const VALUE = 'value';

    /**
     * @var string
     */
    final public const TABLE = 'settings';

    #endregion

    #region PUBLIC METHODS

    /**
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    final public static function get(string $key, $default = null): mixed
    {
        return Cache::rememberForever(self::TABLE . ".$key", function () use ($key, $default)
        {
            $setting = self::find($key);

            return $setting ? $setting->{self::VALUE} : $default;
        });
    }

    /**
     * @param string $key
     * @param mixed $value
     *
     * @return void
     */
    final public static function set(string $key, $value): void
    {
        $setting = self::updateOrCreate([
            self::KEY => $key
        ], [
            self::VALUE => $value
        ]);

        Cache::forever(self::TABLE . ".$key", $value);
    }

    #endregion
}
