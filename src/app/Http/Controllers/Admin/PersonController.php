<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\PersonRepository;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    protected $repo;

    public function __construct(PersonRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $items = $this->repo->paginate();
        return view('admin.people.index', compact('items'));
    }

    public function create()
    {
        return view('admin.people.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        // Handle boolean defaults for plain HTML checkboxes
        $data['is_master'] = $request->has('is_master') ? 1 : 0;
        $data['from_reservation'] = $request->has('from_reservation') ? 1 : 0;

        $this->repo->create($data);
        return redirect()->route('admin.people.index')->with('success', 'Person added successfully');
    }

    public function edit($id)
    {
        $item = $this->repo->find($id);
        return view('admin.people.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['is_master'] = $request->has('is_master') ? 1 : 0;
        $data['from_reservation'] = $request->has('from_reservation') ? 1 : 0;

        $this->repo->update($id, $data);
        return redirect()->route('admin.people.index')->with('success', 'Person updated successfully');
    }

    public function destroy($id)
    {
        $this->repo->delete($id);
        return redirect()->route('admin.people.index')->with('success', 'Person deleted');
    }
}
