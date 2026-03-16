@extends('layouts.admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Reservation Hosts (Guests)</h1>
    <a href="{{ route('admin.guests.create') }}" style="padding: 10px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 4px;">+ Add Host</a>
</div>

<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; margin-top:20px;">
    <thead style="background: #eee;">
        <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Origin (State)</th>
            <th>Reservation #</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($items as $item)
        <tr>
            <td>{{ $item->name }} {{ $item->last_name }}</td>
            <td>{{ $item->category }}</td>
            <td>{{ $item->state->name ?? 'N/A' }}</td>
            <td>Res #{{ $item->reservation_id }}</td>
            <td>
                <a href="{{ route('admin.guests.edit', $item->id) }}">Edit</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align: center;">No hosts registered.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
