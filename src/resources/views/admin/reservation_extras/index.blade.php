@extends('layouts.admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Reservation Details (Extras)</h1>
    <a href="{{ route('admin.reservation-extras.create') }}" style="padding: 10px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 4px;">+ Add Extra Detail</a>
</div>

<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; margin-top:20px; text-align: left;">
    <thead style="background: #eee;">
        <tr>
            <th>Res #</th>
            <th>Place</th>
            <th>Responsible</th>
            <th>Dates</th>
            <th>People</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($items as $item)
        <tr>
            <td>{{ $item->reservation_id }}</td>
            <td>{{ $item->place->name ?? 'N/A' }}</td>
            <td>{{ $item->responsible->name ?? 'N/A' }}</td>
            <td>
                <small>
                    From: {{ $item->date_from }}<br>
                    To: {{ $item->date_to }}
                </small>
            </td>
            <td>{{ $item->people_number }}</td>
            <td>
                <a href="{{ route('admin.reservation-extras.edit', $item->id) }}">Edit</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" style="text-align: center;">No extra details found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
