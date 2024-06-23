<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Bookings</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .available-room {
            background-color: #e0ffff; 
        }
        .booked-room {
            background-color: #fdeef4; 
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Room Bookings</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <h2>Available Rooms</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Room Number</th>
                    <th>Level</th>
                    <th>Available</th>
                </tr>
            </thead>
            <tbody>
                @foreach($availableRooms as $room)
                    <tr class="available-room">
                        <td>{{ $room->room_number }}</td>
                        <td>{{ $room->roomLevel->name }}</td>
                        <td>{{ $room->is_available ? 'Yes' : 'No' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>Booked Rooms</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Room Number</th>
                    <th>Level</th>
                    <th>Check-In Date</th>
                    <th>Check-Out Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr class="booked-room">
                        <td>{{ $booking->patient->name }}</td>
                        <td>{{ $booking->room->room_number }}</td>
                        <td>{{ $booking->room->roomLevel->name }}</td>
                        <td>{{ $booking->check_in_date }}</td>
                        <td>{{ $booking->check_out_date ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <hr>

        <h2>Check-In Form</h2>
        <form action="{{ route('rooms.storeCheckIn') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Patient Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="room_number">Room Number</label>
                <input type="text" class="form-control" id="room_number" name="room_number" required>
            </div>
            <div class="form-group">
                <label for="check_in_date">Check-In Date</label>
                <input type="date" class="form-control" id="check_in_date" name="check_in_date" required>
            </div>
            <button type="submit" class="btn btn-primary">Check In</button>
        </form>

        <hr>

        <h2>Check-Out Form</h2>
        <form action="{{ route('rooms.storeCheckOut') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Patient Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="room_number">Room Number</label>
                <input type="text" class="form-control" id="room_number" name="room_number" required>
            </div>
            <div class="form-group">
                <label for="check_out_date">Check-Out Date</label>
                <input type="date" class="form-control" id="check_out_date" name="check_out_date" required>
            </div>
            <button type="submit" class="btn btn-primary">Check Out</button>
        </form>
    </div>
</body>
</html>
