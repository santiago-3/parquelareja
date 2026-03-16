@extends('layouts.admin')

@section('content')
<h2>Add Person</h2>

<form action="{{ route('admin.people.store') }}" method="POST">
    @csrf
    <div style="margin-bottom: 10px;">
        <label>First Name:</label><br>
        <input type="text" name="name" required style="width: 300px;">
    </div>
    <div style="margin-bottom: 10px;">
        <label>Last Name:</label><br>
        <input type="text" name="last_name" required style="width: 300px;">
    </div>
    <div style="margin-bottom: 10px;">
        <label>Email:</label><br>
        <input type="email" name="email" required style="width: 300px;">
    </div>
    <div style="margin-bottom: 10px;">
        <label>Phone:</label><br>
        <input type="text" name="phone" required style="width: 300px;">
    </div>
    <div style="margin-bottom: 10px;">
        <input type="checkbox" id="is_master" name="is_master" value="1">
        <label for="is_master">Is Master?</label>
    </div>
    <div style="margin-bottom: 10px;">
        <label>Reservation Comments:</label><br>
        <textarea name="reservation_comments" rows="3" style="width: 300px;"></textarea>
    </div>

    <button type="submit">Save Person</button>
    <a href="{{ route('admin.people.index') }}">Cancel</a>
</form>
@endsection
