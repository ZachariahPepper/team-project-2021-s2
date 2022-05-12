<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
    protected $table = 'evidence';
    protected $fillable = ['student_id', 'url', 'title', 'description', 'file'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
