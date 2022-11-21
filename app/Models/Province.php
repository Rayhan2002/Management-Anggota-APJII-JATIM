<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace App\Models;

use App\Models\Anggota;
use App\Models\Regency;
use Illuminate\Database\Eloquent\Model;
use AzisHapidin\IndoRegion\Traits\ProvinceTrait;

/**
 * Province Model.
 */
class Province extends Model
{
    use ProvinceTrait;
    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'provinces';

    protected $guard = [];

    /**
     * Province has many regencies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function anggotas()
    {
        return $this->hasMany(Anggota::class);
    }

    public function regencies()
    {
        return $this->hasMany(Regency::class);
    }
}
