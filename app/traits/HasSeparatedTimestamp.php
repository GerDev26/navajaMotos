<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasSeparatedTimestamp
{
    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => date('Y-m-d', strtotime($attributes['timestamp'])),
            set: fn ($value, $attributes) => date('Y-m-d H:i:s', strtotime($value . ' ' . ($attributes['time'] ?? '00:00:00')))
        );
    }

    protected function time(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => date('H:i:s', strtotime($attributes['timestamp'])),
            set: fn ($value, $attributes) => date('Y-m-d H:i:s', strtotime(($attributes['date'] ?? now()->format('Y-m-d')) . ' ' . $value))
        );
    }
}
