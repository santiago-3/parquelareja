<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of activities
     */
	private $weekDays = [
		'Lunes',
		'Martes',
		'Miercoles',
		'Jueves',
		'Viernes',
		'Sábado',
		'Domingo',
	];

	private $months = [
		'Enero',
		'Febrero',
		'Marzo',
		'Abril',
		'Mayo',
		'Junio',
		'Julio',
		'Agosto',
		'Septiembre',
		'Octubre',
		'Noviembre',
		'Diciembre',
	];

    public function index()
    {
        $activities = Activity::where('date', '>', date('Y-m-d H:i:s'))
            ->orderBy('date', 'asc')
			->get()
            ->map(function($activity) {
                $date = \DateTime::createFromFormat('Y-m-d H:i:s', $activity->date);
                $activity->formattedDate = $this->weekDays[$date->format('N')-1] . $date->format(' d \d\e ') . $this->months[$date->format('n')-1] . $date->format(', H:i\h\s');
                return $activity;
            });

        return view('activities', compact('activities'));
    }

    public function past()
    {
        return view('past-activities');
    }

    public function load(Request $request, $offset) {
        $activities	= Activity::where('date', '<', date('Y-m-d H:i:s'))
            ->orderBy('date', 'desc')
            ->offset($offset)
            ->limit(20)
            ->with('image')
            ->get()
            ->map(function($activity) {
				$date = \DateTime::createFromFormat('Y-m-d H:i:s', $activity->date);
                $activity->formattedDate = $this->weekDays[$date->format('N')-1] . $date->format(' j \d\e ') . $this->months[$date->format('n')-1] . $date->format(' \d\e Y, H:i\h\s');
				return $activity;
            });

        return response()->json($activities);
    }
}
