@extends('layouts.admin')

@section('content')
<h2>Edit Activity: {{ $item->name }}</h2>

<form action="{{ route('admin.activities.update', $item->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div style="margin-bottom: 15px;">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="{{ $item->name }}" required style="width: 100%; max-width: 400px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="date">Date & Time:</label><br>
        <input type="datetime-local" id="date" name="date" 
               value="{{ date('Y-m-d\TH:i', strtotime($item->date)) }}" required>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="place_id">Place:</label><br>
        <select id="place_id" name="place_id" required>
            @foreach($places as $place)
                <option value="{{ $place->id }}" {{ $item->place_id == $place->id ? 'selected' : '' }}>
                    {{ $place->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="link">Link:</label><br>
        <input id="link" name="link" value="{{ $item->link }}" required style="width: 100%; max-width: 400px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" style="width: 100%; max-width: 400px;">{{ $item->description }}</textarea>
    </div>

    <button type="submit">Update Activity</button>
    <a href="{{ route('admin.activities.index') }}">Back to List</a>
</form>

<hr>

<form action="{{ route('admin.activities.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
    @csrf
    @method('DELETE')
    <button type="submit" style="color: red;">Delete Activity</button>
</form>
@endsection
