<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\GuestRepository;
use App\Repositories\ReservationRepository;
use App\Repositories\StateRepository;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    protected $repo;
    protected $resRepo;
    protected $stateRepo;

    public function __construct(
        GuestRepository $repo,
        ReservationRepository $resRepo,
        StateRepository $stateRepo
    ) {
        $this->repo = $repo;
        $this->resRepo = $resRepo;
        $this->stateRepo = $stateRepo;
    }

    public function index()
    {
        $items = $this->repo->all();
        return view('admin.guests.index', compact('items'));
    }

    public function create()
    {
        $reservations = $this->resRepo->all();
        $states = $this->stateRepo->all();
        return view('admin.guests.create', compact('reservations', 'states'));
    }

    public function store(Request $request)
    {
        $this->repo->create($request->all());
        return redirect()->route('admin.guests.index')->with('success', 'Host added successfully');
    }

    public function edit($id)
    {
        $item = $this->repo->find($id);
        $reservations = $this->resRepo->all();
        $states = $this->stateRepo->all();
        return view('admin.guests.edit', compact('item', 'reservations', 'states'));
    }

    public function update(Request $request, $id)
    {
        $this->repo->update($id, $request->all());
        return redirect()->route('admin.guests.index')->with('success', 'Host updated successfully');
    }

    public function destroy($id)
    {
        $this->repo->delete($id);
        return redirect()->route('admin.guests.index')->with('success', 'Host removed');
    }
}
