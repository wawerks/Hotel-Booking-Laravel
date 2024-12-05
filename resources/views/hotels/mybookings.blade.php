@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">My Bookings</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($bookings->isEmpty())
        <div class="alert alert-info">
            You don't have any bookings yet.
        </div>
    @else
        <div class="row">
            @foreach($bookings as $booking)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        @if($booking->hotel->image)
                            <img src="{{ asset('storage/' . $booking->hotel->image) }}" class="card-img-top" alt="{{ $booking->hotel->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $booking->hotel->name }}</h5>
                            <p class="card-text">
                                <strong>Check-in:</strong> {{ $booking->check_in->format('M d, Y') }}<br>
                                <strong>Check-out:</strong> {{ $booking->check_out->format('M d, Y') }}<br>
                                <strong>Guests:</strong> {{ $booking->guests }}<br>
                                <strong>Total Price:</strong> ${{ number_format($booking->total_price, 2) }}<br>
                                <strong>Status:</strong> 
                                <span class="badge bg-{{ $booking->status === 'confirmed' ? 'success' : ($booking->status === 'cancelled' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </p>
                            <a href="{{ route('hotels.show', $booking->hotel) }}" class="btn btn-primary">View Hotel</a>
                            @if($booking->status === 'pending')
                                <form action="{{ route('bookings.cancel', $booking) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this booking?')">
                                        Cancel Booking
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
