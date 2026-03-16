@extends('layouts.admin')

@section('content')
<h2>Edit Person: {{ $item->name }} {{ $item->last_name }}</h2>

<form action="{{ route('admin.people.update', $item->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div style="margin-bottom: 10px;">
        <label for="name">First Name:</label><br>
        <input type="text" id="name" name="name" value="{{ $item->name }}" required style="width: 300px;">
    </div>

    <div style="margin-bottom: 10px;">
        <label for="last_name">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name" value="{{ $item->last_name }}" required style="width: 300px;">
    </div>

    <div style="margin-bottom: 10px;">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="{{ $item->email }}" required style="width: 300px;">
    </div>

    <div style="margin-bottom: 10px;">
        <label for="phone">Phone:</label><br>
        <input type="text" id="phone" name="phone" value="{{ $item->phone }}" required style="width: 300px;">
    </div>

    <div style="margin-bottom: 10px;">
        <input type="checkbox" id="is_master" name="is_master" value="1" {{ $item->is_master ? 'checked' : '' }}>
        <label for="is_master">Is Master?</label>
    </div>

    <div style="margin-bottom: 10px;">
        <input type="checkbox" id="from_reservation" name="from_reservation" value="1" {{ $item->from_reservation ? 'checked' : '' }}>
        <label for="from_reservation">From Reservation?</label>
    </div>

    <div style="margin-bottom: 10px;">
        <label for="reservation_comments">Reservation Comments:</label><br>
        <textarea id="reservation_comments" name="reservation_comments" rows="3" style="width: 300px;">{{ $item->reservation_comments }}</textarea>
    </div>

    <div style="margin-top: 20px;">
        <button type="submit" style="padding: 8px 15px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;">
            Update Person
        </button>
        <a href="{{ route('admin.people.index') }}" style="margin-left: 10px; text-decoration: none; color: #666;">Cancel</a>
    </div>
</form>

<hr style="margin: 40px 0;">

<div style="background: #fff5f5; padding: 20px; border: 1px solid #feb2b2; border-radius: 4px;">
    <h3 style="color: #c53030; margin-top: 0;">Danger Zone</h3>
    <p>Deleting this person will perform a logical deletion (Soft Delete).</p>
    <form action="{{ route('admin.people.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this person?')">
        @csrf
        @method('DELETE')
        <button type="submit" style="background: #dc3545; color: white; border: none; padding: 8px 12px; cursor: pointer; border-radius: 4px;">
            Delete Person
        </button>
    </form>
</div>
@endsection
