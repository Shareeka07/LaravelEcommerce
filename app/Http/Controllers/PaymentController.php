<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function razorpay(Request $request)
    {   
       
        if(isset($request->razorpay_payment_id)&&$request->razorpay_payment_id!="")
        {
            $api= new Api(env('RAZORPAY_KEY'),env('RAZORPAY_SECRET'));
            $payment=$api->payment->fetch($request->razorpay_payment_id);
            $response = $payment->capture(['amount' => $payment->amount]);

            DB::table('payments')->insert([
                'ProductName' => $response->notes['product_name'] ?? 'Unknown Product',
                'OrderQuantity' => $response->notes['quantity'] ?? 1,
                'OrderAmount' => $response->amount / 100, // Amount in rupees
                'OrderCurrency' => $response->currency,
                'CustomerName' => $response->notes['customer_name'] ?? 'Anonymous',
                'CustomerEmail' => $response->notes['customer_email'] ?? 'No Email'
              
            ]);
            return redirect()->route('success');
        }
        else
        {
            return redirect()->route('cancel');
        }
    }
    public function success()
    {
       return "Payment Successful";
    }
    public function cancel()
    {
        return "Payment Cancelled";
    }
}
