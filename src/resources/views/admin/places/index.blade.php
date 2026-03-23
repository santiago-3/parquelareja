@extends('layouts.admin')

@section('content')
<div class="upper-bar flex-between">
    <h1>Lugares</h1>
    <a class="button-like" href="{{ route('admin.places.create') }}">+ Nuevo lugar</a>
</div>

<table cellspacing="0">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Capacidad</th>
        </tr>
    </thead>
    <tbody>
        @forelse($items as $item)
        <tr data-link="/admin/places/{{ $item->id }}/edit">
            <td width="5%">{{ $item->id }}</td>
            <td width="60%"><strong>{{ $item->name }}</strong></td>
            <td width="35">{{ $item->capacity }} personas</td>
        </tr>
        @empty
        <tr>
            <td colspan="4" style="text-align: center;">No hay lugares cargados</td>
        </tr>
        @endforelse
    </tbody>
</table>
<script src="/js/lists.js"></script>
@endsection
