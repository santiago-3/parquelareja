@extends('layouts.admin')

@section('content')
<div class="upper-bar flex-between">
    <h1>Actividades</h1>
    <a class="button-like" href="{{ route('admin.activities.create') }}">Nueva actividad</a>
</div>

<table cellspacing="0">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Lugar</th>
            <th>Fecha y hora</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
        <tr data-link="/admin/activities/{{ $item->id }}/edit">
            <td width="5%">{{ $item->id }}</td>
            <td width="55%">{{ $item->name }}</td>
            <td width="20%">{{ $item->place->name }}</td>
            <td width="20%">{{ date('d-m-Y H:i', strtotime($item->date)) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="paginator">
    {{ $items->links('vendor.pagination.default') }}
</div>
<script src="/js/lists.js"></script>
@endsection
