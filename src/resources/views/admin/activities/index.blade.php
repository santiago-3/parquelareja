@extends('layouts.admin')
@section('content')
    <h1>Activities</h1>
    <a href="{{ route('admin.activities.create') }}">Create New</a>
    <table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; margin-top:20px;">
        <thead>
            <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->date }}</td>
                <td>
                    <a href="{{ route('admin.activities.edit', $item->id) }}">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
