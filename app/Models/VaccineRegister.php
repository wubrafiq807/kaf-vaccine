<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccineRegister extends Model
{
    use HasFactory;

    protected $appends = ['create_date', 'update_date'];

    protected $fillable = ['scheduled_at'];


    protected $table = 'vaccine_register';

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function center(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(VaccineCenter::class, 'center_id', 'id');
    }

    public function getUpdateDateAttribute()
    {
        return $this->updated_at->format(config('static.date_format')) ?? '';
    }

    public function getCreateDateAttribute()
    {
        return $this->created_at->format(config('static.date_format')) ?? '';
    }
}
