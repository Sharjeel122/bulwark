<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\SupportTicker;
use App\Models\TickerReply;
use App\Models\User;
use App\Models\Website;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Auth;
use Mail;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  $date = \Carbon\Carbon::today()->subDays(7);
        // $customers = User::role('customer')->where('lead', 0)->where('created_at', '>=',$date)->orderBy('id', 'desc')->get();
         $role = Auth::user()->roles->pluck('name');
        if($role[0] == 'employee2'){
            $customers = [];
            $websites = Website::all();
            foreach($websites as $website){
                $reports = Report::where('website_id',$website->id)->get();
                if($reports->count() > 0 && $reports->count() < 2){
                foreach($reports as $report){
                        $customer = User::findOrFail($report->user_id);
                        array_push($customers,$customer);
                    }
                }

            }
//            dd($customers);
        }else{
            $customers = User::with('get_website')->where('lead', 0)
                ->whereHas('get_website', function($q) {
                    $q->whereNull('verification')->orWhere('verification', 0);
                })->get();
        }
        return view('employee.new-booking',compact('customers'));
    }

    public function dashboard()
    {

         return view('employee.dashboard');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'contact' => 'required',
        ]);

        if (empty($request->password)) {

            $data = $request->except('_token', 'method', 'password');
            $user = User::findOrFail($id)->update($data);
        }else{
            $this->validate($request, [
                'password' => 'required|min:8',
            ]);
            $user = User::findOrFail($id);
            $user->email = $request->email;
            $user->name = $request->name;
            $user->contact = $request->contact;
            $user->password = Hash::make($request->password);

            $user->update();
        }
        return back()->with('alert-success', 'Profile Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function reports()
    {
        $reports = Report::with('get_user', 'get_staff')->orderBy('id', 'desc')->get();
        $users = User::role('customer')->where('lead', 0)->orderBy('id', 'desc')->get();

        return view('employee.upload-reports', compact('reports', 'users'));
    }

    public function user_websites(Request $request)
    {
        $role = Auth::user()->roles->pluck('name');
        if($role[0] == 'employee2'){
        $websites = Website::where('user_id', $request->user_id)->where('verification', 1)->get();
        $option = "<select name='website' class='form-control' required>";
        $option .= "<option value='' disabled selected>Select Website</option>";
        foreach ($websites as $website) {
            $report = Report::where('website_id', $website->id)->get();
            if($report->count() > 0){
            $option .= "<option value='$website->id'>$website->website</option>";
            }

        }
        $option .= "</select>";
        }else{
              $websites = Website::where('user_id', $request->user_id)->where('verification', 1)->get();
        $option = "<select name='website' class='form-control' required>";
        $option .= "<option value='' disabled selected>Select Website</option>";
        foreach ($websites as $website) {
            $option .= "<option value='$website->id'>$website->website</option>";
        }
        $option .= "</select>";
        }

        return response()->json($option);
    }

    public function upload_report(Request $request)
    {

        $reports = new Report();
        if ($request->hasFile('report')) {
            $file = $request->file('report');
            $filename = $file->getClientOriginalName();

            $destinationPath = public_path('/assets/reports/');
            $file->move($destinationPath, $filename);
            $reports->report = $filename;

        }
        $reports->user_id = $request->user_id;
        $reports->report_title = $request->report_title;
        $reports->website_id = $request->website_id;
        $reports->staff_id = $request->staff_id;

        $reports->save();

        $report_path = public_path('/assets/reports/'.$filename);
        $get_user = User::findOrFail($request->user_id);
        $user_mail = $get_user->email;
        $sender_mail = "support@edenspell.com";

         // get website
        $website = Website::findOrFail($request->website_id);

        // Sending mail to the customer
        Mail::send('email.report-template', [
            'name' => $get_user->name,
            'report_title' => $request->report_title,
            'email' => $get_user->email,
            'website' => $website->website,
        ],
            function ($mail) use ($sender_mail, $user_mail,$report_path ) {
                $mail->from($sender_mail, "Cyber Bulwark");
                $mail->to($user_mail)->subject('Report Uploaded');
                $mail->attach($report_path);
            });

     return redirect()->back()->with('alert-success', 'Report Update Successfully');
    }

    public function edit_report($id)
    {
         $report = Report::with('get_website')->FindOrFail($id);
        $users = User::role('customer')->where('lead', 0)->orderBy('id', 'desc')->get();
        return view('employee.update-report', compact('report','users'));

    }

    public function update_report(Request $request, $id)
    {
        $validatedData = $request->validate([
            "report_title" => "required|string",
            "user_id"      => "required|",
            "website_id"      => "required|",
        ]);

        $report = Report::findOrFail($id);
        $report->update($request->except('_token', 'report', '_method'));;

        if ($request->hasFile('report'))
        {

            $image_path = "/assets/reports/".$report->report;  // prev image path
            File::delete(public_path($image_path));

            $file = $request->file('report') ;
            $name = $file->getClientOriginalName();
            $destinationPath = public_path('/assets/reports/');
            $file->move($destinationPath, $name);
            $report->report = $name;
        }
        $report->staff_id = Auth::user()->id;
        $report->update();

        return redirect(route('employee.reports'))->with('alert-success', 'Report Update Successfully');
    }

    public function support_ticker(){
        $tickers = SupportTicker::with('get_ticker_website', 'user')->get();
        return view('employee.support_ticker.index', compact('tickers'));
    }
    public function view_ticker($id){
        $ticker_info = SupportTicker::findOrFail($id);
        $tickers = TickerReply::where('ticker_id', $id)->orderBy('id', 'desc')->get();
        // dd($ticker_info);
        return view('employee.support_ticker.view-ticker', compact('tickers', 'ticker_info'));

    }

    public function reply_ticker(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'message' => 'required',
        ]);
        $ticker = new TickerReply($request->except('_token'));
        $ticker->employee_id = Auth::user()->id;
        $ticker->save();


        return redirect(route('employee.view.ticker', $request->ticker_id))->with('alert-success', 'Support Ticket Reply Sent Successfully');
    }

    public function close_ticker($id)
    {
        $ticker = SupportTicker::findOrFail($id);
        $ticker->status = 0;
        $ticker->update();

        return redirect(route('employee.view.ticker', $id))->with('alert-success', 'Support Ticket Close');
    }
    public function open_ticker($id)
    {
        $ticker = SupportTicker::findOrFail($id);
        $ticker->status = 1;
        $ticker->update();

        return redirect(route('employee.view.ticker', $id))->with('alert-success', 'Support Ticket Reopen');
    }

    public function all_customers(){
        $customers = User::role('customer')->with('get_website')->where('lead', 0)->orderBy('id', 'desc')->get();
        // dd($customers);
        return view('employee.employee1.customer.all-customers', compact('customers'));
    }

    public function website_list($id)
    {
        $websites = Website::with('get_plan', 'get_user')->where('user_id', $id)->get();
        return view('employee.employee1.customer.website-list', compact('websites'));
    }

    public function send_email(Request $request)
    {

        $user = User::findOrFail($request->user_id);
        $user_mail = $user->email;
        $sender_mail = "support@edenspell.com";

        // Sending mail to the customer
        Mail::send('email.credentials_template', [
            'name' => $user->name,
            'email' => $user->email,
            'website' => $request->website,
        ],
            function ($mail) use ($sender_mail, $user_mail ) {
                $mail->from($sender_mail, "Cyber Bulwark");
                $mail->to($user_mail)->subject('Report Uploaded');
                // $mail->attach($report_path);
            });
    }

    public function verified(Request $request)
    {
        $website = Website::findOrFail($request->id);
        $website->verification = $request->verified;
        $website->update();
    }

    public function report_list($id)
    {
        $website = Website::findOrFail($id);
        $reports = Report::with('get_website')->where('website_id', $id)->get();
        return view('employee.report-list', compact('reports', 'website'));
    }

    public function reminder_email(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user_mail = $user->email;
        $sender_mail = "support@edenspell.com";

        // Sending mail to the customer
        Mail::send('email.reminder-email-template', [
            'name' => $user->name,
            'email' => $user->email,
            'website' => $request->website,
        ],
            function ($mail) use ($sender_mail, $user_mail ) {
                $mail->from($sender_mail, "Cyber Bulwark");
                $mail->to($user_mail)->subject('Reminder Credential Notification');
                // $mail->attach($report_path);
            });
        return back()->with('alert-success', 'Reminder Email Sent');
    }
}
