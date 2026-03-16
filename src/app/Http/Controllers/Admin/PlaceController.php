<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\PlaceRepository;
use Illuminate\Http\Request;

class PlaceController extends Controller {
    protected $repo;

    public function __construct(PlaceRepository $repo) {
        $this->repo = $repo;
    }

    public function index() {
        $items = $this->repo->all();
        return view('admin.places.index', compact('items'));
    }

    public function create() {
        return view('admin.places.create');
    }

    public function store(Request $request) {
        $this->repo->create($request->all());
        return redirect()->route('admin.places.index')->with('success', 'Place created');
    }
}
