<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use Mpesa;
class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('pay');
    }

    public function processPayment(Request $request)
    {
        
        return redirect()->route('payment.chooseMethod');
    }

    public function choosePaymentMethod()
    {
        return view('chooseMethod');
    }

    public function processMpesaPayment(Request $request)
    {
            try {
            // Validate the phone number (you may need more validation)
            $request->validate([
                'phone_number' => 'required|numeric',
            ]);

            $mpesa = new \Safaricom\Mpesa\Mpesa();

            $BusinessShortCode = '174379';
            $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
            $TransactionType = 'CustomerPayBillOnline';
            $CallBackURL = 'https://730a-196-216-71-42.ngrok-free.app/payment/stkcallback';
            $Amount ='1';
/*           $Amount = $request->input('amount');
*/          $PartyA = '254757094679'; 
            /* $PartyA = '254' . substr($request->input('phone_number'), -9);  */
            $PartyB = '174379';
            $PhoneNumber = '254757094679'; 
/*             $PhoneNumber = '254' . substr($request->input('phone_number'), -9); 
*/          $AccountReference = 'AccountReference';
            $TransactionDesc = 'TransactionDesc';
            $Remarks = 'Remarks';
            

            $stkPushSimulation = $mpesa->STKPushSimulation($BusinessShortCode, $LipaNaMpesaPasskey, $TransactionType, $Amount, $PartyA, $PartyB, $PhoneNumber, $CallBackURL, $AccountReference, $TransactionDesc, $Remarks);

/*             return redirect('https://730a-196-216-71-42.ngrok-free.app/payment/stkcallback');
 */
        } catch (\Exception $e) {
            // Log the exception and handle it as needed
            Log::error('An error occurred during M-Pesa payment processing: ' . $e->getMessage());

            // You can redirect back with an error message or perform other actions
            return redirect()->route('payment.chooseMethod')->with('error', 'An error occurred. Please try again.');
        }
    }
    public function stkCallback()
    {
        $data = file_get_contents('php://input');
        Log::info('stkCallback reached. Data: ' . $data);
        Storage::disk('local')->put('stk.txt', $data);
    }

}
