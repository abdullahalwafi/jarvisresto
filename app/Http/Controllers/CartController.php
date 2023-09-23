<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Pesanan;
use App\Models\Products;
use App\Enums\TableStatus;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\PesananDetails;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metode = new TripayController();
        $metode = $metode->getMetode();
        return view('home.contents.cart', [
            "title" => "Cart",
            "tables" => Table::where('status', TableStatus::Available)->get(),
           "metode" => $metode
        ]);
    }

    public function tambah($id)
    {

        $title = "Cart";
        $product = Products::findOrFail($id);
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->nama,
                "quantity" => 1,
                "price" => $product->harga,
                "total" => $product->harga * 1,
                "image" => $product->gambar,
                "category" => $product->categories
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('added', 'Item has been added to cart!');
    }
    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            $newQuantity = intval($request->input('quantity'));

            // Pastikan $newQuantity tidak kurang dari 0 atau negatif
            if ($newQuantity >= 0) {
                $cart[$id]['quantity'] = $newQuantity;
                $cart[$id]['total'] = $cart[$id]['price'] * $newQuantity;
                session()->put('cart', $cart);

                return response()->json(['success' => true]);
            }
        }

        return response()->json(['success' => false]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function checkout(Request $request)
    {
        if ($request->metode == "cash") {

            $cart = session()->get('cart');
            $total = $request->total_bayar;
            $metode = $request->metode;
            // random invoice
            $invoice = rand(100000, 999999);
            $pemesan = [];
            $pemesan['nama'] = $request->nama_pemesan;
            $pemesan['no_hp'] = $request->no_hp;
            
            $pesanan = Pesanan::create([
                'kode_pesanan' => $invoice,
                'nama_pemesan' => $pemesan['nama'],
                'no_hp' => $pemesan['no_hp'],
                'total_harga' => $total,
                'status' => 'pending',
                'table_id' => $request->nomeja
            ]);
            
            foreach ($cart as $key => $value) {
                PesananDetails::create([
                    'pesanan_id' => $pesanan->id,
                    'products_id' => $value['id'],
                    'qty' => $value['quantity'],
                    'total_harga' => $value['total']
                ]);
            }
            $meja = Table::find($request->nomeja);
                if ($meja) {
                    $meja->update(['status' => 'Pending']);
                } 
            
            // stop session cart
            session()->forget('cart');
            return redirect("/")->with('success', 'Pesanan berhasil dibuat');
        } else {
            $cart = session()->get('cart');
            $total = $request->total_bayar;
            $metode = $request->metode;
            // random invoice
            $invoice = rand(100000, 999999);
            $pemesan = [];
            $pemesan['nama'] = $request->nama_pemesan;
            $pemesan['no_hp'] = $request->no_hp;
            $pesanan = Pesanan::create([
                'kode_pesanan' => $invoice,
                'nama_pemesan' => $pemesan['nama'],
                'no_hp' => $pemesan['no_hp'],
                'total_harga' => $total,
                'status' => 'pending',
                'table_id' => $request->nomeja
            ]);
            foreach ($cart as $key => $value) {
                PesananDetails::create([
                    'pesanan_id' => $pesanan->id,
                    'products_id' => $value['id'],
                    'qty' => $value['quantity'],
                    'total_harga' => $value['total']
                ]);
            }
            // add transaksi
            Transaction::create([
                'pesanan_id' => $pesanan->id,
                'total_bayar' => $total,
                'jumlah_bayar' => $total,
                'kembalian' => 0,
                'status' => 'pending',
                'metode' => $metode
            ]);
            $transaksi = new TripayController();
            $transaksi = $transaksi->requestTransaksi($cart, $metode, $invoice, $total, $pemesan);
            $meja = Table::find($request->table_id);
            if ($meja) {
            $meja->update(['status' => 'Pending']);
            }
            $redirect = $transaksi->checkout_url;
            session()->forget('cart');
            return redirect($redirect);
        }
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
    public function delete($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
