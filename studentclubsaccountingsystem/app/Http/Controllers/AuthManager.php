<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CashDisbursement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
use App\Models\Notifications;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;

// use Illuminate\Contracts\Foundation\Application\redirect;

class AuthManager extends Controller
{
    protected $table = 'users';

    function login(){
        if(Auth::check()){
            if(session('role')==='Audit'){
                return redirect(route('audit'));
            }else{
                return redirect(route('club'));
            }
        }
        return view('login');
    }

    function signup(){
        if(Auth::check()){
            if(session('role')==='Audit'){
                return redirect(route('audit'));
            }else{
                return redirect(route('club'));
            }
        }
        return view('registration');
    }

    // login
    function loginPost(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        $email = $request->input('email');

        $user = User::where('email', $email)->first();
        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)){
            $club = $user->club;
            Session::put('club', $club);

            if($club === 'Audit'){
                Session::put('role', 'Audit');
                $notifications = Notifications::orderBy('id', 'desc')// Order by the 'id' column in descending order (most recent first)
                ->limit(5)
                ->get(); // Limit the result to 5 notifications
                
                $statusCounts = CashDisbursement::select('club')
                    ->selectRaw('SUM(CASE WHEN status = "Valid" THEN 1 ELSE 0 END) as valid_count')
                    ->selectRaw('SUM(CASE WHEN status = "Invalid" THEN 1 ELSE 0 END) as invalid_count')
                    ->selectRaw('SUM(CASE WHEN status = "Pending" THEN 1 ELSE 0 END) as pending_count')
                    ->groupBy('club')
                    ->get();
                return view('audit.auditdashboard', [
                    'notifications'=>$notifications,
                    'statusCounts'=>$statusCounts
                ]);
                
            }else{
                Session::put('role', 'Club');

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

                // notifications
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
                
            }
        }
        return redirect()->route('login')->with("error", "Login details are not valid");
    }

    // Registration
    function signupPost(Request $request){
        $request->validate([
            'name'=>'required',
            'email' => ['required', 'email', 'unique:users', 'regex:/\.gcit@rub\.edu\.bt$/i'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'club' => 'required'
        ],
        [
            'email.regex' => 'The email must be in the format ".gcit@rub.edu.bt."',
        ]
    );

     // Check the count of users with the given club
     $clubCount = User::where('club', $request->club)->count();
     
        if ($clubCount < 5) {
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['password'] = Hash::make($request->password);
            $data['club'] = $request->club;
    
            $user = User::create($data);
            return redirect(route('login'))->with("success", "Registration success!,Login to access your account.");
        } else {
            return redirect(route('signup'))->with("error", "Sorry! Members limit exceeded for the club.");
        }

        if(!$user){
            return redirect(route('signup'))->with("error", "Registration failed, try again.");
        }
    }
    // logout
    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }


   

   

    //get all members
    function getMembers(){
        $club = session('club');
        $members = User::where('club', $club)->get();

        return view('clubs.members', compact('members'));
    }
    //get all audit members
    function getAuditMembers(){
        $club = session('club');
        $members = User::where('club', $club)->get();
        return view('audit.members', compact('members'));
    }




     // reset password 
     public function showPasswordChangeForm(){
        return view('forget-password');
    }
    
    // show change password form 
    public function showPasswordResetForm(){
        return view('resetPassword');
    }
    // resetPassword link sent 
    public function resetPassword(Request $request): RedirectResponse{
        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->with('error', 'The email address does not exist. Please try again.');
        }

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status = Password::RESET_LINK_SENT
                        ? back()->with('success', 'We have sent the link to reset password in this email. Please check!')
                        : back()->withInput($request->only('email'))
                                ->withErrors(['email'=>__($status)]);
    }

     //change Password
     public function changePassword(Request $request){
        $request->validate([
            'email'=>'required|email',
            'new_password' => 'required'
        ]);

        $email = $request->input('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->with('error', 'The email address does not exist. Please try again.');
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->route('login')->with('success', 'Password changed successfully.');  
    }
}
