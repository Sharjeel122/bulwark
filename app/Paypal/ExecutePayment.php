<?php


namespace App\Paypal;


use App\Models\User;
use App\Models\Website;
use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Auth;

class ExecutePayment extends Paypal
{

    public function execute()
    {
        $website = Website::findOrFail(request()->website);
        $payable_amount = (double)$website->amount;

        $payment = $this->GetThePayment();

        $execution = $this->CreateExecuation();

        $execution->addTransaction($this->transaction($payable_amount));

        $result = $payment->execute($execution, $this->apiContext);

        $transaction_id = $result->transactions[0]->related_resources[0]->sale->id;
        $website->transaction_id = $transaction_id;
        $website->payment = 'Piad';
        $website->status = 0;
        $website->update();

        $user = User::findOrFail(Auth::user()->id);
        $user->lead = 0;
        $user->update();

        return redirect(route('website.details', $website));
    }

    /**
     * @return Payment
     */
    protected function GetThePayment()
    {
        $paymentId = request()->paymentId;
        $payment = Payment::get($paymentId, $this->apiContext);
        return $payment;
    }

    /**
     * @return PaymentExecution
     */
    protected function CreateExecuation()
    {
        $execution = new PaymentExecution();
        $execution->setPayerId(request()->PayerID);
        return $execution;
    }

    /**
     * @param $payable_amount
     * @param Details $details
     * @return Amount
     */


    /**
     * @param Amount $amount
     * @return Transaction
     */
    protected function transaction($payable_amount)
    {
        $transaction = new Transaction();
        $transaction->setAmount($this->amount($payable_amount));
        return $transaction;
    }
}
