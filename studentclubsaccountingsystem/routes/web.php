<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\FileController;
use App\Models\CashDisbursement;
use App\Http\Controllers\ForgetPasswordManager;
use App\Models\Notifications;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::get('/signup', [AuthManager::class, 'signup'])->name('signup');


Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::post('/signup', [AuthManager::class, 'signupPost'])->name('signup.post');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');



Route::get('/verify-email', [AuthManager::class, 'showPasswordChangeForm'])->name('password.show');
Route::get('/reset-password/{token}', [AuthManager::class, 'showPasswordResetForm'])->name('password.reset');

Route::post('/email-link', [AuthManager::class, 'resetPassword'])->name('reset-password-link');
Route::post('/reset-password', [AuthManager::class, 'changePassword'])->name('reset-password.post');


//audit routes
Route::group(['middleware' => 'auth'], function(){
    Route::get('/', function () {
        return view('./audit/audit');
    })->name('audit');

    Route::get('/audit', function () {
        return view('./audit/audit');
    })->name('audit');

    Route::get('/auditdashboard', [FileController::class, 'getTopNotifications'])->name('auditdashboard');
    Route::get('/auditnotifications', [FileController::class, 'getAuditNotifications'])->name('auditnotifications');
    Route::get('/getclubs', [FileController::class, 'getClubs'])->name('getClubs');
    Route::get('/auditMembers', [AuthManager::class, 'getAuditMembers'])->name('auditMembers');
    Route::get('/clubcashdisbursement/{club}', [FileController::class, 'getClubCashdisbursement'])->name('clubcashdisbursement');
    Route::get('/giveremark/{id}', [FileController::class, 'giveRemark'])->name('giveremark');

    Route::post('/submit-remarks/{id}', [FileController::class, 'submitRemarks'])->name('submit.remarks');
});










// club routes 
Route::group(['middleware' => 'auth'], function(){
    Route::get('/', function () {
        return view('./clubs/club');
    })->name('club');

    Route::get('/club', function () {
        return view('./clubs/club');
    })->name('club');

    Route::get('/dashboard', function () {
        $club = session('club'); 

        $data = CashDisbursement::where('club',$club)->get();

        $Inflow = $data->sum('inflow');
        $Outflow = $data->sum('outflow');
        $Balance = $data->sum('balance');

        $graphData = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'inflow' => $item->inflow,
                'outflow' => $item->outflow,
                'balance' => $item->balance,
            ];
        });

        // inflow 
        if($Inflow >= 3000){
            $totalInflow = number_format($Inflow/1000,1).'K';
        }
        elseif($Inflow >= 1000000){
            $totalInflow = number_format($Inflow/1000000,1).'M';
        }
        else{
            $totalInflow = $Inflow;
        }

        // outflow 
        if($Outflow >= 3000){
            $totalOutflow = number_format($Outflow/1000,1).'K';
        }
        elseif($Outflow >= 1000000){
            $totalOutflow = number_format($Outflow/1000000,1).'M';
        }
        else{
            $totalOutflow = $Outflow;
        }

        // balance
        if($Balance >= 3000){
            $totalBalance = number_format($Balance/1000,1).'K';
        }
        elseif($Balance >= 1000000){
            $totalBalance = number_format($Balance/1000000,1).'M';
        }
        else{
            $totalBalance = $Balance;
        }
        // get top 5 notifications
        $notifications = Notifications::where('club', $club)
            ->orWhere('club', 'Audit')
            ->orderBy('id', 'desc') // Order by the 'id' column in descending order (most recent first)
            ->limit(5) // Limit the result to 5 notifications
            ->get();

        return view('clubs.clubdashboard', [
            'club' => $club,
            'totalInflow' => $totalInflow,
            'totalOutflow' => $totalOutflow,
            'totalBalance' => $totalBalance,  
            'data' => $graphData,
            'notifications'=>$notifications
        ]);

    })->name('clubdashboard');

    Route::get('/addDocument', function () {
         // Check if the CashDisbursement table is empty
        $firstRecord = CashDisbursement::orderBy('date', 'desc')->first();
        if (!$firstRecord) {
            // If the table is empty, set openingBalance to 0
            $openingBalance = 0;
        } else {
            // If the table is not empty, set openingBalance to the latest balance value
            $openingBalance = $firstRecord->balance;
        }
        return view('./clubs/addDocument',compact('openingBalance'));
    })->name('addDocument');

    Route::post('/addDocument', [FileController::class, 'upload'])->name('addDocument.post');
    Route::get('/cashdisbursement', [FileController::class, 'budgetDetails'])->name('cashdisbursement');
    Route::get('/document/{id}', [FileController::class, 'viewDocument']);

    Route::get('/edit/{id}', [FileController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [FileController::class, 'update'])->name('update');

    Route::get('/notifications', [FileController::class, 'getNotifications'])->name('notifications');
    Route::get('/members', [AuthManager::class, 'getMembers'])->name('members');

});


