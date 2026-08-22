<div class="confirm">
    <p>
        Ha ingresado el siguiente aviso de uso de multiuso
    </p>
</div>
<div>
    <h3>Responsable</h3>
    <p>
       <div>
            {{ person }}
            {% if comments != "" %} ({{ comments }}) {% endif %}
       </div>
       <div><i>{{ email }}, {{ phone }}</i>
    </p>
    <br><br>
    <h3>Actividad</h3>
    <p>
       <div> {{ activity }} </div>
       <div><i>{{ people_number }} personas, {{ date }} de {{ time_from }} a {{ time_to }}hs</i>
    </p>
    <p>
        Haz Click en el siguiente enlace para aprobar la actividad<br>
        <a href="{{ domain }}/backend/lareja/web/reservations/mp_notifications">Aprobar Aviso</a>
    </p>
</div>
