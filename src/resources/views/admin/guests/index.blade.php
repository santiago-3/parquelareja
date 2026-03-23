@extends('layouts.admin')

@section('content')
<div class="upper-bar flex-between">
    <h1>Visitantes</h1>
    <a class="button-like" href="{{ route('admin.guests.create') }}">+ Nuevo visitante</a>
</div>

<table cellspacing="0">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Teléfono</th>
        </tr>
    </thead>
    <tbody>
        @forelse($items as $item)
        <tr data-link="/admin/guests/{{ $item->id }}/edit">
            <td>{{ $item->id }}</td>
            <td>{{ $item->nombre }}</td>
            <td>{{ $item->apellido }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->telefono }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align: center;">No hay visitantes registrados</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div class="paginator">
    {{ $items->links('vendor.pagination.default') }}
</div>
<script src="/js/lists.js"></script>
@endsection
