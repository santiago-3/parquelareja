@extends('layouts.admin')

@section('content')
<h2>Edit State: {{ $item->name }}</h2>

<form action="{{ route('admin.states.update', $item->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div style="margin-bottom: 15px;">
        <label for="name">State Name:</label><br>
        <input type="text" id="name" name="name" value="{{ $item->name }}" required style="width: 100%; max-width: 400px; padding: 8px;">
    </div>

    <div style="margin-top: 20px;">
        <button type="submit" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
            Update State
        </button>
        <a href="{{ route('admin.states.index') }}" style="margin-left: 10px; text-decoration: none; color: #666;">Back to List</a>
    </div>
</form>

<hr style="margin: 40px 0;">

<div style="background: #fff5f5; padding: 20px; border: 1px solid #feb2b2; border-radius: 4px;">
    <h3 style="color: #c53030; margin-top: 0;">Danger Zone</h3>
    <p>Warning: Deleting a state may cause errors in Reservations that are currently using it.</p>
    <form action="{{ route('admin.states.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this state?')">
        @csrf
        @method('DELETE')
        <button type="submit" style="background: #dc3545; color: white; border: none; padding: 8px 12px; cursor: pointer; border-radius: 4px;">
            Delete State
        </button>
    </form>
</div>
@endsection
