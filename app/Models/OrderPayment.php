<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function course()
    {
        return $this->hasMany(Course::class, 'course_id');
    }

    public function user()
    {
        return $this->hasMany(User::class, 'user_id');
    }
}
