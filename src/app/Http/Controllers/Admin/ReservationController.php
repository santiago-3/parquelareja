<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ReservationRepository;
use App\Repositories\PersonRepository;
use App\Repositories\StateRepository;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    protected $repo;
    protected $personRepo;
    protected $stateRepo;

    public function __construct(
        ReservationRepository $repo, 
        PersonRepository $personRepo,
        StateRepository $stateRepo
    ) {
        $this->repo = $repo;
        $this->personRepo = $personRepo;
        $this->stateRepo = $stateRepo;
    }

    public function index()
    {
        $items = $this->repo->all();
        return view('admin.reservations.index', compact('items'));
    }

    public function create()
    {
        $people = $this->personRepo->all();
        $states = $this->stateRepo->all();
        return view('admin.reservations.create', compact('people', 'states'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['is_keeper'] = $request->has('is_keeper') ? 1 : 0;
        
        $this->repo->create($data);
        return redirect()->route('admin.reservations.index')->with('success', 'Reservation created');
    }

    public function edit($id)
    {
        $item = $this->repo->find($id);
        $people = $this->personRepo->all();
        $states = $this->stateRepo->all();
        return view('admin.reservations.edit', compact('item', 'people', 'states'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['is_keeper'] = $request->has('is_keeper') ? 1 : 0;

        $this->repo->update($id, $data);
        return redirect()->route('admin.reservations.index')->with('success', 'Reservation updated');
    }

    public function destroy($id)
    {
        $this->repo->delete($id);
        return redirect()->route('admin.reservations.index')->with('success', 'Reservation deleted');
    }
}
