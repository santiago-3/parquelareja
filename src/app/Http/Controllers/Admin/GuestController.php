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
    ) {
        $this->repo = $repo;
    }

    public function index()
    {
        $items = $this->repo->paginate();
        return view('admin.guests.index', compact('items'));
    }

    public function create()
    {
        return view('admin.guests.create');
    }

    public function store(Request $request)
    {
        $this->repo->create($request->all());
        return redirect()->route('admin.guests.index')->with('success', 'Guest added successfully');
    }

    public function edit($id)
    {
        $item = $this->repo->find($id);
        return view('admin.guests.edit', compact('item'));
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
