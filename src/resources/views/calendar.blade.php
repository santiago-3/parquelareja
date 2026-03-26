@extends('layout')

@section('content')
<section class="parque page calendar">
    <div class="container">
        <div class="content">
            <h1>Calendario de uso</h1>
            <div id="form-container">
                <main class="flex-row-wrap">
                    <div class="left-column">
                        <p>
                            <b>Las reservas de taller aún no se muestran aquí</b> aunque si figuran en los detalles.
                        </p>
                        <p>
                            Haga click en una fecha del calendario para ver los detalles de reservas de ese día.
                        </p>
                        <select name="place">
                            <option value="todos" selected="selected"> Todos los lugares</option>
                            <option value="centros"> Ambos Centros</option>
                            <option value="trabajo"> Centro de Trabajo</option>
                            <option value="estudio"> Centro de Estudio</option>
                            <option value="taller"> Taller</option>
                            <option value="multiuso"> Multiuso</option>
                            <option value="visitantes"> Visitantes</option>
                        </select>
                    </div>
                    <div class="calendars flex-row-wrap">
                        @foreach($months as $month)
                        <div class="month">
                            <div class="name">{{ $month['name'] }}</div>
                            <div class="weeks">
                                <div class="week">
                                    <div class="day">
                                        <span>Lu</span>
                                    </div>
                                    <div class="day">
                                        <span>Ma</span>
                                    </div>
                                    <div class="day">
                                        <span>Mi</span>
                                    </div>
                                    <div class="day">
                                        <span>Ju</span>
                                    </div>
                                    <div class="day">
                                        <span>Vi</span>
                                    </div>
                                    <div class="day">
                                        <span>Sa</span>
                                    </div>
                                    <div class="day">
                                        <span>Do</span>
                                    </div>
                                </div>
                                @foreach($month['weeks'] as $week)
                                <div class="week flex-row-wrap">
                                    @foreach($week as $day)
                                        @php
                                            $occupation = '';
                                            $centers = '';
                                        @endphp
                                        @if( $month['stamp'] != '' && $day != '' && !is_null($details[$month['stamp']] [$day] ['Centro de Estudios']) )
                                            @php
                                                $occupation = ' occupied';
                                                $centers = ' estudio';
                                            @endphp
                                        @endif
                                        @if( $month['stamp'] != '' && $day != '' &&  !is_null($details[$month['stamp']][$day]['Centro de Trabajo']) )
                                            @php
                                                $occupation = ' occupied';
                                                $centers = $centers . ' trabajo';
                                            @endphp
                                        @endif
                                        @if( $month['stamp'] != '' && $day != '' &&  !is_null($details[$month['stamp']][$day]['Taller']) )
                                            @php
                                                $occupation = ' occupied';
                                                $centers = $centers . ' taller';
                                            @endphp
                                        @endif
                                        @if($month['stamp'] != '' && $day != '' &&  !is_null($details[$month['stamp']][$day]['Multiuso']) )
                                            @php
                                                $occupation = ' occupied';
                                                $centers = $centers . ' multiuso';
                                            @endphp
                                        @endif
                                        @if( $month['stamp'] != '' && $day != '' &&  isset($detail[$month['stamp']][$day]['Visitantes']) && !is_null($details[$month['stamp']][$day]['Visitantes']) )
                                            @php
                                                $occupation = ' occupied';
                                                $centers = $centers . ' visitantes';
                                            @endphp
                                        @endif
                                        <div class="day{{ $occupation }}{{ $centers }}" data-daystamp="{{ $month['stamp'] }}-{{ $day }}">
                                            <span>{{ $day }}</span>
                                        </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </main>
                <div class="details">
                    @foreach($details as $year_month => $days)
                        @foreach($days as $day => $places)
                            @if (
                                (isset($places['Centro de Estudios']) && !is_null($places['Centro de Estudios'])) ||
                                (isset($places['Centro de Trabajo']) && !is_null($places['Centro de Trabajo'])) ||
                                (isset($places['Taller']) && !is_null($places['Taller'])) ||
                                (isset($places['Visitantes']) && !is_null($places['Visitantes'])) ||
                                (isset($places['Multiuso']) && !is_null($places['Multiuso']))
                            )
                                <div class="day-detail" data-daystamp="{{ $year_month }}-{{ $day }}">
                                    <h4>{{ $year_month }}-{{ $day }}</h5>
                                    @if(isset($places['Centro de Estudios']) && !is_null($places['Centro de Estudios']))
                                    <div class="detail estudio">
                                        <h5>Centro de Estudios</h5>
                                        @foreach($places['Centro de Estudios'] as $responsible => $conditions)
                                            @foreach($conditions as $condition => $hosts_number)
                                                <div>
                                                    {{ $hosts_number }} Alojado{{ ($hosts_number != 1) ? 's' : '' }}
                                                    @if($condition == 'checkin')
                                                        Ingreso 18:30.
                                                    @endif
                                                    @if($condition == 'checkout')
                                                        Egreso 17:30.
                                                    @endif
                                                    (Resp: {{ $responsible }})
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                    @endif
                                    @if(isset($places['Centro de Trabajo']) && !is_null($places['Centro de Trabajo']))
                                    <div class="detail trabajo">
                                        <h5>Centro de Trabajo</h5>
                                        @foreach($places['Centro de Trabajo'] as $responsible => $conditions)
                                            @foreach($conditions as $condition => $hosts_number)
                                                <div>
                                                    {{ $hosts_number }} Alojado{{ ($hosts_number != 1) ? 's' : '' }}
                                                    @if($condition == 'checkin')
                                                        Ingreso 18:30.
                                                    @endif
                                                    @if($condition == 'checkout')
                                                        Egreso 17:30.
                                                    @endif
                                                    (Resp: {{ $responsible }})
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                    @endif
                                    @if (isset($places['Taller']) && !is_null($places['Taller']))
                                    <div class="detail taller">
                                        <h5>Taller</h5>
                                        @foreach($places['Taller'] as $responsible => $people_number)
                                            <div>
                                                {{ $people_number }} persona{{ ($people_number =! 1) ? 's' : '' }}
                                                (Resp: {{ $responsible }})
                                            </div>
                                        @endforeach
                                    </div>
                                    @endif
                                    @if(isset($places['Multiuso']) && !is_null($places['Multiuso']))
                                        <h5>Multiuso</h5>
                                        @foreach($places['Multiuso'] as $activity)
                                        <div class="detail multiuso">
                                            {{ $activity }}
                                        </div>
                                        @endforeach
                                    @endif
                                    @if(isset($places['Visitantes']) && !is_null($places['Visitantes']))
                                    <div class="detail visitantes">
                                        <h5>Visitantes</h5>
                                        @foreach($places['Visitantes'] as $visitante)
                                            <div>
                                                {{ $visitante }}
                                            </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                </div>
                <div class="details-modal">
                    <div class="container">
                        <div class="close-button">
                            <i class="fa fa-close">&nbsp;</i>
                        </div>
                        <div class="content">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="/js/calendar.js"></script>
@endsection
