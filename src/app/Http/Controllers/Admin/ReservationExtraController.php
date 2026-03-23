<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ReservationExtraRepository;
use App\Repositories\ReservationRepository;
use App\Repositories\PlaceRepository;
use App\Repositories\PersonRepository;
use Illuminate\Http\Request;

class ReservationExtraController extends Controller
{
    protected $repo;
    protected $resRepo;
    protected $placeRepo;
    protected $personRepo;

    public function __construct(
        ReservationExtraRepository $repo,
        ReservationRepository $resRepo,
        PlaceRepository $placeRepo,
        PersonRepository $personRepo
    ) {
        $this->repo = $repo;
        $this->resRepo = $resRepo;
        $this->placeRepo = $placeRepo;
        $this->personRepo = $personRepo;
    }

    public function index()
    {
        $items = $this->repo->paginate();
        return view('admin.reservation_extras.index', compact('items'));
    }

    public function create()
    {
        $reservations = $this->resRepo->all();
        $places = $this->placeRepo->all();
        $people = $this->personRepo->all();
        return view('admin.reservation_extras.create', compact('reservations', 'places', 'people'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['oven'] = $request->has('oven') ? 1 : 0;
        $data['multipurpose_checked'] = $request->has('multipurpose_checked') ? 1 : 0;

        $this->repo->create($data);
        return redirect()->route('admin.reservation-extras.index')->with('success', 'Extra details saved');
    }

    public function edit($id)
    {
        $item = $this->repo->find($id);
        $reservations = $this->resRepo->all();
        $places = $this->placeRepo->all();
        $people = $this->personRepo->all();
        return view('admin.reservation_extras.edit', compact('item', 'reservations', 'places', 'people'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['oven'] = $request->has('oven') ? 1 : 0;
        $data['multipurpose_checked'] = $request->has('multipurpose_checked') ? 1 : 0;

        $this->repo->update($id, $data);
        return redirect()->route('admin.reservation-extras.index')->with('success', 'Extra details updated');
    }

    public function destroy($id)
    {
        $this->repo->delete($id);
        return redirect()->route('admin.reservation-extras.index')->with('success', 'Extra details removed');
    }
}
