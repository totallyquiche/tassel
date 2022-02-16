<?php declare(strict_types = 1);

namespace App\Traits;

use Illuminate\Support\Str;

trait HasUuidPrimaryKey
{
    /**
     * Set a UUID as the primary key when creating a model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(
            function ($model)
            {
                $key_name = $model->getKeyName();
                $model->{$key_name} = Str::uuid()->toString();
                // if (empty($model->{$key_name}))
                // {
                //     $model->{$key_name} = Str::uuid()->toString();
                // }
            }
        );
    }

    /**
     * Preventing Laravel from trying to increment the primary ID since it is a
     * string.
     *
     * @return bool
     */
    public function getIncrementing() : bool
    {
        return false;
    }

    /**
     * Tell Laravel that the primary key is a string.
     *
     * @return string
     */
    public function getKeyType() : string
    {
        return 'string';
    }
}
