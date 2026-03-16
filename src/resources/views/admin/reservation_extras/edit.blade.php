@extends('layouts.admin')

@section('content')
<h2>Add Extra Detail to Reservation</h2>

<form action="{{ route('admin.reservation-extras.store') }}" method="POST">
    @csrf
    
    <div style="display: flex; gap: 20px; margin-bottom: 15px;">
        <div style="flex: 1;">
            <label>Link to Reservation:</label><br>
            <select name="reservation_id" required style="width: 100%;">
                <option value="">-- Select Reservation --</option>
                @foreach($reservations as $res)
                    <option value="{{ $res->id }}">Res #{{ $res->id }} - {{ $res->responsible->name ?? 'Unknown' }}</option>
                @endforeach
            </select>
        </div>
        <div style="flex: 1;">
            <label>Place / Space:</label><br>
            <select name="place_id" required style="width: 100%;">
                <option value="">-- Select Place --</option>
                @foreach($places as $place)
                    <option value="{{ $place->id }}">{{ $place->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div style="display: flex; gap: 20px; margin-bottom: 15px;">
        <div style="flex: 1;">
            <label>Date From:</label><br>
            <input type="datetime-local" name="date_from" required style="width: 100%;">
        </div>
        <div style="flex: 1;">
            <label>Date To:</label><br>
            <input type="datetime-local" name="date_to" required style="width: 100%;">
        </div>
    </div>

    <div style="margin-bottom: 15px;">
        <label>Responsible Person for this Space:</label><br>
        <select name="responsible_id" style="width: 100%;">
            <option value="">-- Select Responsible --</option>
            @foreach($people as $person)
                <option value="{{ $person->id }}">{{ $person->last_name }}, {{ $person->name }}</option>
            @endforeach
        </select>
    </div>

    <div style="margin-bottom: 15px;">
        <label>Number of People:</label><br>
        <input type="number" name="people_number" value="0">
    </div>

    <div style="margin-bottom: 15px;">
        <input type="checkbox" name="oven" id="oven" value="1">
        <label for="oven">Requires Oven?</label>
        
        <input type="checkbox" name="multipurpose_checked" id="multi" value="1" style="margin-left: 20px;">
        <label for="multi">Multipurpose Room Checked?</label>
    </div>

    <div style="margin-bottom: 15px;">
        <label>Workshop Categories:</label><br>
        <input type="text" name="workshop_categories" style="width: 100%;">
    </div>

    <div style="margin-bottom: 15px;">
        <label>Additional Details:</label><br>
        <textarea name="details" rows="3" style="width: 100%;"></textarea>
    </div>

    <button type="submit">Save Details</button>
    <a href="{{ route('admin.reservation-extras.index') }}">Cancel</a>
</form>
@endsection
