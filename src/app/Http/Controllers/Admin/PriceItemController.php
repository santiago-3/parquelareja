<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\PriceItemRepository;
use Illuminate\Http\Request;

class PriceItemController extends Controller
{
    protected $repo;

    public function __construct(PriceItemRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        $items = $this->repo->all();
        return view('admin.price_items.index', compact('items'));
    }

    public function create()
    {
        return view('admin.price_items.create');
    }

    public function store(Request $request)
    {
        $this->repo->create($request->all());
        return redirect()->route('admin.price-items.index')->with('success', 'Price item created');
    }

    public function edit($id)
    {
        $item = $this->repo->find($id);
        return view('admin.price_items.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $this->repo->update($id, $request->all());
        return redirect()->route('admin.price-items.index')->with('success', 'Price item updated');
    }

    public function destroy($id)
    {
        $this->repo->delete($id);
        return redirect()->route('admin.price-items.index')->with('success', 'Price item deleted');
    }
}
