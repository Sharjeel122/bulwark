<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\User;
use App\Models\SupportTicker;
use App\Models\TickerReply;
use Auth;
use Hash;
use App\Http\Requests\StoreTicker;
use App\Models\Report;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active = Auth::user()->lead;
        if($active == 1){
            return redirect()->route('payment');
        }else{
            return view('customer.dashboard');
        }

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function support_ticker(){
        $tickers = SupportTicker::with('get_ticker_website')->where('user_id', Auth::user()->id)->get();

        return view('customer.support_ticker.index', compact('tickers'));
    }

    public function generate_ticker(){
        $websites = Website::where('status', 0)->where('user_id', Auth::user()->id)->get();
        return view('customer.support_ticker.generate-ticker', compact('websites'));
    }

    public function send_ticker(StoreTicker $request)
    {
        $ticker = new SupportTicker($request->except('_token'));
        $ticker->user_id = Auth::user()->id;
        $ticker->save();
        $ticker_id = $ticker->id;
        $update_ticker = SupportTicker::findOrFail($ticker_id);
        $update_ticker->pre_link = $ticker_id;
        $update_ticker->update();

        $reply = new TickerReply();
        $reply->ticker_id = $ticker_id;
        $reply->user_id = Auth::user()->id;
        $reply->message = $request->message;
        $reply->save();

        return redirect(route('customer.support.tickers'))->with('alert-success', 'Support Ticket Sent Successfully');
    }

    public function view_ticker($id){
        $ticker_info = SupportTicker::findOrFail($id);
        $tickers = TickerReply::where('ticker_id', $id)->orderBy('id', 'desc')->get();
        return view('customer.support_ticker.view-ticker', compact('tickers', 'ticker_info'));

    }

    public function reply_ticker(Request $request)
    {
        // dd($request->all());

         $this->validate($request, [
            'message' => 'required',
        ]);
        // $ticker = new SupportTicker($request->except('_token'));
        // $ticker->user_id = Auth::user()->id;
        // $ticker->save();
        $ticker = new TickerReply($request->except('_token'));
        $ticker->user_id = Auth::user()->id;
        $ticker->save();


        return redirect(route('customer.view.ticker', $request->ticker_id))->with('alert-success', 'Support Ticker Reply Sent Successfully');
    }

    public function close_ticker($id)
    {
        $ticker = SupportTicker::findOrFail($id);
        $ticker->status = 0;
        $ticker->update();

        return redirect(route('customer.view.ticker', $id))->with('alert-success', 'Support Ticket Close');
    }
    public function open_ticker($id)
    {
        $ticker = SupportTicker::findOrFail($id);
        $ticker->status = 1;
        $ticker->update();

        return redirect(route('customer.view.ticker', $id))->with('alert-success', 'Support Ticket Reopen');
    }
    public function update_website_info (Request $request, $id){
        $this->validate($request, [
            'website_data' => 'required',
        ]);
        $website = Website::findOrFail($id);
        $website->website_data = $request->website_data;
        $website->update();

        return redirect(route('customer.support.tickers'));
    }

    public function view_websites(){
        // $websites = User::with('get_website')->where('user_id', Auth::user()->id)->get();
        $websites = Website::where('user_id', Auth::user()->id)->get();


        return view('customer.website.mywebsites', compact('websites'));
    }

    // My Website Detail
    public function websites_detail($id){
        $website_detail = Website::findOrFail($id);

        return view('customer.website.website-detail', compact('website_detail'));
    }

    public function reports(){
        $reports = Report::with('get_user','get_staff', 'get_website')->orderBy('id', 'desc')->get();
        $users = User::role('customer')->where('lead', 0)->orderBy('id', 'desc')->get();
        return view('customer.view-reports', compact('reports', 'users'));
    }

}
