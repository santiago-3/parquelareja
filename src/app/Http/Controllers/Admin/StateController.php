<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\StateRepository;
use Illuminate\Http\Request;

class StateController extends Controller
{
    protected $repo;

    public function __construct(StateRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $items = $this->repo->all();
        return view('admin.states.index', compact('items'));
    }

    public function create()
    {
        return view('admin.states.create');
    }

    public function store(Request $request)
    {
        $this->repo->create($request->all());
        return redirect()->route('admin.states.index')->with('success', 'State created successfully');
    }

    public function edit($id)
    {
        $item = $this->repo->find($id);
        return view('admin.states.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $this->repo->update($id, $request->all());
        return redirect()->route('admin.states.index')->with('success', 'State updated successfully');
    }

    public function destroy($id)
    {
        $this->repo->delete($id);
        return redirect()->route('admin.states.index')->with('success', 'State deleted');
    }
}
