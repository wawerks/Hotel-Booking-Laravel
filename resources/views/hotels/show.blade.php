@extends('layouts.app')

@section('title', $hotel->name . ' - HoBo')

@section('content')
<div class="container my-5">
    <div class="row">
        <!-- Hotel Image -->
        <div class="col-md-6 mb-4">
            <img src="{{ asset($hotel->image) }}" class="img-fluid rounded" alt="{{ $hotel->name }}">
        </div>

        <!-- Hotel Details -->
        <div class="col-md-6">
            <h1 class="mb-3">{{ $hotel->name }}</h1>
            
            <div class="d-flex align-items-center mb-3">
                <div class="rating me-3">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $hotel->rating)
                            <i class="bi bi-star-fill text-warning"></i>
                        @else
                            <i class="bi bi-star text-warning"></i>
                        @endif
                    @endfor
                </div>
                <span class="text-muted">({{ $hotel->rating }} / 5)</span>
            </div>

            <p class="mb-3"><i class="bi bi-geo-alt"></i> {{ $hotel->location }}</p>
            
            <p class="lead mb-4">{{ $hotel->description }}</p>

            <h3 class="mb-3">Amenities</h3>
            <div class="row mb-4">
                @foreach($hotel->amenities as $amenity)
                    <div class="col-6 mb-2">
                        <i class="bi bi-check-circle-fill text-success"></i> {{ $amenity }}
                    </div>
                @endforeach
            </div>

            <div class="price-box p-4 bg-light rounded">
                <h2 class="mb-3">₱{{ number_format($hotel->price_per_night, 2) }} <small class="text-muted">/night</small></h2>
                <div class="d-flex gap-2 mb-3">
                    <button class="btn btn-primary btn-lg flex-grow-1" data-bs-toggle="modal" data-bs-target="#bookingModal">
                        Book Now
                    </button>
                    @auth
                        <form action="{{ route('hotels.toggleFavorite', $hotel) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-lg" title="{{ Auth::user()->favoriteHotels()->where('hotel_id', $hotel->id)->exists() ? 'Remove from favorites' : 'Add to favorites' }}">
                                <i class="bi bi-heart{{ Auth::user()->favoriteHotels()->where('hotel_id', $hotel->id)->exists() ? '-fill' : '' }}"></i>
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">Book {{ $hotel->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="bookingForm">
                    <div class="mb-3">
                        <label for="check_in" class="form-label">Check-in Date</label>
                        <input type="date" class="form-control" id="check_in" required>
                    </div>
                    <div class="mb-3">
                        <label for="check_out" class="form-label">Check-out Date</label>
                        <input type="date" class="form-control" id="check_out" required>
                    </div>
                    <div class="mb-3">
                        <label for="guests" class="form-label">Number of Guests</label>
                        <select class="form-control" id="guests" required>
                            @for($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}">{{ $i }} {{ $i == 1 ? 'Guest' : 'Guests' }}</option>
                            @endfor
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Confirm Booking</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set minimum date for check-in to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('check_in').min = today;
        
        // Update check-out minimum date when check-in is selected
        document.getElementById('check_in').addEventListener('change', function() {
            const checkInDate = new Date(this.value);
            const nextDay = new Date(checkInDate);
            nextDay.setDate(checkInDate.getDate() + 1);
            document.getElementById('check_out').min = nextDay.toISOString().split('T')[0];
        });
    });
</script>
@endsection
