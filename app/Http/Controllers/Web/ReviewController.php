<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $reviews = Review::all();

        return view('reviews.index', compact('reviews'));
    }


    /**
     * @param Review $review
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function show(Review $review)
    {
        return view('reviews.show', compact('review'));
    }

    /**
     * @param Review $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Review $review)
    {
        try {
            $review->delete();

            return redirect()->route('reviews.index')->with('success', 'Запись успешно удалена');
        }
        catch (\Exception $ex)
        {
            return redirect()->route('reviews.index')->with('fail', $ex->getMessage());
        }
    }

    /**
     * @param Review $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publish(Review $review){
        $review->update(['published' => true]);

        return redirect()->route('reviews.index')->with('success', 'Отзыв доступен для просмотра');
    }

    /**
     * @param Review $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function hide(Review $review){
        $review->update(['published' => false]);

        return redirect()->route('reviews.index')->with('success', 'Отзыв скрыт');
    }
}
