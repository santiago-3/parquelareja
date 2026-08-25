<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

class ReservationsController extends Controller
{
    /**
     * Display a listing of reservations
     */
    public function index(Request $request)
    {
		define('MULTIPURPOSE_ID',4);
		$domain = 'http://parquelareja.org';

		$input_data	= $request->all();
		$data['error_status'] = 0;

		if (empty($input_data)){
			$hora_apertura = 9;
			$hora_cierre   = 22;
			$hours_range   = [];
			for ($i = $hora_apertura; $i <= $hora_cierre; $i++){
				$hours_range[] = $i;
			}
			$data['hours_range'] = $hours_range;

            return view('reservations', $data);
        }

		$email_recipient = [
			'reservas@parquelareja.org'  => 'Equipo reservas',
			'figueroa.corinne@gmail.com' => 'Corinne Figueroa',
			'monicakernc@gmail.com'      => 'Monica Kernc',
			'skasu77@hotmail.com'        => 'Susana Grillo',
			'thamm.ferrer@gmail.com'     => 'Tamara Ferrer',
		];

        $responsible = new Person();
        $responsible->name                 = $input_data['name'];
        $responsible->last_name            = $input_data['last_name'];
        $responsible->email                = $input_data['email'];
        $responsible->phone                = $input_data['phone'];
        $responsible->reservation_comments = $input_data['comments'];
        $responsible->from_reservation     = true;
        $responsible->is_master            = false;

        $responsible_email = $responsible->email;

        if ($responsible->save()) {
            if ($input_data['type'] == 'multiuso') {

                $date_parts = explode('-',$input_data['mp_day']);
                $date_from  = $date_parts[2] . '-' . $date_parts[1] . '-' .  $date_parts[0];
                $date_to    = $date_from;
                $date_from .= ' ' . $input_data['mp_from'] . ':00:00';
                $date_to   .= ' ' . $input_data['mp_to'] . ':00:00';

                $usage_notification = new ReservationExtra();
                $usage_notification->place_id       = MULTIPURPOSE_ID;
                $usage_notification->date_from      = $date_from;
                $usage_notification->date_to        = $date_to;
                $usage_notification->people_number  = $input_data['people_number'];
                $usage_notification->details        = $input_data['activity'];
                $usage_notification->responsible_id = $responsible->id;
                if (!$usage_notification->save()){
                    $data['error_status'] = 2;
                }

                $vars = [
                    "person"        => $responsible->name . " " . $responsible->last_name,
                    "email"         => $responsible_email,
                    "phone"         => $responsible->phone,
                    "comments"      => $responsible->reservation_comments,
                    "date"          => $input_data['mp_day'],
                    "time_from"     => $input_data['mp_from'],
                    "time_to"       => $input_data['mp_to'],
                    "people_number" => $input_data['people_number'],
                    "activity"      => $input_data['activity'],
                    "domain"        => $domain
                ];

                session()->put('reservation_status','multipurpose');
                Mail::send('mail.aviso', $vars, function($message) use ($email_recipient,$responsible_email,$vars) {

                    $to = $email_recipient;
                    $message->to($to);
                    $message->subject('Nuevo Aviso de uso de multiuso');

                    if (!is_null($responsible_email) && !empty($responsible_email)) {
                        Mail::send('mail.aviso_responsable', $vars, function($message) use ($responsible_email) {
                            $to = $responsible_email;
                            $message->to($to);
                            $message->subject('Aviso de uso recibido');
                        });
                    }
                });

                session()->put('reservation_status','multipurpose');
            }
            else {
                session()->put('reservation_status','hosts');
            }
        }
        else{
            $data['error_status'] = 1;
        }

        if ($data['error_status'] == 0){
            session()->put('responsible_id',$responsible->id);
            session()->put('responsible_first_name',$responsible->name);
            session()->put('responsible_last_name',$responsible->last_name);
            session()->put('responsible_phone',$responsible->phone);
            session()->put('responsible_email',$responsible->email);
            session()->put('operation_type',$input_data['type']);
            session()->put('responsible_category',$input_data['solicitante']);
            session()->put('responsible_category_2',isset($input_data['responsible_category_2']) ? $input_data['responsible_category_2'] : null);
            session()->put('responsible_category_3',isset($input_data['responsible_category_3']) ? $input_data['responsible_category_3'] : null);
            session()->save();
            header('location: /reservas-paso-2');
            exit;
        }

        return view('reservations.index');
    }

    public function step2(Request $request)
    {
        $user_agent_info = $_SERVER['HTTP_USER_AGENT'];

        $data['is_android_chrome'] = strval(
            strpos(strtolower($user_agent_info), "android") !== FALSE AND
            strpos(strtolower($user_agent_info), "chrome")  !== FALSE
        );

        $data['reservation_status'] = session()->get('reservation_status');
        if (is_null($data['reservation_status'])){
            header('location: /reservas');
            exit;
        }

        $workshop_cat_map = [
            'ceramic' => 'Cerámica',
            'perfume' => 'Perfumería',
            'metals'  => 'Metales',
            'fire'    => 'Producción y conservación de fuego',
            'cold'    => 'Trabajos en frío',
            'glass'   => 'Vidrio'
        ];

        $price_items=[];

        define('MONTO_TALLER_DIA', 150);
        define('MONTO_HOSPEDAJE_DIA', 250);
        define('ADICIONAL_HORNO', 500);

        define('PENDIENTE_DE_APROBACION_ID', 2);

        define('WORKSHOP_ID',7);

        $data['responsible_id']           = session()->get('responsible_id');

        $data['responsible_first_name']   = session()->get('responsible_first_name');
        $data['responsible_last_name']    = session()->get('responsible_last_name');
        $data['responsible_phone']        = session()->get('responsible_phone');
        $data['responsible_email']        = session()->get('responsible_email');
        $data['responsible_name']         = session()->get('responsible_first_name') . " " . ucfirst(session()->get('responsible_last_name'));
        $data['responsible_contact_data'] = session()->get('responsible_phone') . " / " . ucfirst(session()->get('responsible_email'));
        $data['responsible_category']     = session()->get('responsible_category');
        $data['responsible_category_2']   = session()->get('responsible_category_2');
        $data['responsible_category_3']   = session()->get('responsible_category_3');
        $data['operation_type']           = session()->get('operation_type');
        $data['error_status']             = 0;

        $input_data = $request->all();

        if (!empty($input_data)){

            $reservation = new Reservation();
            $reservation->responsible_id = $data['responsible_id'];
            $reservation->state_id = PENDIENTE_DE_APROBACION_ID;
            $reservation->responsible_category   = $data['responsible_category'];
            $reservation->responsible_category_2 = $data['responsible_category_2'];
            $reservation->responsible_category_3 = $data['responsible_category_3'];
            if ($reservation->save()) {
                if (isset($input_data['reserva_centros'])){

                    $price_items[] = 'host_night';
                    $price_items[] = 'linens';

                    foreach($input_data['hosts'] as $input_host){
                        $person = new Person();
                        $person->name      = $input_host['name'];
                        $person->last_name = $input_host['last_name'];

                        if (isset($input_host['email'])){
                            $person->email = $input_host['email'];
                        }
                        $person->from_reservation = 1;
                        if ($person->save()){
                            $host = new ReservationHost();
                            $host->reservation_id = $reservation->id;
                            $host->person_id      = $person->id;
                            $host->from           = implode('-',array_reverse(explode('-',$input_host['date_from'])));
                            $host->to             = implode('-',array_reverse(explode('-',$input_host['date_to'])));
                            $host->place_id       = $input_host['place'];
                            if (!$host->save()){
                                $data['error_status'] = 3;
                                break;
                            }
                        }
                        else{
                            $data['error_status'] = 2;
                            break;
                        }
                    }
                }

                if (isset($input_data['workshop_people'])){

                    $price_items[] = 'workshop_use_day';

                    $workshop = new ReservationExtra();
                    $workshop->place_id       = WORKSHOP_ID;
                    $workshop->reservation_id = $reservation->id;
                    $workshop->date_from      = implode('-',array_reverse(explode('-',$input_data['workshop_from'])));
                    $workshop->date_to        = implode('-',array_reverse(explode('-',$input_data['workshop_to'])));
                    $workshop->people_number  = $input_data['workshop_people'];
                    $workshop->details        = trim($input_data['workshop_comments']) != "" ? $input_data['workshop_comments'] : null;
                    $workshop->oven           = isset($input_data['workshop_oven']);

                    if ($workshop->oven){
                        $price_items[] = 'oven_use';
                    }

                    if (isset($input_data['workshop_categories'])){
                        $categories_value = "";
                        foreach ($input_data['workshop_categories'] as $cat => $ignore){
                            $categories_value .= $workshop_cat_map[$cat] . ',';
                        }
                        $categories_value = trim($categories_value, ',');
                        $workshop->workshop_categories  = $categories_value;
                    }

                    if (!$workshop->save()){
                        $data['error_status'] = 3;
                    }
                }
                /*$reservation->total_amount = $total_amount;*/
                $reservation->save();
                $data['error_status'] = $data->insert_price_items($reservation->id,$price_items) ;
            }
            else {
                $price_items[] = 'workshop_use_day';
                $data['error_status'] = 1;
            }
            if ($data['error_status'] == 0){
                session()->put('reservation_id',$reservation->id);
                session()->put('reserva_centros',isset($input_data['reserva_centros']));
                session()->put('reserva_taller',isset($input_data['reserva_taller']));
                session()->forget('reservation_status');
                session()->forget('responsible_id');
                session()->forget('responsible_first_name');
                session()->forget('responsible_last_name');
                session()->forget('responsible_phone');
                session()->forget('responsible_email');
                session()->forget('responsible_first_name');
                session()->forget('responsible_phone');
                session()->forget('responsible_category');
                session()->forget('responsible_category_2');
                session()->forget('responsible_category_3');
                session()->forget('operation_type');
                session()->save();
                header('location: /reservas-confirm');
                exit;
            }
        }
        else{
            if (!is_null(session()->get('responsible_id'))){
                if ($data['operation_type'] == 'centros') {
                    $data['title'] = "Paso 2: Reserva de Centros y/o Taller"; // Luego volver a: Paso 2: Reserva de centros y/o taller
                }
                elseif ($data['operation_type'] == 'multiuso'){
                    $data['title'] = "Aviso de uso de la multiuso";
                }

            }
            else{
                $data['status'] = 5;
            }
        }

        return view('reservations-step-2', $data);
    }

    public function insert_price_items($reservation_id, $price_items) {

        $prices_data = DB::table('lareja_web_price_item')
            ->select('denomination', 'price')
            ->get();

        $prices = [];
        foreach ($prices_data as $price_row){
            $prices[$price_row->denomination] = $price_row->price;
        }

        foreach($price_items as $item){
            $reservation_host_night_price                 = new ReservationPriceItem();
            $reservation_host_night_price->reservation_id = $reservation_id;
            $reservation_host_night_price->price_item_id  = $item;
            $reservation_host_night_price->price          = $prices[$item];
            if (!$reservation_host_night_price->save()){
                return 3;
                break;
            }
        }
        return 0;
    }
}
