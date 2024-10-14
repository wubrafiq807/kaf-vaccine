<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $table = 'districts';

    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        return $this->bn_name.' - '.$this->name;
    }
}
