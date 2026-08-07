@extends('layout')
@section('content')
<section class="uso page">
    <div class="container">
        <div class="content">
            <h1>Como llegar</h1>
            <hr>
            <div class="centered">
                <div class="column centered tight">
                    <div class="row">
                        <div class="panel panel-info">
                            <div class="panel-heading"><b>En Auto</b></div>
                            <div class="panel-body">
                                <p>Ir por Autopista Acceso Oeste hasta Km. 38. Tomar la Salida llamada la “La
                                    Reja”.
                                    Cruzar la Autopista y seguir en línea recta hasta el Cementerio. Girar a la
                                    derecha
                                    por el Cementerio ingresando a la calle Crisólogo Larralde. Seguir una cuadra
                                    hasta
                                    la Av. Alfonsina Storni. Girar a la Izquierda por Alfonsina Storni hasta ver el
                                    parque,
                                    luego de 6 cuadras.
                                </p>
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading"><b>En Tren</b></div>
                            <div class="panel-body">
                                <p>Tomar la Línea Sarmiento en cualquiera de sus estaciones, con rumbo a Moreno
                                    (Estación
                                    Terminal). El tiempo estimado de viaje entre Cabeceras es de una hora y media.
                                    Luego
                                    desde Moreno hay un tren que va a La Reja pero tiene muy poca frecuencia. Por
                                    lo
                                    cual no está muy recomendado su uso. Es más recomendable ir desde Moreno a La
                                    Reja
                                    en Bus. Tomar las líneas 501, ramales 01, 10, 22, 24, 26, 38 (Transporte La
                                    Perlita)
                                    o 327 ramales 1 y 2, y bajar en la estación La Reja. El Parque se encuentra a
                                    250
                                    metros de dicha estación, hacia la derecha sin cruzar las vías.
                                </p>
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading"><b>En Bus</b></div>
                            <div class="panel-body">
                                <p>Tomar la Línea 57 (Transportes Atlántida) en Plaza Italia o Plaza Miserere, con
                                    destino
                                    a Moreno. Tomar las líneas 501, ramales 01, 10, 22, 24, 26, 38 (Transporte La
                                    Perlita)
                                    o 327 ramales 1 y 2, y bajar en la estación La Reja. El Parque se encuentra a
                                    250
                                    metros de dicha estación, hacia la derecha sin cruzar las vías.
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div id="panel-como-llegar">
                        <h3>Plano para llegar</h3>
                        <p>Las líneas punteadas naranja muestran cómo llegar desde Acceso Oeste en auto.</p>
                        <p>Las líneas punteadas azules muestran cómo llegar desde la estación La Reja.</p>
                        <img src="imagenes-plr/croquis.png" alt="">
                        <hr>
                        <!--Google Map-->
                        <div>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26259.30962630549!2d-58.85116667683842!3d-34.644253648722696!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bc9409261c0d19%3A0xea6f56e656214f!2sParque+de+Estudio+y+Reflexi%C3%B3n+La+Reja!5e0!3m2!1ses-419!2sar!4v1524429326342"
                                width="100%" height="450" frameborder="0" style="border:0" allowfullscreen=""></iframe>
                        </div>
                    </div>
                </div><!-- column -->
            </div><!-- centered -->
        </div><!-- content -->
    </div><!-- container -->
</section>
@endsection 
