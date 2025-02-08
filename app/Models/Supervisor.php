<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;

    // جدول المشرفين
    protected $table = 'supervisors';

    // الحقول القابلة للملء (mass assignable)
    protected $fillable = [
        'user_id', 
        'department',
    ];

    // علاقة supervisor مع user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
