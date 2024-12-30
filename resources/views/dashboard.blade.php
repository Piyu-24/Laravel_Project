<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl bg-gray-800 leading-tight">

        </h2>
    </x-slot>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif


    <style>
        .search-form {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin: 20px 30%;
            width: 100%;
        }

        .search-form input {
            padding: 5px 150px;
            border: 1px solid #FDA521;
            border-radius: 5px 0 0 5px;
            outline: none;
            font-size: 15px;
        }

        .search-form button {
            padding: 5px 10px;
            background-color: #FDA521;
            border: none;
            color: #033043;
            border-radius: 0 5px 5px 0;
            font-weight: bold;
            cursor: pointer;
        }

        .search-form button:hover {
            background-color: #0A7273;
            color: #E9E3D5;
        }

        .vehicle-list {
            display: grid;
            gap: 20px;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        }

        .vehicle-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .vehicle-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .vehicle-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .vehicle-card .details {
            padding: 16px;
        }

        .vehicle-card .details h4 {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .vehicle-card .details p {
            font-size: 0.9rem;
            color: #666;
        }

        .vehicle-card .details .price {
            font-size: 1.1rem;
            font-weight: bold;
            color: #FDA521;
        }

        .vehicle-card .details .book-now-button {
            margin-top: 16px;
            background-color: #FDA521;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
        }

        .vehicle-card .details .book-now-button:hover {
            background-color: #0A7273;
        }

        /* Basic button style */
        .book-now-btn {
            background-color: #4CAF50; /* Green background */
            color: white; /* White text */
            padding: 9px 20px; /* Padding around text */
            text-align: center; /* Center text */
            text-decoration: none; /* Remove underline */
            display: inline-block; /* Inline block for button alignment */
            font-size: 16px; /* Text size */
            border-radius: 5px; /* Rounded corners */
            border: none; /* Remove border */
            cursor: pointer; /* Pointer cursor on hover */
            transition: background-color 0.3s, transform 0.2s; /* Transition for hover effect */
        }

        .book-now-btn:hover {
            background-color: #45a049; /* Darker green on hover */
            transform: scale(1.05); /* Slightly enlarge the button on hover */
        }

        .book-now-btn:focus {
            outline: none; /* Remove outline when focused */
        }


        .submit-btn {
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }

        .submit-btn:hover {
            background-color: #45a049; /* Darker green */
            box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        .submit-btn:active {
            background-color: #3e8e41; /* Even darker green */
            box-shadow: 0px 3px 4px rgba(0, 0, 0, 0.2);
            transform: translateY(2px);
        }

        .submit-btn:disabled {
            background-color: #ddd;
            color: #999;
            cursor: not-allowed;
        }

    </style>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Welcome!") }}

                    <!-- Display session status if exists -->
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <!-- Display user role -->
                    <div class="mt-4">
                        <strong>Your role is:</strong> {{ Auth::user()->role->role_name }}
                    </div>

                    <!-- Search Form -->
                    <div class="search-form">
                        <form action="{{ route('search') }}" method="GET" >
                            <input type="text" name="search" placeholder="Vehicle model..." value="{{ request()->query('search') }}" required>
                            <button type="submit">Search</button>
                        </form>
                    </div>


                    <!-- Available Vehicles Section -->
                    <h3 class="text-lg font-semibold mt-4">Available Vehicles</h3>

                    <div class="vehicle-list">
                        @foreach ($vehicles as $vehicle)
                        @if ($vehicle->availability && !$vehicle->bookings->where('user_id', auth()->id())->isNotEmpty())
                        <!-- Vehicle Available for Booking -->
                        <div class="vehicle-card">
                            <img src="{{ asset($vehicle->image) }}" alt="{{ $vehicle->make }} {{ $vehicle->model }}">

                            <div class="details">
                                <h4>{{ $vehicle->make }} {{ $vehicle->model }}</h4>
                                   <p>Year: {{ $vehicle->year }}</p>
                                <p>Color: {{ $vehicle->color }}</p>
                                <p>Price per day: ${{ number_format($vehicle->price_per_day, 2) }}</p>

                                <button
                                    class="book-now-btn bg-blue-500 text-white p-2 rounded hover:bg-blue-600"
                                    data-vehicle-id="{{ $vehicle->id }}">
                                    Book Now
                                </button>


                            </div>
                        </div>
                        @elseif ($vehicle->availability)
                        <!-- Vehicle Already Booked by the Current User -->
                        <div class="vehicle-card bg-gray-200">
                            <div class="details">
                                <p class="text-center text-gray-500">You have already booked this vehicle.</p>
                            </div>
                        </div>

                        @else
                        <!-- Vehicle Booked -->
                        <div class="vehicle-card bg-white opacity-50">
                            <img src="{{ asset($vehicle->image) }}" alt="{{ $vehicle->make }} {{ $vehicle->model }}">
                            <div class="details">
                                <h4>{{ $vehicle->make }} {{ $vehicle->model }}</h4>
                                <p>Year: {{ $vehicle->year }}</p>
                                <p>Color: {{ $vehicle->color }}</p>
                                <p>Price per day: ${{ number_format($vehicle->price_per_day, 2) }}</p>
                                <p class="text-sm text-red-600">Booked</p>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="bookingModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded" id="closeModalButton">Close</button>
            <h2 class="text-xl font-bold mb-4">You can book your vehicle now !</h2>
            <form id="bookingForm" method="POST" action="{{ route('book.store') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="vehicle_id" id="vehicle_id">

                <!-- Name -->
                <div>
                    <label for="name" class="block font-semibold">Name:</label>
                    <input type="text" id="name" name="name" class="w-full border p-2 rounded" required>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block font-semibold">Email:</label>
                    <input type="email" id="email" name="email" class="w-full border p-2 rounded" required>
                </div>

                <!-- Contact Number -->
                <div>
                    <label for="contact_number" class="block font-semibold">Contact Number:</label>
                    <input type="text" id="contact_number" name="contact_number" class="w-full border p-2 rounded" required>
                </div>

                <div class="form-group">
                    <label for="vehicle_type" class="block font-semibold">Vehicle Type:</label>
                    <select id="vehicle_type" name="vehicle_type" class="w-full border p-2 rounded" required>
                        <option value="" disabled selected>Please select</option>
                        <option value="car">Car</option>
                        <option value="jeep">Jeep</option>
                        <option value="van">Van</option>
                        <option value="suv">SUV</option>
                    </select>
                </div>


                <!-- Pickup Location -->
                <div class="form-group">
                    <label for="pickup_location" class="block font-semibold">Pickup Location:</label>
                    <select id="pickup_location" name="pickup_location" class="w-full border p-2 rounded" required>
                        <option value="" disabled selected>Please select</option>
                        <option value="Colombo">Colombo</option>
                        <option value="Kandy">Kandy</option>
                        <option value="Galle">Galle</option>
                        <option value="Jafna">Jafna</option>
                        <option value="Negombo">Negombo</option>
                    </select>
                </div>



                <!-- Pickup Date -->
                <div>
                    <label for="pickup_date" class="block font-semibold">Pickup Date:</label>
                    <input type="date" id="pickup_date" name="pickup_date" class="w-full border p-2 rounded" required>
                </div>

                <!-- Return Date -->
                <div>
                    <label for="return_date" class="block font-semibold">Return Date:</label>
                    <input type="date" id="return_date" name="return_date" class="w-full border p-2 rounded" required>
                </div>

                <!-- Submit Button -->
                <div class="modal-footer">

                    <button type="submit" class="submit-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const bookingModal = document.getElementById('bookingModal');
            const openModalButtons = document.querySelectorAll('.book-now-btn');
            const closeModalButton = document.getElementById('closeModalButton');

            openModalButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const vehicleId = this.dataset.vehicleId;
                    document.getElementById('vehicle_id').value = vehicleId;
                    bookingModal.classList.remove('hidden');
                });
            });

            closeModalButton.addEventListener('click', function () {
                bookingModal.classList.add('hidden');
            });

            window.addEventListener('click', function (event) {
                if (event.target === bookingModal) {
                    bookingModal.classList.add('hidden');
                }
            });
        });
    </script>


</x-app-layout>
