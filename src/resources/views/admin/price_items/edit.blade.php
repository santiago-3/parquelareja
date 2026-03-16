@section('content')

<h2>Edit Price Item: {{ $item->name }}</h2>

<form action="{{ route('admin.price-items.update', $item->id) }}" method="POST">
@csrf
@method('PUT')

<div style="margin-bottom: 15px;">
    <label for="name">Item Name:</label><br>
    <input type="text" id="name" name="name" value="{{ $item->name }}" required style="width: 300px; padding: 8px;">
</div>

<div style="margin-bottom: 15px;">
    <label for="value">Value ($):</label><br>
    <input type="number" step="0.01" id="value" name="value" value="{{ $item->value }}" required style="width: 300px; padding: 8px;">
</div>

<button type="submit" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
    Update Price Item
</button>
<a href="{{ route('admin.price-items.index') }}" style="margin-left: 10px; text-decoration: none; color: #666;">Back to List</a>


</form>

<hr style="margin: 40px 0;">

<form action="{{ route('admin.price-items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this price item?')">
@csrf
@method('DELETE')
<button type="submit" style="background: #dc3545; color: white; border: none; padding: 8px 12px; cursor: pointer; border-radius: 4px;">
Delete Price Item
</button>
</form>
@endsection
