@extends('layouts.app')

@section('title', 'HoBo - Hotels')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Available Hotels</h1>

    <!-- Search Form -->
    <form action="{{ route('hotels.search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" class="form-control" name="location" placeholder="Search by location" value="{{ request('location') }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <!-- Hotels Grid -->
    <div class="row g-4">
        @forelse($hotels as $hotel)
            <div class="col-md-4">
                <div class="card hotel-card h-100">
                    <img src="{{ asset('img/' . basename($hotel->image)) }}" class="card-img-top" alt="{{ $hotel->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $hotel->name }}</h5>
                        <p class="card-text">{{ $hotel->description }}</p>
                        <p class="card-text"><small class="text-muted"><i class="bi bi-geo-alt"></i> {{ $hotel->location }}</small></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="rating">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $hotel->rating)
                                        <i class="bi bi-star-fill text-warning"></i>
                                    @else
                                        <i class="bi bi-star text-warning"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="price">₱{{ number_format($hotel->price_per_night, 2) }}/night</span>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <a href="{{ route('hotels.show', $hotel) }}" class="btn btn-primary w-100">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    No hotels found matching your criteria.
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $hotels->links() }}
    </div>
</div>
@endsection
