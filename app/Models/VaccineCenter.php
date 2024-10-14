<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineCenter extends Model
{
    use HasFactory;

    protected $table = 'vaccine_center';

    public function district()
    {
        return $this->hasOne(District::class, 'id', 'district_id');
    }

    public function upazila()
    {
        return $this->hasOne(Upazila::class, 'id', 'upazila_id');
    }

    public function union()
    {
        return $this->hasOne(Union::class, 'id', 'union_id');
    }

    public function createdBy()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function updatedBy()
    {
        return $this->hasOne(User::class, 'id', 'updated_by');
    }
}
