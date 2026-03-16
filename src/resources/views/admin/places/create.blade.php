@extends('layouts.admin')

@section('content')
<h1>Create Place</h1>

<form action="{{ route('admin.places.store') }}" method="POST">
    @csrf
    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
    </div>

    <div>
        <label for="capacity">Capacity:</label>
        <input type="number" id="capacity" name="capacity" required>
    </div>

    <button type="submit">Save Place</button>
</form>
@endsection
