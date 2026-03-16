<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\ActivityRepository;
use App\Repositories\PlaceRepository;
use Illuminate\Http\Request;

class ActivityController extends Controller {
    protected $repository;
    protected $placeRepo;

    public function __construct(ActivityRepository $repository, PlaceRepository $placeRepo) {
        $this->repository = $repository;
        $this->placeRepo = $placeRepo;
    }

    public function index() {
        $items = $this->repository->all();
        return view('admin.activities.index', compact('items'));
    }

    public function create() {
        $places = $this->placeRepo->all();
        return view('admin.activities.create', compact('places'));
    }

    public function store(Request $request) {
        $this->repository->create($request->all());
        return redirect()->route('admin.activities.index')->with('success', 'Created successfully');
    }

    public function edit($id) {
        $item = $this->repository->find($id);
        $places = $this->placeRepo->all();
        return view('admin.activities.edit', compact('item', 'places'));
    }

    public function update(Request $request, $id) {
        $this->repository->update($id, $request->all());
        return redirect()->route('admin.activities.index')->with('success', 'Updated successfully');
    }

    public function destroy($id) {
        $this->repository->delete($id);
        return redirect()->route('admin.activities.index')->with('success', 'Deleted successfully');
    }
}
