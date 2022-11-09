<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeReports extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignmentId',
        'report',
    ];
}
