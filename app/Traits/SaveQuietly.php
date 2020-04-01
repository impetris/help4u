<?php


namespace App\Traits;


trait SaveQuietly
{
    public function saveQuietly(array $options = [])
    {
        return static::withoutEvents(function () use ($options) {
            return $this->save($options);
        });
    }
}
