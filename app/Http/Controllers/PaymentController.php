<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\Paypal\CreatePayment;
use App\Paypal\ExecutePayment;
use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use App\Models\User;
use Auth;

class PaymentController extends Controller
{

    public function create(Request $request)
    {
        $payment = new CreatePayment();
        return $payment->create();

    }
    public function execute(Request $request)
    {
        $payment = new ExecutePayment();
        return $payment->execute();
    }

    public function cancel(){
        dd('cancel payment');
    }
}
