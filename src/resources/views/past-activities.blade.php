@extends('layout', ['no-footer' => true])

@section('content')
<section class="parque page activities-page">
    <div class="container">
        <div class="content">
            <h1>Actividades pasadas</h1>
            <main>
                <div id="activities" class="past">
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
                                        <div class="vail"></div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div id="loader">Loading</div>
            </main>
        </div>
    </div>
    <script src="/js/library.js"></script>
    <script src="/js/past-activities.js"></script>
</section>
@endsection

