<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Chat;


class ChatController extends Controller
{
    
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'buyer_id' => 'required|exists:users,id',
            'seller_id' => 'required|exists:users,id',
            'message' => 'required|string',
            'sender_type' => 'required'
        ]);

        // Create a new chat message
        $chat = Chat::create($validatedData);

        // Return a JSON response
        return response()->json([
            'success' => true,
            'message' => 'Chat message saved successfully.',
            'chat' => $chat,
        ]);
    }

    public function fetch(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'buyer_id' => 'required|exists:users,id',
            'seller_id' => 'required|exists:users,id',
        ]);

        // Fetch chat messages
        $messages = Chat::where([
            'product_id' => $validatedData['product_id'],
            'buyer_id' => $validatedData['buyer_id'],
            'seller_id' => $validatedData['seller_id'],
        ])->get();

        // Return a JSON response
        return response()->json([
            'success' => true,
            'messages' => $messages,
        ]);
    }

    

public function chatPage()
{
    $sellerId = Auth()->user()->id;

    // Retrieve the list of customers who have chatted with the seller
    $customers = Chat::where('seller_id', $sellerId)
        ->groupBy('buyer_id')
        ->orderBy('created_at', 'desc')
        ->get(['buyer_id']);
       

    return view('dashboard.chats', compact('customers'));
}

public function userList()
{
    $sellerId = Auth()->user()->id;

    $customers = Chat::select('buyer_id', 'seller_id', 'product_id', 'message', 'sender_type', 'created_at')
    ->whereIn('created_at', function ($query) use ($sellerId) {
        $query->selectRaw('MAX(created_at)')
            ->from('chats')
            ->where('seller_id', $sellerId)
            ->groupBy('product_id', 'buyer_id');
    })
    ->where('seller_id', $sellerId)
    ->orderBy('created_at', 'desc')
    ->get();


    $customerList = [];

    foreach ($customers as $customer) {
        $customerList[] = [
            'id' => $customer->buyer_id,
            'name' => $customer->user->name,
            'product' => $customer->product_id,
            'product_name' => $customer->product->title,
            'avatar' => $customer->user->avatar == '/images/' ? $customer->user->avatar . "user.png" : $customer->user->avatar,
            'lastActive' => $customer->created_at
        ];
    }

    return response()->json(['userList' => $customerList]);
}


public function fetchChatMessages(){

}


}

