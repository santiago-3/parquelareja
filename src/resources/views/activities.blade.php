@extends('layout')

@section('content')
<section class="parque page activities">
    <div class="container">
        <div class="content">
            <h1>Próximas Actividades</h1>
            <main>
                @foreach($next_activities as $activity)
                    @if (isset($next_activities->image))
                        <div>{{ $activity->name }}</div>
                        <img src="{{ $activity->image->path }}" alt="{{ $activity->name }}">
                        <div>{{ $activity->description }}</div>
                        <div>{{ $activity->date }}</div>
                        @if (isset($activity->link) && $activity->link != "")
                            <i class="link"><a target="_blank" href="{{ $activity->link }}"> Link</a></i>
                        @endif
                    @endif
                    </div>
                @endforeach
            </main>
            <div class="past-activities">
                @foreach($old_activities as $activity)
                    @if (isset($next_activities->image))
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
