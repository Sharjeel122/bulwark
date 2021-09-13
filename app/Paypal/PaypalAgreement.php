<?php


namespace App\Paypal;


use App\Models\User;
use App\Models\Website;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PayPal\Api\Agreement;
use PayPal\Api\Payer;
use PayPal\Api\Plan;
use PayPal\Api\ShippingAddress;

class PaypalAgreement extends Paypal
{
    public function create($id)
    {
        return redirect($this->Agreement($id));
    }

    /**
     * @return Agreement
     */
    protected function Agreement($id)
    {
//        dd($id);
//        dd(request()->website);
        $agreement = new Agreement();
        $agreement->setName('startup')
            ->setDescription('Ideal for Small Websites, Blogs, and Podcasts built using WordPress or HTML.')
            ->setStartDate(gmdate("Y-m-d\TH:i:s\Z", strtotime("+7 day")));

        $agreement->setPlan($this->Plan($id));

        $agreement->setPayer($this->Payer());

//        $this->ShippingAddress($agreement);

        $agreement = $agreement->create($this->apiContext);
        $link = $agreement->getApprovalLink();
        $link = explode('&',$link);
        $get_token = explode('token=', $link[1]);

        $website = Website::findOrFail(request()->website);
        $website->token_id =  $get_token[1];
        $website->update();



        return $agreement->getApprovalLink();

//        return $agreement;
    }

    /**
     * @param $id
     * @return Plan
     */
    protected function Plan($id)
    {
        $plan = new Plan();
        $plan->setId($id);
        return $plan;
    }

    /**
     * @return Payer
     */
    protected function Payer()
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        return $payer;
    }

    /**
     * @param Agreement $agreement
     */
    protected function ShippingAddress(Agreement $agreement)
    {
        $shippingAddress = new ShippingAddress();
        $shippingAddress->setLine1('111 First Street')
            ->setCity('Saratoga')
            ->setState('CA')
            ->setPostalCode('95070')
            ->setCountryCode('US');
        $agreement->setShippingAddress($shippingAddress);
    }

    public function execute($token)
    {

        $agreement = new Agreement();
        $get_subscription = $agreement->execute($token, $this->apiContext);
        $website = Website::where('token_id', $token)->first();
        $website->status = 0;
        $website->payment = 'Paid';
        $website->subscription_id = $get_subscription->id;
        $website->update();

        $paypal_plan = PaypalPlan::findOrFail($website->plan);

        $user = User::findOrFail(Auth::user()->id);
        $user->lead = 0;
        $user->update();

        // $customer_data = User::with('get_website')->where('id', $request->u_id)->get();
        $customer_data = User::findOrFail(Auth::user()->id);
        $user_mail = $customer_data->email;
        $sender_mail = "cyberbulwark@edenspell.com";

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



    }
}
