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
        // Sanitize Harga (remove dots)
        if ($request->has('harga')) {
            $request->merge(['harga' => str_replace('.', '', $request->harga)]);
        }

        $request->validate([
            'iditem' => 'required|unique:item,iditem',
            'namaitem' => 'required|string|max:255',
            'harga' => 'nullable|numeric',
            'jenis' => 'nullable|string|in:part,jasa',
            'qty' => 'nullable|integer',
        ]);

        Item::create($request->all());

        return redirect()->route('partman.item.index')->with('success', 'Item berhasil ditambahkan!');
    }

    public function edit($item)
    {
        $item = Item::findOrFail($item);
        return view('item.edit', [
            'item' => $item,
            'routePrefix' => 'partman.item'
        ]);
    }

    public function update(Request $request, $item)
    {
        // Sanitize Harga (remove dots)
        if ($request->has('harga')) {
            $request->merge(['harga' => str_replace('.', '', $request->harga)]);
        }

        $request->validate([
            'namaitem' => 'required|string|max:255',
            'harga' => 'nullable|numeric',
            'jenis' => 'nullable|string|in:part,jasa',
            'qty' => 'nullable|integer',
        ]);

        $item = Item::findOrFail($item);
        $item->update($request->only(['namaitem', 'harga', 'jenis', 'qty']));

        return redirect()->route('partman.item.index')->with('success', 'Item berhasil diupdate!');
    }

    public function destroy($item)
    {
        $item = Item::findOrFail($item);
        $item->delete();
        return redirect()->route('partman.item.index')->with('success', 'Item berhasil dihapus!');
    }
}
