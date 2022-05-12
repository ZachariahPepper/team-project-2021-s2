<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $fillable = ['course_id', 'name', 'email', 'github'];

    public function evidence(){
        return $this->hasMany(Evidence::class);
    }
    
    public function notes(){
        return $this->hasMany(Notes::class);
    }

    public function courses()
    {
        return $this->belongsTo(Course::class);
    }
}
