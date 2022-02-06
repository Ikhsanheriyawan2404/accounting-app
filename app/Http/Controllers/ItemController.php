<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:item-list|item-create|item-edit|item-delete', ['only' => ['index','show']]);
        $this->middleware('permission:item-create', ['only' => ['create','store']]);
        $this->middleware('permission:item-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:item-delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $items = Item::get();
            return DataTables::of($items)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn =
                        '<div class="d-flex justify-content-between">

                            <a href="javascript:void(0)" data-id="'.$row->id.'" id="showItem" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>


                           <a href=" ' . route('items.edit', $row->id) . '" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i></a>


                           <form action=" ' . route('items.destroy', $row->id) . '" method="POST">
                               <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Apakah yakin ingin menghapus ini?\')"><i class="fas fa-trash"></i></button>
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                           </form>
                        </div>';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('items.index',[
            'title' => 'Data Barang'
        ]);
    }

    public function show(Item $item)
    {
        return response()->json($item);
    }

    public function create()
    {
        return view('items.create', [
            'title' => 'Tambah Barang',
        ]);
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|max:255',
            'price' => 'required',
            'quantity' => 'required'
        ]);

        $item = Item::create([
            'name' => request('name'),
            'price' => request('price'),
            'quantity' => request('quantity'),
            'description' => request('description'),
        ]);
        toast('Data barang berhasil ditambah!','success');
        return redirect()->route('items.index');
    }

    public function edit(Item $item)
    {
        return view('items.edit', [
            'title' => 'Edit Barang',
            'item' => $item,
        ]);
    }

    public function update(Item $item)
    {
        request()->validate([
            'name' => 'required|max:255',
            'price' => 'required',
            'quantity' => 'required'
        ]);

        $item->update([
            'name' => request('name'),
            'price' => request('price'),
            'quantity' => request('quantity'),
            'description' => request('description'),
        ]);
        toast('Data barang berhasil diubah!','success');
        return redirect()->route('items.index');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        toast('Data barang berhasil dihapus!','success');
        return back();
    }

    public function ()
    {
        $item->delete();
        toast('');
        return back()
    }
}
