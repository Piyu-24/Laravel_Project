@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Your Booked Vehicles</h1>

    <!-- Display success or error messages -->
    @if(session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    @if ($bookings->isEmpty())
    <p>You don't have any booked vehicles at the moment.</p>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($bookings as $booking)
        <div class="card border rounded-lg shadow-lg">
            <img src="{{ $booking->vehicle->image }}" alt="{{ $booking->vehicle->make }} {{ $booking->vehicle->model }}" class="w-full h-48 object-cover rounded-t-lg">
            <div class="p-4">
                <h3 class="font-semibold">{{ $booking->vehicle->make }} {{ $booking->vehicle->model }}</h3>
                <p>Pickup Location: {{ $booking->pickup_location }}</p>
                <p>Pickup Date: {{ $booking->pickup_date }}</p>
                <p>Return Date: {{ $booking->return_date }}</p>
                <p>Price per day: ${{ number_format($booking->vehicle->price_per_day, 2) }}</p>

                <!-- Cancel booking button -->
                <form action="{{ route('bookings.cancelBooking', $booking->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-lg mt-4 w-full">Cancel Booking</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection

