@extends('layouts.admin')

@section('content')

<h2>Create Price Item</h2>

<form action="{{ route('admin.price-items.store') }}" method="POST">
@csrf

<div style="margin-bottom: 15px;">
    <label for="name">Item Name:</label><br>
    <input type="text" id="name" name="name" required placeholder="e.g. Adult, Minor, Member" style="width: 300px; padding: 8px;">
</div>

<div style="margin-bottom: 15px;">
    <label for="value">Value ($):</label><br>
    <input type="number" step="0.01" id="value" name="value" required style="width: 300px; padding: 8px;">
</div>

<button type="submit" style="padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;">
    Save Price Item
</button>
<a href="{{ route('admin.price-items.index') }}" style="margin-left: 10px; text-decoration: none; color: #666;">Cancel</a>


</form>
@endsection
