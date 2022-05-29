<?php

namespace App\Models;

use App\Models\Services\StudentService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function Service(): StudentService
    {
        return new StudentService($this);
    }
}
