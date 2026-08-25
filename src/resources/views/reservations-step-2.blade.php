@extends('layout')

@section('content')
<section class="parque page reservations-step-2">
    @if (isset($responsible_id))
    <div class="container">
        <div class="content">
            <div id="android_chrome_advice">
                <p>
                    Tu navegador web no está completamente soportado<br>
                    Si no desactivas el "modo básico" o "ahorro de datos" es posible que la confirmación de reserva no se muestre correctamente.<br>
                    Por favor desactiva esa función o simplemente revisa tu correo para confirmar la reserva.
                </p>
                <input type="button" class="ok_button" value="Ok">
            </div>
            <div id="reservas-step-2">
                <h1>{{ $title }}</h1>
                <hr>
                @if ($operation_type == 'centros')
                <form method="post">
                    <input type="hidden" id="is_android_chrome" name="is_android_chrome" value="{{ $is_android_chrome }}">
                    <input type="hidden" name="responsible_id" value="{{ $responsible_id }}">
                    <div class="responsible_box">
                        <h3>Responsable</h3>
                        <div class="box_content">
                            <div class="name">{{ $responsible_name }}</div>
                            <div class="contact_data">{{ $responsible_contact_data }}</div>
                        </div>
                    </div>
                    <div class="centros area">
                        <div class="checkbox-line">
                            <input id="centros_check" name="reserva_centros" type="checkbox"><label>Reservamos centro/s</label>
                        </div>
                        <div class="area-content">
                            <label>Alojados</label>
                            <div class="hosts column">
                                <div class="host">
                                    <div class="line">
                                        <input type="text" class="name" placeholder="Nombre" name="hosts[][name]" value="{{ $responsible_first_name }}">
                                        <input type="text" class="last_name" placeholder="Apellido" name="hosts[][last_name]" value="{{ $responsible_last_name }}">
                                        <input type="email" class="email" placeholder="Email" name="hosts[][email]" value="{{ $responsible_email }}">
                                    </div>
                                    <div class="line">
                                        <input type="date" class="date_from" placeholder="Desde" id="date_from" name="hosts[][date_from]">
                                        <input type="date" class="date_to" placeholder="Hasta" id="date_to" name="hosts[][date_to]">
                                        <select class="place" name="hosts[][place]">
                                            <option value="2">Centro de Trabajo</option>
                                            @if (strtolower($responsible_category) == 'maestro/a')
                                            <option value="1">Centro de Estudios</option>
                                            @endif
                                        </select>
                                    </div>
                                    <button class="remove button-red start-hidden blue-link"><i class="fa fa-trash"></i> Eliminar alojade</button>
                                </div>
                            </div>
                            <div class="button-container">
                                <button type="button" class="round-button button-green" id="add_host"><i class="fa fa-user-plus"></i> Agregar alojade</button>
                            </div>
                        </div>
                    </div>
                    <div class="taller area">
                        <div class="checkbox-line">
                            <input id="taller_check" name="reserva_taller" type="checkbox"><label>Reservamos taller</label>
                        </div>
                        <div class="area-content">
                            <div><a target="_blank" class="link_style" href="/storage/app/media/oficio_del_fuego.pdf">Descargar Manual del Taller del oficio del fuego</a></div>
                            <div class="vertical-flex">
                                <label>Fecha</label><span><input type="date" class="workshop_input" id="workshop_from" placeholder="Desde">&nbsp;
                                    <input type="date" id="workshop_to" class="workshop_input" placeholder="Hasta"></span>
                            </div>
                            <div class="vertical-flex">
                                <label>Cantidad de personas</label> <input id="workshop_people" class="workshop_input" type="number">
                            </div>
                            <div>
                                <div class="checkbox-line"><input id="workshop_ceramic" class="workshop_input" type="checkbox"> <label>Cerámica</label></div>
                                <div class="checkbox-line"><input id="workshop_metals" class="workshop_input" type="checkbox"> <label>Metales</label></div>
                                <div class="checkbox-line"><input id="workshop_perfume" class="workshop_input" type="checkbox"> <label>Perfumería</label></div>
                                <div class="checkbox-line"><input id="workshop_fire" class="workshop_input" type="checkbox"> <label>Producción y conservación del fuego</label></div>
                                <div class="checkbox-line"><input id="workshop_cold" class="workshop_input" type="checkbox"> <label>Trabajos en frío</label></div>
                                <div class="checkbox-line"><input id="workshop_glass" class="workshop_input" type="checkbox"> <label>Vidrio</div>
                                <div class="checkbox-line" id="workshop_oven_container"><input id="workshop_oven" class="workshop_input" type="checkbox"> <label>Utilizaremos el horno de vidrio</label> <span class="warning-text">(el uso de gas tiene un costo adicional)</span></div>
                            </div>
                            <div class="vertical-flex">
                                <label>Otros comentarios</label> <textarea id="workshop_comments" class="workshop_input"></textarea>
                            </div>
                        </div>
                    </div>
                    <input class="button-gray" type="submit" value="Continuar">
                </form>
                @elseif($operation_type == 'multiuso')
                <p>Su pedido de aviso de uso ha sido notificado</p>
                @else
                <div>
                    <p>
                        Algo ha salido mal!
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
    @else
    <div>
        <p>
            Algo ha salido mal!
        </p>
    </div>
    @endif
    <script src="/js/library.js"></script>
    <script src="/js/reservations-step-2.js"></script>
</section>
@endsection
