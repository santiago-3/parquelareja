<?php

namespace App\Repositories;

use App\Models\Guest;
use App\Models\Reservation;
use App\Models\ReservationExtra;
use App\Models\ReservationHost;

class ReservationRepository extends BaseRepository
{
    const WORKSHOP_ID     = 7;
    const MULTIPURPOSE_ID = 4;

    public function __construct(Reservation $model)
    {
        $this->model = $model;
    }

    public function last() {
        return $this->model
                    ->orderBy('id', 'desc')
                    ->paginate(15);
    }

    public function getReservations($last_period_date, $first_period_date) {
        return ReservationHost::selectRaw('count(*) as hosts_number, concat(p.name," ",p.last_name) as responsible,pl.name as center,lareja_web_reservation_host.from,lareja_web_reservation_host.to')
            ->join('lareja_web_reservation','lareja_web_reservation.id','=','lareja_web_reservation_host.reservation_id')
            ->join('lareja_web_person as p','p.id','=','lareja_web_reservation.responsible_id')
            ->join('lareja_web_place as pl','lareja_web_reservation_host.place_id','=','pl.id')
            ->join('lareja_web_person as h','h.id','=','lareja_web_reservation_host.person_id')
            ->where('lareja_web_reservation_host.from','<',$last_period_date)
            ->where('lareja_web_reservation_host.to','>',$first_period_date)
            ->where('lareja_web_reservation_host.enabled',1)
            ->where('lareja_web_reservation.deleted_at',null)
            ->whereIn('lareja_web_reservation.state_id',[3,5])
            ->groupBy('lareja_web_reservation_host.from','lareja_web_reservation_host.to','pl.id','p.id')
            ->orderBy('p.id')
            ->get();
    }


    public function getWorkshopReservations($last_period_date, $first_period_date) {
        return Reservation::selectRaw('concat(p.name," ",p.last_name) as responsible,DATE_FORMAT(date_from,"%Y-%m-%d") as date_from,DATE_FORMAT(date_to,"%Y-%m-%d") as date_to,people_number')
            ->join('lareja_web_reservation_extra as re','lareja_web_reservation.id','=','re.reservation_id')
            ->join('lareja_web_person as p','p.id','=','lareja_web_reservation.responsible_id')
            ->where('re.date_from','<',$last_period_date)
            ->where('re.date_to','>',$first_period_date)
            ->whereIn('lareja_web_reservation.state_id',[3,5])
            ->where('place_id','=',self::WORKSHOP_ID)
            ->get();
    }

    public function getMultipurposeReservations($last_period_date, $first_period_date) {
        return ReservationExtra::selectRaw('concat(p.name," ",p.last_name) as responsible,DATE_FORMAT(date_from,"%Y-%m-%d") as date,DATE_FORMAT(date_from,"%H:%i") as time_from,DATE_FORMAT(date_to,"%H:%i") as time_to,people_number')
            ->join('lareja_web_person as p','p.id','=','lareja_web_reservation_extra.responsible_id')
            ->where('lareja_web_reservation_extra.date_from','<',$last_period_date)
            ->where('lareja_web_reservation_extra.date_to','>',$first_period_date)
            ->where('place_id','=',self::MULTIPURPOSE_ID)
            ->where('multipurpose_checked','1')
            ->get();
    }

    public function getGuests($last_period_date, $first_period_date) {
        return Guest::selectRaw('concat(nombre," ",apellido) as visitante, fecha')
            ->where('fecha','<=',$last_period_date)
            ->where('fecha','>=',$first_period_date)
            ->orderBy('id')
            ->get();
    }
}
