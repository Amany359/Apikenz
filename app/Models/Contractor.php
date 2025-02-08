<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    use HasFactory;

    // اسم الجدول
    protected $table = 'contractors';

    // الحقول القابلة للملء (mass assignable)
    protected $fillable = [
        'user_id',
        'company_name',
        'specialization',
    ];

    // العلاقة مع جدول users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

