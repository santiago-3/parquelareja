@extends('layouts.admin')

@section('content')
<div class="upper-bar flex-between">
    <h1>Reservas</h1>
    <a class="button-like" href="{{ route('admin.reservations.create') }}">+ Nueva reserva</a>
</div>

<table cellspacing="0">
    <thead>
        <tr>
            <th>Id</th>
            <th>Responsable</th>
            <th>Estado</th>
            <th>Fecha de creación</th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
        <tr data-link="/admin/reservations/{{ $item->id }}/edit">
            <td>{{ $item->id }}</td>
            <td>{{ $item->responsible->name ?? 'N/A' }} {{ $item->responsible->last_name ?? '' }}</td>
            <td>{{ $item->state->name ?? 'N/A' }}</td>
            <td>{{ date('d-m-Y H:i', strtotime($item->created_at)) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="paginator">
    {{ $items->links('vendor.pagination.default') }}
</div>
<script src="/js/lists.js"></script>
@endsection
