<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashDisbursement extends Model
{
    use HasFactory;
    protected $table = "CashDisbursement";
    public $timestamps = false;

    protected $fillable = [
        'openingBalance',
        'date',
        'desc',
        'inflow',
        'outflow',
        'balance',
        'docs',
        'status',
        'club'
    ];
}
