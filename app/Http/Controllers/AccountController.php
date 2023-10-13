<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    public function createSubAccount(Request $request){

        $request->validate([
            'business_name' => ['required'],
            'bank_code' => ['required'],
            'account_number' => ['required']
        ]);

        $existingAccount = Account::where('user_id', auth()->user()->id)->first();
        if ($existingAccount) {
          Session::flash('created', "An existing account was found for your profile");
          return back();

        }else{


        $url = "https://api.paystack.co/subaccount";

        $fields = [
          'business_name' => $request->input('business_name'),
          'bank_code' => $request->input('bank_code'),
          'account_number' => $request->input('account_number'),
          'percentage_charge' => 20,
        ];

        // return $request->input('account_number');
        
      
        $fields_string = http_build_query($fields);
      
        //open connection
        $ch = curl_init();
        
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          "Authorization: Bearer sk_test_f4f498e04004fea994980a1574ad941b908fc60a",
          "Cache-Control: no-cache",
        ));
        
        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
        
        //execute post
        $result = curl_exec($ch);
        file_put_contents("subaccount_log.txt", $result);

        $response = json_decode($result, true);
        
        $fields["account_code"] = $response['data']['subaccount_code'];

        auth()->user()->accounts()->create($fields);
        Session::flash('created', "Account created successfully");
        return back();
      }
        // echo json_encode($fields);
        // return;
    }

    public function initializePayment() {

    }
}
