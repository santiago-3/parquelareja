@extends('layout')

@section('content')
<section class="parque page contact-page">
    <div class="container">
        <div class="content">
            @if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
            <h1>Contacto</h1>
            <hr>
            <div class="row centered align-up">
                @if ($sent)
                <div class="">
                    <p class="form-success">
                        Su consulta ha sido enviada. <br>Para enviar otra consulta haga click <a href="/contacto">aquí</a>
                    </p>
                </div>
                @else
                <div class="panel contact-form">
                    <div class="panel-heading">
                        <h3 class="panel-title">DEJANOS TU MENSAJE</h3>
                    </div>

                    <div class="panel-body">
                        <form id="contactForm" class="contact helper-margin-top-25" role="form" action="/contacto" method="POST">
                            <input type="text" name="contactname" placeholder="Nombre" required minlength="4">
                            <input type="text" name="contactsubject" placeholder="Asunto" required minlength="4">
                            <input type="email" name="contactemail" placeholder="Email" required minlength="4">
                            <textarea class="form-control" rows="5" name="contactmessage" placeholder="Mensaje" style="resize:none; overflow: auto;" required minlength="20"></textarea>
                            @csrf
                            <div class="form-group">
                                <button type="submit" class="button-gray">Enviar</button>
                                <!--<button class="g-recaptcha"
                                        data-sitekey="6LcnNJEiAAAAAFz01PXl1ejBCPLykSP6MGYxWrm4"
                                        data-callback='onSubmit'
                                        data-action='submit'>Enviar</button>-->
                            </div>
                        </form>
                    </div>
                </div>
                @endif
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">INFORMACIÓN SOBRE EL PARQUE</h3>
                    </div>
                    <div class="panel-body">
                        <p>Alfonsina Storni 1568<br>La Reja, Partido de Moreno<br>Buenos Aires, Argentina</p>
                        <p>
                            <i class="fa fa-envelope-o"></i>
                            <abbr title="Email"><a href="mailto: info@parquelareja.org }} ">Enviar Email</a>
                        </p>
                        <p>
                            <i class="fa fa-clock-o"></i>
                            <abbr title="Hours">H</abbr>: Consultar horarios en <a href="/uso-de-instalaciones">"Uso de las instalaciones"</a>.
                        </p>
                    </div>
                    <div class="custom-links">
                            <ul>
                                <li><a href="/uso-de-instalaciones"><i class="fa fa-home"></i> Uso de las instalaciones</a></li>
                            </ul>
                    </div>
                    <div class="custom-links">
                            <ul>
                                <li><a href="/como-llegar"><i class="fa fa-car"></i> Cómo llegar</a></li>
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script>
    function onSubmit(token) {
     document.getElementById("contactForm").submit();
    }
</script>
@endsection

