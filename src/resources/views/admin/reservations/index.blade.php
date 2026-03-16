@extends('layouts.admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Reservations</h1>
    <a href="{{ route('admin.reservations.create') }}" style="padding: 10px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 4px;">+ New Reservation</a>
</div>

<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; margin-top:20px;">
    <thead style="background: #eee;">
        <tr>
            <th>ID</th>
            <th>Responsible</th>
            <th>State</th>
            <th>Paid / Total</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->responsible->name ?? 'N/A' }} {{ $item->responsible->last_name ?? '' }}</td>
            <td>{{ $item->state->name ?? 'N/A' }}</td>
            <td>${{ $item->paid_amount }} / ${{ $item->total_amount }}</td>
            <td>
                <a href="{{ route('admin.reservations.edit', $item->id) }}">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
