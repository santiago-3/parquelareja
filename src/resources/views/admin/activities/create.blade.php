@extends('layouts.admin')

@section('content')
<h2>Create New Activity</h2>

<form action="{{ route('admin.activities.store') }}" method="POST">
    @csrf
    
    <div style="margin-bottom: 15px;">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required style="width: 100%; max-width: 400px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="date">Date & Time:</label><br>
        <input type="date" id="date" name="date" required>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="place_id">Place:</label><br>
        <select id="place_id" name="place_id" required>
            <option value="">-- Select a Place --</option>
            @foreach($places as $place)
                <option value="{{ $place->id }}">{{ $place->name }}</option>
            @endforeach
        </select>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="link">Link:</label><br>
        <input type="url" id="link" name="link" required style="width: 100%; max-width: 400px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" style="width: 100%; max-width: 400px;"></textarea>
    </div>

    <button type="submit">Save Activity</button>
    <a href="{{ route('admin.activities.index') }}">Cancel</a>
</form>
@endsection
