<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        $responsible = new Person;
        $responsible->name                 = $input_data['name'];
        $responsible->last_name            = $input_data['last_name'];
        $responsible->email                = $input_data['email'];
        $responsible->phone                = $input_data['phone'];
        $responsible->reservation_comments = $input_data['comments'];
        $responsible->from_reservation     = true;

        $responsible_email = $responsible->email;

        if ($responsible->save()){
            if ($input_data['type'] == 'multiuso'){

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

                Session::put('reservation_status','multipurpose');
                Mail::send('mail.aviso', $vars, function($message) use ($email_recipient,$responsible_email,$vars){

                    $to = $email_recipient;
                    $message->to($to);
                    $message->subject('Nuevo Aviso de uso de multiuso');

                    if (!is_null($responsible_email) && !empty($responsible_email)){
                        Mail::send('mail.aviso_responsable', $vars, function($message) use ($responsible_email){
                            $to = $responsible_email;
                            $message->to($to);
                            $message->subject('Aviso de uso recibido');
                        });
                    }
                });

                Session::put('reservation_status','multipurpose');
            }
            else{
                Session::put('reservation_status','hosts');
            }
        }
        else{
            $data['error_status'] = 1;
        }

        if ($data['error_status'] == 0){
            Session::put('responsible_id',$responsible->id);
            Session::put('responsible_first_name',$responsible->name);
            Session::put('responsible_last_name',$responsible->last_name);
            Session::put('responsible_phone',$responsible->phone);
            Session::put('responsible_email',$responsible->email);
            Session::put('operation_type',$input_data['type']);
            Session::put('responsible_category',$input_data['solicitante']);
            Session::put('responsible_category_2',isset($input_data['responsible_category_2']) ? $input_data['responsible_category_2'] : null);
            Session::put('responsible_category_3',isset($input_data['responsible_category_3']) ? $input_data['responsible_category_3'] : null);
            Session::save();
            header('location: /reservas-step-2');
            exit;
        }

        return view('reservations.index');
    }
}
