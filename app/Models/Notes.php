<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    protected $table = 'notes';
    protected $fillable = ['student_id', 'note'];

    public function students()
    {
        return $this->belongsTo(Student::class);
    }
}
