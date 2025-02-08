<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Engineer extends Model
{
    use HasFactory;

    // تحديد اسم الجدول (اختياري إذا كان اسم الجدول هو الجمع التلقائي "engineers")
    protected $table = 'engineers';

    // الحقول القابلة للتعبئة (fillable) التي يمكن تحديثها عبر الـ Mass Assignment
    protected $fillable = [
        'user_id',
        'engineering_field',
        'license_number',
    ];

    // العلاقة مع موديل الـ User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
