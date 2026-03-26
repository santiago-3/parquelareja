<?php

namespace App\Http\Controllers;

use App\Repositories\ReservationRepository;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display the calendar
     */
    public function index(ReservationRepository $reservationRepository)
    {
        define('WORKSHOP_ID',7);
        define('MULTIPURPOSE_ID',4);

        $month_names    = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $today          = new DateTime();
        $one_month      = new DateInterval('P1M');
        $months         = [];

        //
        // Armado de estructura de datos de reservas
        //

        // this_month is the object that will represent each month from
        // 2 months ago up to 3 months ahead
        $first_period_month = (new DateTime())->sub(new DateInterval('P1M'));
        $last_period_month  = (new DateTime())->add(new DateInterval('P4M'));
        $weeks_to_show      = '-';

        $first_period_month_number  = $first_period_month->format('m');
        $first_period_year          = $first_period_month->format('Y');
        $first_period_date          = DateTime::createFromFormat('d-m-Y','01-'.$first_period_month_number.'-'.$first_period_year);

        $last_period_month_number   = $last_period_month->format('m');
        $last_period_year           = $last_period_month->format('Y');
        $last_month_days_number     = $last_period_month->format('t');
        $last_period_date           = DateTime::createFromFormat('d-m-Y',$last_month_days_number.'-'.$last_period_month_number.'-'.$last_period_year);

        $this_month = $first_period_month;

        $reservations          = $reservationRepository->getReservations($last_period_date, $first_period_date);
        $workshop_reservations = $reservationRepository->getWorkshopReservations($last_period_date, $first_period_date);
        $multipurpose          = $reservationRepository->getMultipurposeReservations($last_period_date, $first_period_date);
        $visitantes            = $reservationRepository->getGuests($last_period_date, $first_period_date);

        $iterating_date = clone $first_period_date;

        while ($iterating_date <= $last_period_date){
            $year_and_month = $iterating_date->format('Y-m');
            $day            = $iterating_date->format('d');
            $details[$year_and_month][$day]['Centro de Estudios']   = null;
            $details[$year_and_month][$day]['Centro de Trabajo']    = null;
            $details[$year_and_month][$day]['Taller']               = null;
            $details[$year_and_month][$day]['Multiuso']             = null;
            $iterating_date->add(new DateInterval('P1D'));
        }

        foreach($reservations as $reservation){
            $start_date = DateTime::createFromFormat('Y-m-d',$reservation->from);
            $end_date   = DateTime::createFromFormat('Y-m-d',$reservation->to);
            $iterating_date = clone $start_date;
            while ($iterating_date <= $end_date){
                $year_and_month = $iterating_date->format('Y-m');
                $day            = $iterating_date->format('d');

                $condition = "";
                if ($iterating_date == $start_date){
                    $condition = "checkin";
                }
                else if($iterating_date == $end_date){
                    $condition = "checkout";
                }
                else{
                    $condition = "transit";
                }
                if (isset($details[$year_and_month][$day][$reservation->center][$reservation->responsible][$condition])){
                    $details[$year_and_month][$day][$reservation->center][$reservation->responsible][$condition] += intval($reservation->hosts_number);
                }
                else{
                    $details[$year_and_month][$day][$reservation->center][$reservation->responsible][$condition] = intval($reservation->hosts_number);
                }
                $iterating_date->add(new DateInterval('P1D'));
            }
        }

        foreach($workshop_reservations as $reservation){
            $start_date = DateTime::createFromFormat('Y-m-d',$reservation->date_from);
            $end_date   = DateTime::createFromFormat('Y-m-d',$reservation->date_to);
            $iterating_date = clone $start_date;
            while ($iterating_date <= $end_date){
                $year_and_month = $iterating_date->format('Y-m');
                $day            = $iterating_date->format('d');
                $details[$year_and_month][$day]['Taller'][$reservation->responsible] = $reservation->people_number;
                $iterating_date->add(new DateInterval('P1D'));
            }
        }

        foreach($visitantes as $visitante){
            $start_date = DateTime::createFromFormat('Y-m-d',$visitante->fecha);
            $end_date   = DateTime::createFromFormat('Y-m-d',$visitante->fecha);
            $iterating_date = clone $start_date;
            while ($iterating_date <= $end_date){
                $year_and_month = $iterating_date->format('Y-m');
                $day            = $iterating_date->format('d');
                $details[$year_and_month][$day]['Visitantes'][] = $visitante->visitante;
                $iterating_date->add(new DateInterval('P1D'));
            }
        }

        $details[$year_and_month][$day]['Multiuso'] = [];

        foreach($multipurpose as $notification){
            $date = DateTime::createFromFormat('Y-m-d',$notification->date);
            $year_and_month = $date->format('Y-m');
            $day            = $date->format('d');
            $description    = $notification->people_number . ' persona';
            if ($notification->people_number != 1) $description .= 's';
            $description   .= ' de ' . $notification->time_from . ' a ' . $notification->time_to;
            $description   .= ' (Resp: ' . $notification->responsible . ')';
            $details[$year_and_month][$day]['Multiuso'][] = $description;
        }

        //
        // Armado del calendario en si
        //

        for ($i=0; $i<6; $i++){
            $this_month_number       = $this_month->format('m');
            $this_month_year         = $this_month->format('Y');
            $first_day_of_this_month = DateTime::createFromFormat('d-m-Y','01-'.$this_month_number.'-'.$this_month_year);

            $month_start_shift = $first_day_of_this_month->format('w') - 1;
            if ($month_start_shift < 0){
                $month_start_shift += 7;
            }
            $month_days_number = $first_day_of_this_month->format('t');
            $weeks_to_show     = ceil(($month_start_shift + $month_days_number) / 7);
            $current_day       = 1;
            $current_month     = [];

            for ($week=0; $week<$weeks_to_show; $week++){
                $current_week = [];
                if ($week == 0){
                    for ($j = 0; $j<7; $j++){
                        if ($j < $month_start_shift){
                            $current_week[] = '';
                        }
                        else{
                            $current_week[] = str_pad(strval($current_day),2,'0',STR_PAD_LEFT);
                            $current_day++;
                        }
                    }
                }
                else{
                    for ($j = 0; $j< 7; $j++){
                        if ($current_day <= $month_days_number){
                            $current_week[] = str_pad(strval($current_day),2,'0',STR_PAD_LEFT);
                            $current_day++;
                        }
                        else{
                            $current_week[] = '';
                        }
                    }
                }
                $current_month[] = $current_week;
            }
            $months[] = [
                "name"  => $month_names[$this_month->format('n')-1] . ' / ' . $this_month_year,
                "weeks" => $current_month,
                "stamp" => $this_month_year.'-'.$this_month_number
            ];
            $this_month = $first_day_of_this_month->add($one_month);
        }

        // $this->addJs('assets/js/calendario-de-uso.js');

        return view('calendar', compact('months', 'details'));
    }
}
