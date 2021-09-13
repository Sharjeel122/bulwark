<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Website;
use App\Models\SupportTicker;
use App\Models\TickerReply;
use App\Models\Report;
use Hash;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_data = User::with('get_website')->where('id', $id)->first();

        return view('admin.edit-customer', compact('user_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
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
            $user->password = Hash::make($request->password);

            $user->update();
        }
        return back()->with('alert-success', 'Profile Updated Successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
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
            $user->password = Hash::make($request->password);

            $user->update();
        }
        return back()->with('alert-success', 'Profile Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function all_customers(){
        $customers = User::role('customer')->with('get_website')->where('lead', 0)->orderBy('id', 'desc')->get();
        // dd($customers);
        return view('admin.all-customers', compact('customers'));
    }

    public function create_customer(){
        return view('admin.create-customer');
    }

    public function store_customer(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'website' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user_id = $user->id;
        $user->assignRole('customer');

        $website = new Website();
        $website->website = $request->website;
        $website->user_id = $user_id;
        $website->payment = 'Un-Paid';
        $website->amount = '0';
        $website->subscription_date = Carbon::now();
        $website->status = 0;
        $website->save();

         return redirect(route('admin.customers', $user_id))->with('alert-success', 'Customer Successfully Added');


    }


    public function all_employees(){
        $employees = User::role(['employee1', 'employee2'])->orderBy('id', 'desc')->get();
        return view('admin.employee.all-employees', compact('employees'));
    }

    public function create_employee(){
        $employee = new User();
        return view('admin.employee.create', compact('employee'));
    }

    public function store_employee(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'type' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        $decrypt = Str::random(8);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($decrypt);
        $user->save();
        $user->assignRole($request->type);

        $user_mail = $request->email;
        $sender_mail = "support@edenspell.com";

        // Sending mail to the customer
        Mail::send('email.template', [
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'password' => $decrypt,
            'website' => $request->website,
            'payment' => 'Un-Paid',
        ],
            function ($mail) use ($sender_mail, $user_mail) {
                $mail->from($sender_mail, "Cyber Bulwark");
                $mail->to($user_mail)->subject('New Registration Details');
            });


        return redirect(route('admin.employees'))->with('alert-success', 'Employee Successfully Added');


    }

     public function support_ticker(){
        $tickers = SupportTicker::with('get_ticker_website', 'user')->get();
        return view('admin.support_ticker.index', compact('tickers'));
    }
    public function view_ticker($id){
        $ticker_info = SupportTicker::findOrFail($id);
        $tickers = TickerReply::where('ticker_id', $id)->orderBy('id', 'desc')->get();
        // dd($ticker_info);
        return view('admin.support_ticker.view-ticker', compact('tickers', 'ticker_info'));

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


        return redirect(route('admin.view.ticker', $request->ticker_id))->with('alert-success', 'Support Ticket Reply Sent Successfully');
    }

    public function close_ticker($id)
    {
        $ticker = SupportTicker::findOrFail($id);
        $ticker->status = 0;
        $ticker->update();

        return redirect(route('admin.view.ticker', $id))->with('alert-success', 'Support Ticket Close');
    }
    public function open_ticker($id)
    {
        $ticker = SupportTicker::findOrFail($id);
        $ticker->status = 1;
        $ticker->update();

        return redirect(route('admin.view.ticker', $id))->with('alert-success', 'Support Ticket Reopen');
    }

    public function all_leads(){
        $customers = User::role('customer')->with('get_website')->where('lead', 1)->orderBy('id', 'desc')->get();
        return view('admin.all-leads', compact('customers'));
    }

    public function customer_websites($id){
        $websites = Website::where('user_id', $id)->get();

        return view('admin.customer-websites', compact('websites'));
    }

    public function update_website(Request $request, $id){
        $website_update = Website::findOrFail($id);

        $website_update->website = $request->website;

        $website_update->update();

        return redirect()->back()->with('alert-success', 'Website Updated');
    }

    public function reports(){
        $reports = Report::with('get_user','get_staff', 'get_website')->orderBy('id', 'desc')->get();
            $users = User::role('customer')->where('lead', 0)->orderBy('id', 'desc')->get();

        return view('admin.upload-reports', compact('reports', 'users'));
    }

    public function user_websites(Request $request){
        $websites = Website::where('user_id', $request->user_id)->where('verification', 1)->get();
        $option = "<select name='website_id' id='user' class='form-control mt-4' required>";
        $option .= "<option value='' disabled selected>Select Website</option>";
        foreach($websites as $website){
            $option .= "<option value='$website->id'>$website->website</option>";
        }
        $option .="</select>";
        return response()->json($option);
    }

    public function upload_report(Request $request){
        $reports = new Report();
        if ($request->hasFile('report')){
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

        return redirect()->back()->with('alert-success', 'Report Uploaded Successfully');
    }

    public function edit_report($id)
    {
        $report = Report::with('get_website')->FindOrFail($id);
        $users = User::role('customer')->where('lead', 0)->orderBy('id', 'desc')->get();
        return view('admin.update-report', compact('report','users'));

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

        return redirect(route('admin.reports'))->with('alert-success', 'Report Update Successfully');
    }

    public function edit_employee($id)
    {
        $employee = User::findOrFail($id);
        return view('admin.employee.edit', compact('employee'));
    }


    public function update_employee(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
        ]);

        if($request->password ==null){
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->contact = $request->contact;
            $user->update();
        }else{
            $this->validate($request, [
                'password' => 'required|min:8',
            ]);

            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->contact = $request->contact;
            $user->password = Hash::make($request->password);
            $user->update();
        }


//        $user_mail = $request->email;
//        $sender_mail = "support@edenspell.com";
//
//        // Sending mail to the customer
//        Mail::send('email.template', [
//            'name' => $request->name,
//            'email' => $request->email,
//            'contact' => $request->contact,
//            'password' => $decrypt,
//            'website' => $request->website,
//            'payment' => 'Un-Paid',
//        ],
//            function ($mail) use ($sender_mail, $user_mail) {
//                $mail->from($sender_mail, "Cyber Bulwark");
//                $mail->to($user_mail)->subject('New Registration Details');
//            });


        return redirect(route('admin.employees'))->with('alert-success', 'Employee Successfully Updated');


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
            function ($mail) use ($sender_mail, $user_mail,$report_path ) {
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
        // dd($reports);
        return view('admin.report-list', compact('reports', 'website'));
    }
}
