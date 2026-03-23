@extends('layouts.admin')

@section('content')
<div class="upper-bar flex-between">
    <h1>Detalles de reservas</h1>
    <a class="button-like" href="{{ route('admin.reservation-extras.create') }}">+ Nuevo detalle</a>
</div>

<table cellspacing="0">
    <thead>
        <tr>
            <th>Res #</th>
            <th>Lugar</th>
            <th>Responsable</th>
            <th>Fechas</th>
            <th>Personas</th>
        </tr>
    </thead>
    <tbody>
        @forelse($items as $item)
        <tr data-link="/admin/reservation-extras/{{ $item->id }}/edit">
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
        </tr>
        @empty
        <tr>
            <td colspan="6" style="text-align: center;">No extra details found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
<div class="paginator">
    {{ $items->links('vendor.pagination.default') }}
</div>
<script src="/js/lists.js"></script>
@endsection
