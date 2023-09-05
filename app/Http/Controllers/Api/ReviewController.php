<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::where('customer_id', Auth::user()->getAuthIdentifier())->get();

        return $reviews;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewRequest $request, int $product_id)
    {
        $data = $request->validated();
        $data['product_id'] = $product_id;
        $data['customer_id'] = Auth::user()->getAuthIdentifier();

        $review = Review::create($data);

        return $review;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReviewRequest $request, Review $review)
    {
        $review->update($request->validated());

        return Review::findOrFail($review->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return ['message' => 'Отзыв успешно удален'];
    }
}
