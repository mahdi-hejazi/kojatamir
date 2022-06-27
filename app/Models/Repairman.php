<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repairman extends Model
{
    use HasFactory;
    protected $fillable=['profile_description'];
    protected $casts = [
        'images' => 'array'
    ];

    public function repairServices()
    {
        return $this->belongsToMany(RepairService::class);
    }

    public function businessLicenses(){
        return $this->hasMany(BusinessLicense::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }
}
