@extends('layouts.admin')

@section('content')

<div style="display: flex; justify-content: space-between; align-items: center;">
<h1>Price Items</h1>
<a href="{{ route('admin.price-items.create') }}" style="padding: 10px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 4px;">+ Add Price Item</a>
</div>

<table border="1" cellpadding="10" style="width:100%; border-collapse: collapse; margin-top:20px; text-align: left;">
<thead style="background: #eee;">
<tr>
<th>Name</th>
<th>Value ($)</th>
<th style="width: 150px;">Actions</th>
</tr>
</thead>
<tbody>
@forelse($items as $item)
<tr>
<td>{{ $item->denomination }}</td>
<td><strong>${{ number_format($item->price, 2) }}</strong></td>
<td>
</td>
</tr>
@empty
<tr>
<td colspan="3" style="text-align: center;">No price items defined.</td>
</tr>
@endforelse
</tbody>
</table>
@endsection
