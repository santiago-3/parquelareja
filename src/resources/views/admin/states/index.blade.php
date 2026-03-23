@extends('layouts.admin')

@section('content')
<div class="upper-bar flex-between">
    <h1>Estados de reserva</h1>
    <a class="button-like"  href="{{ route('admin.states.create') }}">+ Agregar estado</a>
</div>

<table cellspacing="0">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
        </tr>
    </thead>
    <tbody>
        @forelse($items as $item)
        <tr data-link="/admin/states/{{ $item->id }}/edit">
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="3" style="text-align: center;">No hay estados cargados</td>
        </tr>
        @endforelse
    </tbody>
</table>
<script src="/js/lists.js"></script>
@endsection
