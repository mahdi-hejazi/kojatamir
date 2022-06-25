<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProvinceCity extends Model
{
    use HasFactory;
    protected $fillable =['name'];
    public function cities()
    {
        return $this->hasMany(ProvinceCity::class,'parent_id','id');
    }
    public function province()
    {
        return $this->belongsTo(ProvinceCity::class,'parent_id','id');
    }
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

}
