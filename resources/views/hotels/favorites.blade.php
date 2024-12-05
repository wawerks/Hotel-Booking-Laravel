@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">My Favorite Hotels</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($favorites->isEmpty())
        <div class="alert alert-info">
            You haven't added any hotels to your favorites yet.
        </div>
    @else
        <div class="row">
            @foreach($favorites as $hotel)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($hotel->image)
                            <img src="{{ asset('storage/' . $hotel->image) }}" class="card-img-top" alt="{{ $hotel->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $hotel->name }}</h5>
                            <p class="card-text">
                                <i class="bi bi-geo-alt"></i> {{ $hotel->location }}<br>
                                <i class="bi bi-star-fill text-warning"></i> {{ $hotel->rating }}/5<br>
                                Starting from ${{ number_format($hotel->price_per_night, 2) }} per night
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('hotels.show', $hotel) }}" class="btn btn-primary">View Details</a>
                                <form action="{{ route('hotels.toggleFavorite', $hotel) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="bi bi-heart-fill"></i> Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
