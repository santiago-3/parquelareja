@extends('layout')

@section('content')
<section class="parque page reservas">
    <div class="container">
        <div class="content">
            <h1>Reservas</h1>
            <hr>
            <form method="post" class="reservation-process">
                <!-- <div style="background-color: #fff4c0; box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.1), 0 6px 20px 0 rgba(0, 0, 0, 0.1); border-radius: 10px; padding: 10px 20px 20px">
                    <h3>Aviso Importante para la celebración del 3 de Mayo.</h3>
                    <p>Debido a la alta demanda para la celebración de los 20 años del parque, si necesitás alojarte en esas fechas te sugerimos contactar directamente a:</p>
                    <h4>Mónica K.: <a style="text-align: center; text-decoration: underline" href="tel:+5491133106564">+54911.3310.6564</a></h4>
                </div> -->
                <div class="centros">
                    <div class="radio-field">
                        <input type="radio" name="type" value="centros" checked required>
                        <label>Reserva de Centros y/o Taller</label>
                    </div>
                    <div class="radio-field">
                        <input type="radio" name="type" value="multiuso" required>
                        <label>Aviso de uso de la Multiuso</label>
                    </div>
                    <!--br><span style="color: #999"><i class="fa fa-info-circle" style="width: 20px"></i>El costo por persona es de <strong>AR$ 700.-</strong> por día.</span-->
                    <!--label>Reserva de centros y/o taller</label-->
                </div>
                <div class="multiuso start-hidden">
                    <div class="fields column">
                        <div>
                            <h5>Fecha</h5>
                            <input type="date" id="mp_day">
                            <span>de</span>
                            <select class="mp_from">
                                <option></option>
                                @foreach ($hours_range as $hour)
                                <option value="{{ $hour }}">{{ $hour }}</option>
                                @endforeach
                            </select>
                            <span>a</span>
                            <select class="mp_to">
                                <option></option>
                                @foreach ($hours_range as $hour)
                                <option value="{{ $hour }}">{{ $hour }}</option>
                                @endforeach
                            </select>
                            </select>
                            <span>hs</span>
                        </div>
                        <h5>Actividad</h5>
                        <textarea name="activity" class="activity" maxlength="96" required placeholder="Descripcion breve de hasta 96 caracteres"></textarea>
                        <div>
                            <label>Cantidad de personas</label>
                            <input type="number" class="people_number" name="people_number" required min="1" max="150">
                        </div>
                    </div>
                </div>
                <h3 style="text-decoration: underline">Responsable</h3>
                <div class="contact-fields">
                    <p class="quote">
                        Datos de contacto para la reserva.
                    </p>
                    <input type="text" placeholder="Nombre" name="name" required>
                    <input type="text" placeholder="Apellido" name="last_name" required>
                    <input type="email" placeholder="Email" name="email" required>
                    <input type="tel" placeholder="Teléfono" name="phone" required>
                    <select id="solicitante" type="text" placeholder="Solicitante" name="solicitante" required>
                        <option value="">Seleccione una opción</option>
                        <option value="maestro/a">Maestro/a</option>
                        <option value="mensaje">El mensaje de Silo</option>
                        <option value="organismo">Organismo</option>
                    </select>
                    <div class="category_2">
                        <div class="mensaje start-hidden">
                            <input id="comunity" type="text" placeholder="Comunidad">
                        </div>
                        <div class="organismo start-hidden">
                            <select id="organism" name="team">
                                <option value="centro de estudios humanistas">Centro mundial de estudios humanistas</option>
                                <option value="convergencia de las culturas">Convergencia de las culturas</option>
                                <option value="la comunidad para el desarrollo humano">La Comunidad (para el desarrollo humano)</option>
                                <option value="mundo sin guerras">Mundo sin guerras y sin violencia</option>
                                <option value="partido humanista">Partido Humanista</option>
                            </select>
                            <input id="base_team" type="text" placeholder="Equipo de base" name="responsible_category_3">
                        </div>
                    </div>
                    <textarea placeholder="Comentarios" name="comments"></textarea>
                    <input type="submit" class="button-gray" value="Continuar">
                </div>
            </form>
        </div>
    </div>
    <script src="/js/reservations.js"></script>
</section>
@endsection
