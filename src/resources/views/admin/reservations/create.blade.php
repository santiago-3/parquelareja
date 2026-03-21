@extends('layouts.admin')

@section('content')
<h2>New Reservation</h2>

<form action="{{ route('admin.reservations.store') }}" method="POST">
    @csrf
    
    <div style="margin-bottom: 15px;">
        <label>Responsible Person:</label><br>
        <select name="responsible_id" required>
            <option value="">-- Select Person --</option>
            @foreach($people as $p)
                <option value="{{ $p->id }}">{{ $p->last_name }}, {{ $p->name }}</option>
            @endforeach
        </select>
    </div>

    <div style="margin-bottom: 15px;">
        <label>State:</label><br>
        <select name="state_id" required>
            @foreach($states as $s)
                <option value="{{ $s->id }}">{{ $s->name }}</option>
            @endforeach
        </select>
    </div>

    <div style="margin-bottom: 15px;">
        <label>Total Amount:</label><br>
        <input type="number" name="total_amount" value="0">
    </div>

    <div style="margin-bottom: 15px;">
        <label>Paid Amount:</label><br>
        <input type="number" name="paid_amount" value="0">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="workshop_people">Workshop People Count:</label><br>
        <input type="number" id="workshop_people" name="workshop_people" value="0" style="width: 100%;" required>
    </div>

    <div style="margin-bottom: 15px;">
        <label for="responsible_category">Category 1:</label><br>
        <input type="text" id="responsible_category" name="responsible_category" value="0" style="width: 100%;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="responsible_category_2">Category 2:</label><br>
        <input type="text" id="responsible_category_2" name="responsible_category_2" value="0" style="width: 100%;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="responsible_category_3">Category 3:</label><br>
        <input type="text" id="responsible_category_3" name="responsible_category_3" value="0" style="width: 100%;">
    </div>

    <div style="margin-bottom: 15px;">
        <input type="checkbox" name="is_keeper" id="is_keeper" value="1">
        <label for="is_keeper">Is Keeper?</label>
    </div>

    <button type="submit">Create Reservation</button>
</form>
@endsection
