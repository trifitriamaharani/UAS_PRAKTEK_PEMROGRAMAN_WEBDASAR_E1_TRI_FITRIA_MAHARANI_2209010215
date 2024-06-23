<!-- resources/views/bookings/create.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Booking Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Booking Form</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="patient_id">Patient Name</label>
                <select class="form-control" id="patient_id" name="patient_id" required>
                    @foreach($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="room_id">Room Number</label>
                <select class="form-control" id="room_id" name="room_id" required>
                    @foreach($availableRooms as $room)
                        <option value="{{ $room->id }}">{{ $room->room_number }} - {{ $room->roomLevel->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="check_in_date">Check-In Date</label>
                <input type="date" class="form-control" id="check_in_date" name="check_in_date" required>
            </div>
            <button type="submit" class="btn btn-primary">Check In</button>
        </form>
    </div>
</body>
</html>
