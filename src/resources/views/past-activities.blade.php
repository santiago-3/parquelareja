@extends('layout', ['no-footer' => true])

@section('content')
<section class="parque page activities">
    <div class="container">
        <div class="content">
            <h1>Actividades pasadas</h1>
            <main>
                <div class="past activities">
                    @foreach($activities as $activity)
                        @if (isset($activity->image))
                            <div class="activity">
                                <div class="header">
                                    <div class="date">{{ $activity->date }}</div>
                                    <div class="title">{{ $activity->name }}</div>
                                </div>
                                <div class="content">
                                    <!--<div class="image" style="background-image: url('{{ $activity->image->path }}');"></div>-->
                                    <div class="img"><img src="{{ $activity->image->path }}" alt="{{ $activity->name }}"></div>
                                    <div class="description">{{ $activity->description }}</div>
                                    <div class="vail"></div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </main>
        </div>
    </div>
</section>
@endsection

