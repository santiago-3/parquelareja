@extends('layouts.admin')

@section('content')
<div class="upper-bar flex-between">
    <h1>Personas</h1>
    <a class="button-like" href="{{ route('admin.people.create') }}">+ Agregar persona</a>
</div>

<table cellspacing="0">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Es maestro</th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
        <tr data-link="/admin/people/{{ $item->id }}/edit">
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }} {{ $item->last_name }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->phone }}</td>
            <td>{{ $item->is_master ? 'Si' : 'No' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="paginator">
    {{ $items->links('vendor.pagination.default') }}
</div>
<script src="/js/lists.js"></script>
@endsection
