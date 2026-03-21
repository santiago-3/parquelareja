<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\PlaceRepository;
use Illuminate\Http\Request;

class PlaceController extends Controller {
    protected $repository;

    public function __construct(PlaceRepository $repository) {
        $this->repository = $repository;
    }

    public function index() {
        $items = $this->repository->all();
        return view('admin.places.index', compact('items'));
    }

    public function create() {
        return view('admin.places.create');
    }

    public function edit($id) {
        $item = $this->repository->find($id);
        return view('admin.places.edit', compact('item'));
    }

    public function update(Request $request, $id) {
        $this->repository->update($id, $request->all());
        return redirect()->route('admin.places.index')->with('success', 'Updated successfully');
    }

    public function store(Request $request) {
        $this->repository->create($request->all());
        return redirect()->route('admin.places.index')->with('success', 'Place created');
    }

    public function destroy($id) {
        $this->repository->delete($id);
        return redirect()->route('admin.places.index')->with('success', 'Deleted successfully');
    }
}
