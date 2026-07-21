<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $next_activities = Activity::where('date', '>', date('Y-m-d H:i:s'))->orderBy('date', 'asc')->limit(1)->get();
        $next_activity = null;
        if (!$next_activities->isEmpty()){
            if (!is_null($next_activities[0]->picture)){
                $next_activities[0]['image_path'] = $next_activities[0]->picture->getPath();
            }
            $next_activity = $next_activities[0];
        }
        $videos = [
            [
                "name" => "El mensaje de silo",
                "path" => "/storage/app/media/videos/elmensajedesilo.mp4"
            ],
            [
                "name" => "Día del testimonio",
                "path" => "/storage/app/media/videos/diadeltestimonio.mp4"
            ],
            [
                "name" => "Conciencia inspirada",
                "path" => "/storage/app/media/videos/concienciainspirada.mp4"
            ]
        ];
        $video = $videos[ rand(0,2) ];
        //  $this->addJs('assets/js/home.js');

        return view('home', compact('video', 'next_activity'));

    }
}	
