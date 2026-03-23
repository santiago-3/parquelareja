@extends('layouts.admin')

@section('content')
<h2>Editar visitante: {{ $item->nombre }} {{ $item->apellido }}</h2>

<form action="{{ route('admin.guests.update', $item->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div style="margin-bottom: 10px;">
        <label for="name">Nombre:</label><br>
        <input type="text" id="name" name="nombre" value="{{ $item->nombre }}" required style="width: 300px;">
    </div>

    <div style="margin-bottom: 10px;">
        <label for="last_name">Apellido:</label><br>
        <input type="text" id="last_name" name="apellido" value="{{ $item->apellido }}" required style="width: 300px;">
    </div>

    <div style="margin-bottom: 10px;">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="{{ $item->email }}" required style="width: 300px;">
    </div>

    <div style="margin-bottom: 10px;">
        <label for="phone">Teléfono:</label><br>
        <input type="text" id="phone" name="telefono" value="{{ $item->telefono }}" required style="width: 300px;">
    </div>

    <div style="margin-bottom: 10px;">
        <label for="date">Date:</label><br>
        <input type="date" id="date" name="fecha" value="{{ $item->telefono }}" style="width: 300px;">
    </div>

    <div style="margin-top: 20px;">
        <button type="submit" style="padding: 8px 15px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;">
            Update Visitante
        </button>
        <a href="{{ route('admin.people.index') }}" style="margin-left: 10px; text-decoration: none; color: #666;">Cancel</a>
    </div>
</form>

<hr style="margin: 40px 0;">

<div style="background: #fff5f5; padding: 20px; border: 1px solid #feb2b2; border-radius: 4px;">
    <h3 style="color: #c53030; margin-top: 0;">Danger Zone</h3>
    <p>Deleting this visitante will perform a logical deletion (Soft Delete).</p>
    <form action="{{ route('admin.people.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this person?')">
        @csrf
        @method('DELETE')
        <button type="submit" style="background: #dc3545; color: white; border: none; padding: 8px 12px; cursor: pointer; border-radius: 4px;">
            Delete Visitante
        </button>
    </form>
</div>
@endsection
