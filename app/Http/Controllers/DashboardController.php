<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
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
        $tenDaysAgo = now()->subDays(10);

        $pesananTerbaru = Pesanan::where('created_at', '>=', $tenDaysAgo)
            ->orderBy('created_at', 'asc')
            ->get();

        $categories = $pesananTerbaru->pluck('created_at')->map(function ($date) {
            return $date->format('M d');
        });

        $data = $pesananTerbaru->pluck('total_harga');
        return view('admin.dashboard', [
            "title" => "Dashboard",
            'totalpesanan' => Pesanan::count(),
            'totaltransaction' => Transaction::count(),
            'totalproducts' => Products::count(),
            'totaluser' => User::count(),
            'userterbaru' => User::orderBy('created_at', 'desc')->latest()->limit(8)->get(),
            'pesananterbaru' => Pesanan::orderBy('created_at', 'desc')->latest()->limit(8)->get(),
            'transactionterbaru' => Transaction::orderBy('created_at', 'desc')->latest()->limit(8)->get(),
            'data' => $data,
            'categories' => $categories,
            //'isAuthPage' => true,
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
