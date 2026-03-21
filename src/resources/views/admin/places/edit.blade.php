@extends('layouts.admin')

@section('content')
<h1>Edit Place</h1>

<form action="{{ route('admin.places.update', $item->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $item->name }}" required>
    </div>

    <div>
        <label for="capacity">Capacity:</label>
        <input type="number" id="capacity" name="capacity" value="{{ $item->capacity }}" required>
    </div>

    <button type="submit">Save Place</button>
</form>

<form action="{{ route('admin.places.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
    @csrf
    @method('DELETE')
    <button type="submit" style="color: red;">Delete Place</button>
</form>
@endsection
