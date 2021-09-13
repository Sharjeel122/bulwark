<?php

namespace App\Http\Controllers;

use App\Models\PaypalPlan;
use App\Models\User;
use App\Models\Website;
use App\Paypal\PaypalAgreement;
use App\Paypal\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
    public function create_plan()
    {
        $plan  = new SubscriptionPlan();
        return $plan->create();
    }

    public function list_plan()
    {
        $plan  = new SubscriptionPlan();
        return $plan->listPlan();
    }

    //id means we need to save plan id into our database and then retrive id and pass it to these functions
    public function plan_details($id)
    {
        $plan  = new SubscriptionPlan();
        return $plan->PlanDetails($id);
    }

    public function activate($id)
    {
        $plan  = new SubscriptionPlan();
        return $plan->activate($id);
    }
    public function delete($id)
    {
        $plan  = new SubscriptionPlan();
        return $plan->delete($id);
    }
    public function update($id)
    {
        $plan  = new SubscriptionPlan();
        return $plan->update($id);
    }

    public function create_agreement($id)
    {
        $agreement  = new PaypalAgreement();
        return $agreement->create($id);
    }

    public function execute_agreement($status)
    {
        if($status == 'true'){
            $agreement  = new PaypalAgreement();
            $agreement->execute(request()->token);

            $website = Website::where('token_id', request()->token)->first();
            return view('website-details', compact('website'));

        }
    }

    public function execute_other()
    {
        $website = Website::findOrFail(request()->website_id);
        $website->status = 0;
        $website->payment = 'Paid';
        $website->subscription_id = request()->subscription_id;
        $website->update();

        $paypal_plan = PaypalPlan::findOrFail($website->plan);

        $user = User::findOrFail(Auth::user()->id);
        $user->lead = 0;
        $user->update();


        // $customer_data = User::with('get_website')->where('id', $request->u_id)->get();
        $customer_data = User::findOrFail(Auth::user()->id);
        $user_mail = $customer_data->email;
        $sender_mail = "support@edenspell.com";

        if ($website->plan == 1) {
            $pkg = ['Security Enhancement', 'Malware Scan', 'Monthly Website Backup', 'Plug-in & Theme Update', 'PHP Version Update', 'Responsive Optimization', 'Speed Optimization', 'Database Optimization', 'Monthly Traffic Reports', 'Monthly Performance Reports', 'Performance Tuning', 'Solving Server Issues', 'Website Migration', 'Broken Link Scanning', 'Forms Submission Testing', 'Fixing 404, 500 etc.'];
        }elseif ($website->plan == 2) {
            $pkg = ['Security Enhancement', 'Malware Scan', 'Weekly Website Backup', 'Plug-in & Theme Update', 'PHP Version Update', 'Responsive Optimization', 'Speed Optimization', 'Database Optimization', 'By-weekly Traffic Reports', 'By-weekly Performance Reports', 'Performance Tuning', 'Solving Server Issues', 'Website Migration', 'Broken Link Scanning', 'Forms Submission Testing', 'Fixing 404, 500 etc.'];
        }elseif ($website->plan == 3) {
            $pkg = ['Security Enhancement', 'Malware Scan', 'Daily Website Backup', 'Plug-in & Theme Update', 'PHP Version Update', 'Responsive Optimization', 'Speed Optimization', 'Database Optimization', 'Weekly Traffic Reports', 'Weekly Performance Reports', 'Performance Tuning', 'Solving Server Issues', 'Website Migration', 'Broken Link Scanning', 'Forms Submission Testing', 'Fixing 404, 500 etc.'];
        }


        // Sending mail to the customer
        Mail::send('email.sub_template', [
            'name' => $customer_data->name,
            'email' => $user_mail,
            'package_name' => $paypal_plan->name,
            'description' => $paypal_plan->description,
            'package_list' => $pkg,
        ],
            function ($mail) use ($sender_mail, $user_mail) {
                $mail->from($sender_mail, "Cyber Bulwark");
                $mail->to($user_mail)->subject('New Subscription');
            });

        // Sending mail to Admin
        $admin = User::findOrFail(1);
        $admin_mail = $admin->email;

        Mail::send('email.admin_sub_template', [
            'name' => $customer_data->name,
            'email' => $customer_data->email,
            'contact' => $customer_data->contact,
            'website' => $website->website,
            'payment' => $website->payment,
            'amount' => $website->amount,
            'subscription_date' => $website->subscription_date,
            'website_data' => $website->website_data,
            'package_name' => $paypal_plan->name,
        ],
            function ($mail) use ($sender_mail, $admin_mail) {
                $mail->from($sender_mail, "Cyber Bulwark");
                $mail->to($admin_mail)->subject('New Subscription');
            });

        // email for employee1
        $employee = User::role('employee1')->first();
        $employee_email = $employee->email;
        Mail::send('email.employee_template', [
            'name' => $customer_data->name,
            'email' => $customer_data->email,
            'contact' => $customer_data->contact,
            'website' => $website->website,
            'payment' => $website->payment,
            'amount' => $website->amount,
            'subscription_date' => $website->subscription_date,
            'website_data' => $website->website_data,
            'package_name' => $paypal_plan->name,
        ],
            function ($mail) use ($sender_mail, $employee_email) {
                $mail->from($employee_email, "Cyber Bulwark");
                $mail->to($employee_email)->subject('New Subscription');
            });

        return view('website-details', compact('website'));
    }
}
