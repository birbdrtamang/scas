<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remarks extends Model
{
    use HasFactory;
    protected $table = "Remarks";
    public $timestamps = false;

    protected $fillable = [
        'docID',
        'content',
        'auditor',
        'date'
    ];
}
