@extends('layouts.app')

@section('title', 'HoBo - Home')

@section('content')
    <!-- Hero Section -->
    <section id="hero-section" class="container-fluid px-0">
        <div class="hero-content text-center">
            <h1>Find Your Perfect Stay</h1>
            <p>Discover amazing hotels at the best prices</p>
            <form action="{{ route('hotels.search') }}" method="GET" class="search-form">
                <div class="input-group">
                    <input type="text" class="form-control" name="location" placeholder="Where are you going?">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Featured Hotels Section -->
    <section id="featured-hotels" class="container my-5">
        <h2 class="text-center mb-4">Featured Hotels</h2>
        <div class="row g-4">
            @foreach($featuredHotels as $hotel)
            <div class="col-md-4">
                <div class="card hotel-card">
                    <img src="{{ asset($hotel->image) }}" class="card-img-top" alt="{{ $hotel->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $hotel->name }}</h5>
                        <p class="card-text">{{ $hotel->description }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="price">From ${{ $hotel->price_per_night }}/night</span>
                            <a href="{{ route('hotels.show', $hotel) }}" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
@endsection
