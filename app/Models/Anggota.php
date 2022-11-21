<?php

namespace App\Models;

use App\Models\Regency;
use App\Models\Village;
use App\Models\District;
use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';
    protected $guarded = [];

    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
