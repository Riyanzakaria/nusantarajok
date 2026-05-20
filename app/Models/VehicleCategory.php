<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleCategory extends Model
{
    protected $fillable = ['name', 'slug'];

    public function pricelists()
    {
        return $this->hasMany(SettingsPricelist::class);
    }
}
