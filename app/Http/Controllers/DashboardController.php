<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Pesanan;
use App\Models\PesananDetails;
use App\Models\Products;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categories::all();

        $jumlahPesananPerKategori = [];

        foreach ($categories as $category) {
            $products = $category->products;

            $jumlahPesanan = 0;

            foreach ($products as $product) {
                $pesananDetails = $product->pesanan_details;

                foreach ($pesananDetails as $pesananDetail) {
                    $jumlahPesanan += $pesananDetail->total_harga;
                }
            }

            $jumlahPesananPerKategori[$category->nama] = $jumlahPesanan;
        }

        return view('admin.dashboard', [
            "title" => "Dashboard",
            'totalpesanan' => Pesanan::count(),
            'totaltransaction' => Transaction::count(),
            'totalproducts' => Products::count(),
            'totaluser' => User::count(),
            'userterbaru' => User::orderBy('created_at', 'desc')->latest()->limit(8)->get(),
            'productsterbaru' => Products::orderBy('created_at', 'desc')->latest()->limit(8)->get(),
            'pesananterbaru' => Pesanan::orderBy('created_at', 'desc')->latest()->limit(8)->get(),
            'transactionterbaru' => Transaction::orderBy('created_at', 'desc')->latest()->limit(8)->get(),
            'chart' => $jumlahPesananPerKategori,
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
        //
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
