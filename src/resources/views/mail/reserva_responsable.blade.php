<div class="confirm">
    <p>
        Hola, hemos recibido tu pedido de reserva.<br>Recibirás un mail cuando la reserva sea confirmada.<br>Gracias.
    </p>
</div>
<div class="places">
    {% for place,dates in places %}
    <div class="place">
        <h3>{{ place }}</h3>
        <div class="content">
            <div class="dates">
            {% for date,people in dates %}
                <div class="date">
                    <h4>{{ date }}</h4>
                    <div class="people">
                    {% for person in people %}
                        <div>
                        {{ person }}
                        </div>
                    {% endfor %}
                    </div>
                </div>
            {% endfor %}
            </div>
         </div>
    </div>
    {% endfor %}
    {% if reserva_taller %}
        <div class="place">
            <h3>Taller</h3>
            <div class="content">
                <h4>{{ workshop_date_range }}</h4>
                <div>{{ workshop_people }} personas</div>
                {% for cat in workshop_categories %}
                    <div>-{{ cat }}</div>
                {% endfor %}
                {% if workshop_oven %}
                    <div><span class="warning-text">Se incluye uso de horno de vidrio ($500)</span></div>
                {% endif %}
             </div>
        </div>
    {% endif %}
</div>
