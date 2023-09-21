<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.table.index', 
        [
            "title" => "Tables",
            "tables" => Table::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|unique:tables,name',
        ],[
            'name.required' => 'Nama Categories Harus Diisi',
            'name.min' => 'Nama Categories Minimal 2 karakter',
            'name.unique' => 'Nama Categories Ini Sudah Ada',
        ]);

        $tables = new Table();

        $tables->name = $request->name;
        $tables->status = $request->status;
        $tables->save();
        return redirect('/table')->with('success', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|min:2',
            'status' => 'required'
        ],[
            'name.required' => 'Nama Table Harus Diisi',
            'name.min' => 'Nama Table Minimal 2 karakter',
            'status.required' => 'Status Table Harus Diisi'
        ]);

        $tables = Table::find($id);

        $tables->name = $request->name;
        $tables->status = $request->status;
        $tables->save();
        return redirect('/table')->with('success', 'Berhasil mengedit data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tables = Table::find($id);

        $tables->delete();

        return redirect('/table')->with('success', 'Berhasil Menghapus Data');
    }
}
