<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Booking;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    public function index()
    {
        $featuredHotels = Hotel::where('is_featured', true)->take(6)->get();
        return view('home', compact('featuredHotels'));
    }

    public function list()
    {
        $hotels = Hotel::paginate(12);
        return view('hotels.list', compact('hotels'));
    }

    public function search(Request $request)
    {
        $hotels = Hotel::query();
        
        if ($request->has('location')) {
            $hotels->where('location', 'like', '%' . $request->location . '%');
        }
        
        $hotels = $hotels->paginate(12);
        return view('hotels.list', compact('hotels'));
    }

    public function show(Hotel $hotel)
    {
        return view('hotels.show', compact('hotel'));
    }

    public function myBookings()
    {
        $bookings = Auth::user()->bookings()->with('hotel')->latest()->get();
        return view('hotels.mybookings', compact('bookings'));
    }

    public function favorites()
    {
        $favorites = Auth::user()->favoriteHotels()->latest()->get();
        return view('hotels.favorites', compact('favorites'));
    }

    public function toggleFavorite(Hotel $hotel)
    {
        $user = Auth::user();
        if ($user->favoriteHotels()->where('hotel_id', $hotel->id)->exists()) {
            $user->favoriteHotels()->detach($hotel->id);
            $message = 'Hotel removed from favorites';
        } else {
            $user->favoriteHotels()->attach($hotel->id);
            $message = 'Hotel added to favorites';
        }

        return back()->with('success', $message);
    }
}
