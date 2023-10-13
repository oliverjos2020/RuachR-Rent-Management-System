<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{

    public function create(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => ['required', 'string', 'min:1'],
            'phone' => ['required'],
            'email' => ['required'],
            'company_name' => '',
            'state' => ['required'],
            'street' => 'required',
            'apartment' => '',
            'town' => 'required',
            'total_amount' => 'required',
            'postcode' => '',
            'product_id' => ['array', 'required'],
            'qty' => ['array', 'required'],
            'user' => ['array', 'required'],
            'owner' => ['array', 'required'],
            'amount' => ['array', 'required'],
        ]);

        $products = $request->input('product_id');
        $qtys = $request->input('qty');
        $users = $request->input('user');
        $owners = $request->input('owner');
        $amounts = $request->input('amount');

        // Group orders by owner and calculate totals
        $ordersByOwner = [];
        foreach ($owners as $index => $owner) {
            $product = $products[$index];
            $amount = $amounts[$index];
            $qty = $qtys[$index];
            $own = $owners[$index];

            // If the owner is not in the array, add them with initial values
            if (!isset($ordersByOwner[$owner])) {
                $ordersByOwner[$owner] = [
                    'subaccount' => 0,
                    'share' => 0,

                ];
            }

            // Calculate the order amount (qty * amount) and update the total amount
            $orderAmount = $amount * $qty;
            $ordersByOwner[$owner]['share'] += $orderAmount * 10;
            $ordersByOwner[$owner]['subaccount'] = Account::where('user_id', $own)->value('account_code');

        }
        $response = array_values($ordersByOwner);
        // $response = json_encode($response);
        // return $response;

        $requestBody = array(
            'email' => $request->input('email'),
            'amount' => intval($request->input('total_amount') * 100),
            // 'amount' => intval($request->input('total_amount') * 100) + 100,
            'split' => array(
                'type' => 'flat',
                'bearer_type' => 'account',
                'subaccounts' => $response,
            ),
        );

        //   return $requestBody;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($requestBody),
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer sk_test_f4f498e04004fea994980a1574ad941b908fc60a",
                "Cache-Control: no-cache",
                "Content-Type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // return "cURL Error #:" . $err;
            return json_encode(array('respnse_code' => 303, 'response_message' => $err));

        } else {
            // return $response;
        }

        $orderData = [];
        $dcode = json_decode($response, true);

        if ($dcode['status'] == false) {
            return json_encode(array('respnse_code' => 304, 'response_message' => $dcode['message']));

        }

        foreach ($products as $index => $productId) {
            $orderData[] = array_merge($request->only(['name', 'phone', 'email', 'company_name', 'state', 'street', 'apartment', 'town', 'postcode']), [
                'product_id' => $productId,
                'qty' => $qtys[$index],
                'user' => $users[$index],
                'owner' => $owners[$index],
                'amount' => $amounts[$index],
                'reference' => $dcode['data']['reference'],
            ]);
        }
        // return $orderData;
        Order::insert($orderData);

        foreach ($products as $index => $productId) {
            $userId = $users[$index];

            Cart::where('user_id', $userId)->where('product_id', $productId)->update(['reference' => $dcode['data']['reference']]);

        }

        return $response;
        // return back();
    }

    public function confirmPayment(Request $request)
    {
        // return $request['reference'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$request[reference]",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer sk_test_f4f498e04004fea994980a1574ad941b908fc60a",
                "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // return "cURL Error #:" . $err;
            return json_encode(array('respnse_code' => 303, 'response_message' => $err));

        } else {
            return $response;
        }

    }

    public function fetch()
    {

        $id = Auth()->user()->id;
        $order = Order::where('owner', $id)->where('status', 1)->where('fulfillment', 0)->get();
        return view('dashboard.order', ['order' => $order]);
    }

    public function myOrder()
    {
        $id = Auth()->user()->id;
        $order = Order::where('user', $id)->get();
        return view('my-order', ['order' => $order]);
    }

    public function fulfilledOrder()
    {
        $id = Auth()->user()->id;
        $order = Order::where('owner', $id)->where('status', 1)->where('fulfillment', 1)->get();
        return view('dashboard.fulfilled-orders', ['order' => $order]);
    }
    public function updateAccount($reference)
    {
        Order::where('reference', $reference)->update(['status' => 1]);
        $items = Cart::where('reference', $reference)->get();

        foreach ($items as $item) {
            // Subtract the quantity of the item from the products table
            $product = Product::find($item->product_id);
            if ($product) {
                $product->quantity -= $item->qty;
                $product->save();
            }
        }

        Cart::where('reference', $reference)->delete();

        return response()->json(['message' => 'Payment has been received and confirmed'], 200);
    }

    public function updateFulfillment($id, $fullfillment)
    {
        // dd($fullfillment);

        $order = Order::findOrFail($id);

        $order->fulfillment = $fullfillment;
        $order->save();
        Session::flash('updated', "Item fulfilled");
        return back();
    }
    

}
