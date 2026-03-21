@extends('layouts.admin')
@section('content')
    <h1>Actividades</h1>
    <a href="{{ route('admin.activities.create') }}">Create New</a>
    <table cellpadding="5">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Fecha</th>
                <th></th>
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
    <div class="paginator">
        {{ $items->links() }}
    </div>
@endsection
