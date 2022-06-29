<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairService extends Model
{
    use HasFactory;
    protected $fillable=['name','description','parent_id'];

    public function children()
    {
        return $this->hasMany(self::class,'parent_id','id');
    }
    public function parent()
    {
        return $this->belongsTo(self::class,'parent_id','id');
    }
    public function repairmen()
    {
        return $this->belongsToMany(Repairman::class);
    }
}
