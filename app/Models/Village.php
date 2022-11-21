<?php

/*
 * This file is part of the IndoRegion package.
 *
 * (c) Azis Hapidin <azishapidin.com | azishapidin@gmail.com>
 *
 */

namespace App\Models;

use App\Models\Anggota;
use App\Models\District;
use Illuminate\Database\Eloquent\Model;
use AzisHapidin\IndoRegion\Traits\VillageTrait;

/**
 * Village Model.
 */
class Village extends Model
{
    use VillageTrait;

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'villages';
    protected $guard = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'district_id'
    ];

	/**
     * Village belongs to District.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function anggotas()
    {
        return $this->hasMany(Anggota::class);
    }
    
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
