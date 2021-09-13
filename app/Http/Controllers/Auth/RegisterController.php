<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PaypalPlan;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Website;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Auth;
use Carbon\Carbon;
use Redirect;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact' => ['required'],
//            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $decrypt = Str::random(8);
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'contact' => $data['contact'],
            'password' => Hash::make($decrypt),
        ]);

        $user->assignrole('customer');

         $user_id = $user->id;

        $website = new website();
        $website->user_id = $user_id;
        $website->website = $data['website'];
        $website->payment = 'Un-Paid';
        $website->amount = 0;
        $website->plan = $data['plan'];;
        $website->subscription_date = Carbon::now();
        $website->save();
//        Auth::login($user);
//        return view('customer.support_ticker.index');
        return 'custom-login';
    }
    public function custom_register(Request $request){
        // dd($request);
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact' => ['required'],
            'website' => ['required'],
        ]);


        $decrypt = Str::random(8);
        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'password' => Hash::make($decrypt),
        ]);

        $user->assignrole('customer');

        $user_id = $user->id;

//        if($request->plan == 1){
//            $amount = 125;
//        }elseif($request->plan == 2){
//            $amount = 250;
//        }else{
//            $amount = 500;
//        }
        $get_plan = PaypalPlan::findOrFail($request->plan);
        $website = new website();
        $website->user_id = $user_id;
        $website->website = $request->website;
        $website->payment = 'Un-Paid';
        $website->amount = $get_plan->price;
        $website->plan = $request->plan;
        $website->subscription_date = Carbon::now()->addDay(7);
        $website->save();

//        $get_plan = PaypalPlan::findOrFail($request->plan);
//        $id = $get_plan->plan_id;
//

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

        // Sending mail to Admin
        $admin = User::findOrFail(1);
        $admin_mail = $admin->email;

        Mail::send('email.admin_template', [
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'password' => $decrypt,
            'website' => $request->website,
            'payment' => 'Un-Paid',
        ],
            function ($mail) use ($sender_mail, $admin_mail) {
                $mail->from($sender_mail, "Cyber Bulwark");
                $mail->to($admin_mail)->subject('New Registration Notificaiton');
            });


        Auth::login($user);
        return redirect()->route('payment')->with('message','Check your eMail for Auto Generated Password.');
    }

    public function showRegistrationForm() {
        $id = request()->id;
        $get_plan = PaypalPlan::findOrFail($id);
        if($id){
            return view ('auth.register', compact('id', 'get_plan'));
        }else{
            return redirect()->route('login');
        }
    }

}
