<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CashDisbursement;

class GraphController extends Controller
{
    function barGraph(){
        $cashDisbursements = CashDisbursement::all();
        $data = $cashDisbursements->map(function($cashDisbursement){
            return [
                'id'=>$cashDisbursement->id,
                'inflow'=>$cashDisbursement->inflow,
                'outflow'=>$cashDisbursement->outflow,
                'balance'=>$cashDisbursement->balance,
            ];
        });
    }
}
