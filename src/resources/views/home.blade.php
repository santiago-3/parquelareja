@extends('layout')
@section('content')
<section class="parque page home">
    <div class="container">
        <div class="content">
            <div class="home-gallery">
                <img class="picture" src="{{'imagenes-plr/lugares-portal.jpg' }}">
                <img class="picture" src="{{'imagenes-plr/slider/slider_01.jpg' }}">
                <img class="picture" src="{{'imagenes-plr/slider/slider_10.jpg' }}">
                <img class="picture" src="{{'imagenes-plr/slider/slider_12.jpg' }}">
                <img class="picture" src="{{'imagenes-plr/slider/slider_13.jpg' }}">
                <img class="picture" src="{{'imagenes-plr/slider/slider_14.jpg' }}">
                <img class="picture" src="{{'imagenes-plr/slider/slider_16.jpg' }}">
                <img class="picture" src="{{'imagenes-plr/slider/slider_17.jpg' }}">
                <img class="picture" src="{{'imagenes-plr/slider/slider_18.jpg' }}">
                <img class="picture" src="{{'imagenes-plr/slider/slider_02.jpg' }}">
                <img class="picture" src="{{'imagenes-plr/slider/slider_19.jpg' }}">
                <img class="picture" src="{{'imagenes-plr/slider/slider_03.jpg' }}">
                <img class="picture" src="{{'imagenes-plr/slider/slider_04.jpg' }}">
                <img class="picture" src="{{'imagenes-plr/slider/slider_20.jpg' }}">
                <img class="picture" src="{{'imagenes-plr/slider/slider_05.jpg' }}">
                <img class="picture" src="{{'imagenes-plr/slider/slider_06.jpg' }}">
                <img class="picture" src="{{'imagenes-plr/slider/slider_21.jpg' }}">
                <img class="picture" src="{{'imagenes-plr/slider/slider_07.jpg' }}">
                <img class="picture" src="{{'imagenes-plr/slider/slider_08.jpg' }}">
                <img class="picture" src="{{'imagenes-plr/slider/slider_22.jpg' }}">
                <img class="picture" src="{{'imagenes-plr/slider/slider_09.jpg' }}">
                <img class="picture" src="{{'imagenes-plr/slider/slider_11.jpg' }}">
                <img class="picture" src="{{'imagenes-plr/slider/slider_15.jpg' }}">

            </div>
            <div>
                <div class="home-quote">
                    <q>Si tu profundizas en ti y yo profundizo en mi, ahí nos encontraremos.</q>
                    <p>Silo</p>
                </div>
                <div class="home-description">
                    <p>Los Parques de Estudio y Reflexión son recodos donde reencontrarnos con lo mejor de la interioridad de cada uno. Este y otros parques alrededor del mundo son impulsados por miembros de El Mensaje de Silo y de los Organismos del Movimiento Humanista.</p>
                </div>
                <br>
            </div>
        </div>

        <div class="home-items">
            <div class="home-item">
                <a href="https://silo.net" target="_blank">
                    <img src="/imagenes-plr/silonet.jpg" alt="Silo Net">
                    <div class="home-titles">
                        <h4>Videos, conferencias, imágenes y documentos en www.silo.net</h4>
                    </div>
                </a>
            </div>

            <div class="home-item">
                @if(isset($next_activity))
                <a href="actividades">
                    <div class="home-activity-image" style="background-image: url({{ $next_activity['image_path']}})" alt="Silo Net "></div>
                </a>
                <div class="home-titles">
                    <h4> {{ $next_activity['name'] }}</h4>
                    <p> {{ $next_activity['description'] }}</p>
                </div>
                @endif
            </div>

            <div class="home-item">
                <a href="https://silo.net" target="_blank">
                    <img src="{{'imagenes-plr/silonet.png' }}" alt="Silo Net">
                    <div class="home-titles">
                        <h4>Videos, conferencias, imágenes y documentos en www.silo.net</h4>
                    </div>
                </a>
            </div>
        </div>
        </div>
    </div>
</section>
<script src="/js/home.js"></script>
@endsection
