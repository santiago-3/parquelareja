@extends('layouts.admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Places</h1>
    <a href="{{ route('admin.places.create') }}" style="padding: 10px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 4px;">+ Add New Place</a>
</div>

<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; margin-top:20px; text-align: left;">
    <thead style="background: #eee;">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Capacity</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($items as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td><strong>{{ $item->name }}</strong></td>
            <td>{{ $item->capacity }} people</td>
            <td>
                <a href="{{ route('admin.places.edit', $item->id) }}">Edit</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" style="text-align: center;">No places found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
