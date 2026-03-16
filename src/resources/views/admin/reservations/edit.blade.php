@extends('layouts.admin')

@section('content')
<h2>Edit Reservation #{{ $item->id }}</h2>

<form action="{{ route('admin.reservations.update', $item->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 300px;">
            <div style="margin-bottom: 15px;">
                <label for="responsible_id">Responsible Person:</label><br>
                <select id="responsible_id" name="responsible_id" required style="width: 100%;">
                    @foreach($people as $p)
                        <option value="{{ $p->id }}" {{ $item->responsible_id == $p->id ? 'selected' : '' }}>
                            {{ $p->last_name }}, {{ $p->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="state_id">Reservation State:</label><br>
                <select id="state_id" name="state_id" required style="width: 100%;">
                    @foreach($states as $s)
                        <option value="{{ $s->id }}" {{ $item->state_id == $s->id ? 'selected' : '' }}>
                            {{ $s->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="total_amount">Total Amount:</label><br>
                <input type="number" id="total_amount" name="total_amount" value="{{ $item->total_amount }}" style="width: 100%;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="paid_amount">Paid Amount:</label><br>
                <input type="number" id="paid_amount" name="paid_amount" value="{{ $item->paid_amount }}" style="width: 100%;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label for="workshop_people">Workshop People Count:</label><br>
                <input type="number" id="workshop_people" name="workshop_people" value="{{ $item->workshop_people }}" style="width: 100%;">
            </div>
        </div>

        <div style="flex: 1; min-width: 300px;">
            <div style="margin-bottom: 15px;">
                <label for="responsible_category">Category 1:</label><br>
                <input type="text" id="responsible_category" name="responsible_category" value="{{ $item->responsible_category }}" style="width: 100%;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="responsible_category_2">Category 2:</label><br>
                <input type="text" id="responsible_category_2" name="responsible_category_2" value="{{ $item->responsible_category_2 }}" style="width: 100%;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="responsible_category_3">Category 3:</label><br>
                <input type="text" id="responsible_category_3" name="responsible_category_3" value="{{ $item->responsible_category_3 }}" style="width: 100%;">
            </div>

            <div style="margin-bottom: 15px; margin-top: 30px;">
                <input type="checkbox" id="is_keeper" name="is_keeper" value="1" {{ $item->is_keeper ? 'checked' : '' }}>
                <label for="is_keeper"><strong>Is Keeper?</strong></label>
            </div>
        </div>
    </div>

    <div style="margin-top: 20px; border-top: 1px solid #ccc; padding-top: 20px;">
        <button type="submit" style="padding: 10px 25px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
            Update Reservation
        </button>
        <a href="{{ route('admin.reservations.index') }}" style="margin-left: 15px; text-decoration: none; color: #666;">Cancel</a>
    </div>
</form>

<hr style="margin: 40px 0;">

<div style="background: #fff5f5; padding: 20px; border: 1px solid #feb2b2; border-radius: 4px;">
    <h3 style="color: #c53030; margin-top: 0;">Danger Zone</h3>
    <form action="{{ route('admin.reservations.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this reservation? This cannot be undone.')">
        @csrf
        @method('DELETE')
        <button type="submit" style="background: #dc3545; color: white; border: none; padding: 8px 12px; cursor: pointer; border-radius: 4px;">
            Delete Reservation
        </button>
    </form>
</div>
@endsection
