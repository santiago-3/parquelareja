@extends('layout')

@section('content')
<section class="parque page activities">
    <div class="container">
        <div class="content">
            <h1>Próximas Actividades</h1>
            <main>
                <div class="upcoming-activities column">
                @foreach($next_activities as $activity)
                    @if (isset($activity->image))
                        <div class="activity">
                            <div class="header">
                                <div class="date">{{ $activity->date }}</div>
                                <div class="title">{{ $activity->name }}</div>
                            </div>
                            <div class="content">
                                <!--<div class="image" style="background-image: url('{{ $activity->image->path }}');"></div>-->
                                <img src="{{ $activity->image->path }}" alt="{{ $activity->name }}">
                                <div class="description">{{ $activity->description }}</div>
                            </div>
                        </div>
                    @endif
                @endforeach
                </div>
            </main>
            <div class="past-activities">
                @foreach($old_activities as $activity)
                    @if (isset($activity->image) && false)
                        <div class="activity">
                            <img src="{{ $activity->image->path }}" alt="{{ $activity->name }}">
                            <div class="title">{{ $activity->name }}</div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
