@extends('layouts.admin')

@section('content')
<div class="upper-bar flex-between">
    <h1>Items de precio</h1>
    <a class="button-like" href="{{ route('admin.price-items.create') }}">+ Nuevo item</a>
</div>

<table cellspacing="0">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Value ($)</th>
        </tr>
    </thead>
    <tbody>
        @forelse($items as $item)
        <tr data-link="/admin/price-items/{{ $item->id }}/edit">
            <td>{{ $item->id }}</td>
            <td>{{ $item->denomination }}</td>
            <td><strong>${{ number_format($item->price, 2) }}</strong></td>
        </tr>
        @empty
        <tr>
            <td colspan="3" style="text-align: center;">No price items defined.</td>
        </tr>
        @endforelse
    </tbody>
</table>
<script src="/js/lists.js"></script>
@endsection
