<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view(
            'admin.category.index',
            [
                "title" => "Categories",
                "categories" => Categories::all()
            ]
        );
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
        //
        $request->validate([
            'nama' => 'required|min:2|unique:categories,nama',
            'gambar' => 'mimes:png,jpg,jpeg'
        ], [
            'nama.required' => 'Nama Categories Harus Diisi',
            'nama.min' => 'Nama Categories Minimal 2 karakter',
            'nama.unique' => 'Nama Categories Ini Sudah Ada',
            'gambar.mimes' => 'format yang diterima hanya JPG, JPEG, PNG',
            'gambar.max' => 'Ukuran Yang Diboleh Tidak Boleh Melebihi 2Mb',
        ]);



        $namaFile = time() . '-' . Str::slug($request->nama, '-') . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('img/categories'), $namaFile);


        $categories = new Categories();

        $categories->nama = $request->nama;
        $categories->gambar = $namaFile;

        $categories->save();
        return redirect('/categories')->with('success', 'Berhasil menambah data');
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
        //
        //
        $request->validate([
            'nama' => 'required|min:2',
            'gambar' => 'mimes:png,jpg,jpeg|max:2048'
        ], [
            'nama.required' => 'Nama Categories Harus Diisi',
            'nama.min' => 'Nama Categories Minimal 2 karakter',
            'nama.unique' => 'Nama Categories Ini Sudah Ada',
            'gambar.mimes' => 'format yang diterima hanya JPG, JPEG, PNG',
            'gambar.max' => 'Ukuran Yang Diboleh Tidak Boleh Melebihi 2Mb',
        ]);

        $category = Categories::find($id);

        if ($request->has('gambar')) {
            $path = 'img/categories';
            Storage::delete($path . $category->gambar);

            $namaFile = time() . '-' . Str::slug($request->nama, '-') . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('img/categories'), $namaFile);

            $category->gambar = $namaFile;
            $category->save();
        }

        $category->nama = $request->nama;
        $category->save();

        return redirect('/categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $categories = Categories::find($id);

        $path = 'img/categories';
        Storage::delete($path . $categories->gambar);

        $categories->delete();

        return redirect('/categories')->with('success', 'Berhasil Menghapus Data');
    }
}
