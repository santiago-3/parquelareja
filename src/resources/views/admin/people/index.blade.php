@extends('layouts.admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center;">
    <h1>People</h1>
    <a href="{{ route('admin.people.create') }}" style="padding: 10px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 4px;">+ Add Person</a>
</div>

<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; margin-top:20px;">
    <thead style="background: #eee;">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Master?</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
        <tr>
            <td>{{ $item->name }} {{ $item->last_name }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->phone }}</td>
            <td>{{ $item->is_master ? 'Yes' : 'No' }}</td>
            <td>
                <a href="{{ route('admin.people.edit', $item->id) }}">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
