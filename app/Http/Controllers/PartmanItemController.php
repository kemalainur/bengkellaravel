<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class PartmanItemController extends Controller
{
    public function index()
    {
        $item = Item::paginate(10);
        return view('item.index', [
            'item' => $item,
            'routePrefix' => 'partman.item'
        ]);
    }

    public function create()
    {
        return view('item.create', ['routePrefix' => 'partman.item']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'iditem' => 'required|unique:item,iditem',
            'namaitem' => 'required|string|max:255',
            'harga' => 'nullable|string',
            'jenis' => 'nullable|string',
            'qty' => 'nullable|integer',
        ]);

        Item::create($request->all());

        return redirect()->route('partman.item.index')->with('success', 'Item berhasil ditambahkan!');
    }

    public function edit($iditem)
    {
        $item = Item::findOrFail($iditem);
        return view('item.edit', [
            'item' => $item,
            'routePrefix' => 'partman.item'
        ]);
    }

    public function update(Request $request, $iditem)
    {
        $request->validate([
            'namaitem' => 'required|string|max:255',
            'harga' => 'nullable|string',
            'jenis' => 'nullable|string',
            'qty' => 'nullable|integer',
        ]);

        $item = Item::findOrFail($iditem);
        $item->update($request->only(['namaitem', 'harga', 'jenis', 'qty']));

        return redirect()->route('partman.item.index')->with('success', 'Item berhasil diupdate!');
    }

    public function destroy($iditem)
    {
        $item = Item::findOrFail($iditem);
        $item->delete();
        return redirect()->route('partman.item.index')->with('success', 'Item berhasil dihapus!');
    }
}
