@extends('layouts.admin')

@section('content')
<h2>Create New State</h2>

<form action="{{ route('admin.states.store') }}" method="POST">
    @csrf
    
    <div style="margin-bottom: 15px;">
        <label for="name">State Name:</label><br>
        <input type="text" id="name" name="name" required placeholder="e.g. Pending, Confirmed, Cancelled" style="width: 100%; max-width: 400px; padding: 8px;">
    </div>

    <div style="margin-top: 20px;">
        <button type="submit" style="padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;">
            Save State
        </button>
        <a href="{{ route('admin.states.index') }}" style="margin-left: 10px; text-decoration: none; color: #666;">Cancel</a>
    </div>
</form>
@endsection
