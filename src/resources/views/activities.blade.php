@extends('layout')

@section('content')
<section class="parque page calendar">
    <div class="container">
        <div class="content">
            <h1>Actividades</h1>
          <!--principal-->
            <div class="next_activities">
                <div class="activities_subtitles">
                    <p><i class="fa fa-calendar"></i> Próximas actividades</p>
                </div>
                @foreach($next_activities as $activity)
                <article class="activity">
                    <div class="img-container" style="background-image: url({{ activity.image_path }});"></div>
                    <i class="date">{{ $activity->date }}</i>
                    @if(isset ($activity['link'] && $activity['link'] != "")
                    <i class="link"><a target="_blank" href="{{ activity.link }}"> Link</a></i>
                    @endif
                    <h3 class="title">{{ activity.name }}</h3>
                    <p>{{ $activity['description'] }}</p>
                    <input class="description" type="hidden" value="{{ $activity['description'] }}">
                    <input class="img-url" type="hidden" value="{{ $activity['image_path'] }}">
                </article>
                @endforeach
            </div>

            <!--listado-->
            <div class="previous_activities">
                <div class="activities_subtitles">
                    <p><i class="fa fa-calendar"></i> Actividades anteriores</p>
                </div>
                <!--item de listado-->
                <!-- {% partial "prev-activities" %}  -->
                <hr>
                <div class="custom_links">
                    <ul>
                        <li>
                            <a href="historial-actividades"><i class="fa fa-list"></i> Ver todas las actividades</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="loader">
                <span class="start-hidden loading" >Loading</span>
            </div>

            <div class="activity-modal">
                <div class="container">
                    <div class="close-button">
                        <i class="fa fa-close">&nbsp;</i>
                    </div>
                    <h3></h3>
                    <div class="img-box">
                        <img class="limit-width" src="">
                    </div>
                    <div class="content limit-width">
                        <i class="date" style="font-size: 14px;"></i>
                        @if(isset ($activity['link'] && $activity['link'] != "")
                        <!-- <i class="link"><a target="_blank" href="{{ // $activity['link'] }}" style="font-size: 14px;"></a></i> -->
                        @endif
                        <p></p>
                    </div>
                </div>
            </div>
</section>
@endsection
