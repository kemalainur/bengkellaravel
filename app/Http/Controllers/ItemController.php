<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $item = Item::paginate(10);
        return view('item.index', compact('item'));
    }

    public function create()
    {
        return view('item.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'iditem' => 'required|unique:item,iditem',
            'namaitem' => 'required|string|max:100',
            'harga' => 'nullable|string',
            'jenis' => 'nullable|string',
            'qty' => 'nullable|integer',
        ]);

        Item::create($request->all());

        return redirect()->route('item.index')->with('success', 'Item berhasil ditambahkan!');
    }

    public function edit(Item $item)
    {
        return view('item.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'namaitem' => 'required|string|max:100',
            'harga' => 'nullable|string',
            'jenis' => 'nullable|string',
            'qty' => 'nullable|integer',
        ]);

        $item->update($request->only(['namaitem', 'harga', 'jenis', 'qty']));

        return redirect()->route('item.index')->with('success', 'Item berhasil diupdate!');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('item.index')->with('success', 'Item berhasil dihapus!');
    }
}
