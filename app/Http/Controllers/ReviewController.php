<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Session;



class ReviewController extends Controller
{
    public function create(Request $request)
{
    $data = $request->validate([
        'message' => ['required'],
        'product_id' => ['required'],
    ]);

    $data['user_id'] = auth()->user()->id;

    // Check if a review with the same product_id and user_id exists
    $existingReview = Review::where('product_id', $data['product_id'])
                            ->where('user_id', $data['user_id'])
                            ->first();

    if ($existingReview) {
        // If an existing review is found, update its message
        $existingReview->update(['message' => $data['message']]);
        Session::flash('created', "Review updated successfully");

    } else {
        // If no existing review is found, create a new review
        Review::create($data);
        Session::flash('created', "Review posted sucessfully");

    }

    return back();
}

}
