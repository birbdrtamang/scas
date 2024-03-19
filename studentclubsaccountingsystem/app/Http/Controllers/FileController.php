<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CashDisbursement;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Remarks;

class FileController extends Controller
{
    function upload(Request $request){

        $data = new CashDisbursement();
        $notification = new Notifications();
        $user = new User();

        date_default_timezone_set('Asia/Thimphu');
        
        $date = Carbon::now();
        $formattedDate = $date->format('M j, g:i A');


        $file = $request->doc;
        $filename = time().'.'.$file->getClientOriginalExtension();
        $file->move('assets/docs',$filename);

        $data->docs = $filename;
        $data->desc = $request->desc;
        $data->openingBalance = $request->openingBalance;
        $data->inflow = $request->inflow;
        $data->outflow = $request->outflow;
        $data->balance = $data->openingBalance + $data->inflow - $data->outflow;
        $data->status = 'Pending';
        $data->club = session('club');
        $data->date = $formattedDate;

        // getting the current user name 
        // and store the notifications whenever the user uploads a documnent.
        $user = Auth::user();
        $userFullName = $user->name;

        // notification columns
        $notification->content = "Added a new document about ".$data->desc;
        $notification->fullname = $userFullName;
        $notification->club = session('club');
        $notification->date = $formattedDate;


        $data->save();
        $notification->save();
        
        return redirect(route('cashdisbursement'))->with("success","The document is uploaded successfully!");

    }

    // fetch all the data from the cashdisbursement table of current club
    function budgetDetails(){
        $club = session('club');
        $data = CashDisbursement::where('club', $club)->get();
        return view('clubs.cashdisbursement', compact('data'));
    }

    // view the particular document 
    function viewDocument($id){
        $data = CashDisbursement::find($id);
        return view('clubs.viewDocument',compact('data'));
    }

    // Edit the document 
    function edit($id){
        $data = CashDisbursement::find($id);
        $remarks = Remarks::where('docID', $id)->get();

        return view('clubs.updateDocument', compact('data','remarks'));
    }


    function update(Request $request, $id){
        $data = CashDisbursement::find($id);
        $notification = new Notifications();

        $file = $request->doc;
        $filename = time().'.'.$file->getClientOriginalExtension();
        $file->move('assets/docs',$filename);

        date_default_timezone_set('Asia/Thimphu');
        $date = Carbon::now();
        $formattedDate = $date->format('M j, g:i A');

        $data->docs = $filename;
        $data->desc = $request->input('desc');
        $data->openingBalance = $request->input('openingBalance');
        $data->inflow = $request->input('inflow');
        $data->outflow = $request->input('outflow');
        $data->balance = $data->openingBalance + $data->inflow - $data->outflow;
        $data->status = $data->status;
        $data->club = session('club');
        $data->date = $formattedDate;

         // getting the current user name 
        // and store the notifications whenever the user updates a documnent.
        $user = Auth::user();
        $userFullName = $user->name;

        $notification->content = "Updated the document of ".$data->desc;
        $notification->fullname = $userFullName;
        $notification->club = session('club');
        $notification->date = $formattedDate;

        $data->save();
        $notification->save();
        
        return redirect(route('cashdisbursement'))->with("success","The document is updated successfully!");
        
    }

    // fetch all notifications
    // fetch all the data from the cashdisbursement table 
    function getNotifications(){
        $club = session('club');
        $notifications = Notifications::where('club', $club)
        ->orWhere('club', 'Audit')
        ->orderBy('id','desc')
        ->get();
        return view('clubs.notifications', compact('notifications'));
    }

    function getAuditNotifications(){
        $notifications = Notifications::orderBy('id','desc')
        ->get();
        
        return view('audit.auditnotifications', compact('notifications'));
    }

    // Get top 5 notifications 
    function getTopNotifications(){
        $notifications = Notifications::orderBy('id', 'desc') // Order by the 'date' column in descending order (most recent first)
        ->limit(5) // Limit the result to the 5 most recent notifications
        ->get();

        $statusCounts = CashDisbursement::select('club')
            ->selectRaw('SUM(CASE WHEN status = "Valid" THEN 1 ELSE 0 END) as valid_count')
            ->selectRaw('SUM(CASE WHEN status = "Invalid" THEN 1 ELSE 0 END) as invalid_count')
            ->selectRaw('SUM(CASE WHEN status = "Pending" THEN 1 ELSE 0 END) as pending_count')
            ->groupBy('club')
            ->get();

        return view('audit.auditdashboard', compact('notifications','statusCounts'));
    }

    // get all the clubs with their status
    function getClubs(){
        $statusCounts = CashDisbursement::select('club')
        ->selectRaw('SUM(CASE WHEN status = "Valid" THEN 1 ELSE 0 END) as valid_count')
        ->selectRaw('SUM(CASE WHEN status = "Invalid" THEN 1 ELSE 0 END) as invalid_count')
        ->selectRaw('SUM(CASE WHEN status = "Pending" THEN 1 ELSE 0 END) as pending_count')
        ->groupBy('club')
        ->get();

        return view('audit.clubs', compact('statusCounts'));
    }

    // get cash disbursement table of each club 

    function getClubCashdisbursement($club){

        $items = CashDisbursement::where('club', $club)->get();
        return view('audit.clubcashdisbursement', compact('items','club'));
    }

    // give feedback to the particular document

    function giveRemark($id){
        $remarks = Remarks::where('docID', $id)->get();

        return view('audit.remarks', compact('id','remarks'));
    }

    // upload the Remarks
    function submitRemarks($id,Request $request){

        $data = CashDisbursement::find($id);
        $notification = new Notifications();

        // get the current time 
        date_default_timezone_set('Asia/Thimphu');
        $date = Carbon::now();
        $formattedDate = $date->format('M j, g:i A');

        //get the remarks content from the audit
        $validatedData = $request->validate([
            'status' => 'required|in:Valid,Invalid',
            'content' => 'string',
        ]);

        // get the current user's name 
        $user = Auth::user();
        $userFullName = $user->name;

        // insert the data into the table 
        Remarks::create([
            'docID' => $id,
            'content' => $validatedData['content'],
            'auditor' => $userFullName,
            'date' => $formattedDate,
        ]);

        $id = $id;
        //update the status of the document in cash dibursement table
        $status = $request->input('status');
        $data->status = $status;

        // give notifications 
        $notification->content = "The document ".$data->desc." of ".$data->club." club is considered ".$status." by auditor ".$userFullName;
        $notification->fullname = $userFullName." (Auditor)";
        $notification->club = $data->club;
        $notification->date = $formattedDate;

        $data->save();
        $notification->save();

        return redirect()->back()->with("success","The document is remarked successfully!");

    }


}
