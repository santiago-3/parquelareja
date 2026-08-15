@extends('layout')

@section('content')
<section class="parque page">
    <div class="container">
        <div class="content">
            <h1>Próximas Actividades</h1>
            <main>
                <div id="activities" class="column">
                @foreach($activities as $activity)
                    @if (isset($activity->image))
                        <div class="activity">
                            <div class="frame">
                                <div class="header">
                                    <div class="date">{{ $activity->date }}</div>
                                    <div class="title">{{ $activity->name }}</div>
                                </div>
                                <div class="content">
                                    <!--<div class="image" style="background-image: url('{{ $activity->image->path }}');"></div>-->
                                    <div class="img"><img src="{{ $activity->image->path }}" alt="{{ $activity->name }}"></div>
                                    <div class="description">{{ $activity->description }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                </div>
            </main>
            <a href="/actividades-pasadas">Ver actividades pasadas</div>
        </div>
    </div>
</section>
@endsection
