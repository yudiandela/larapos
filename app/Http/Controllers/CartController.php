<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cart = Cart::where('product_id', $request->product_id)->first();

        if ($cart) {
            $cart->increment('quantity');
        } else {
            $cart = Cart::create([
                'product_id' => $request->product_id,
                'quantity' => 1
            ]);
        }

        return redirect()->back()->with('success', 'Berhasil menambahkan barang');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Check all data in cart
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request)
    {
        $carts = Cart::get();

        if (count($carts) > 0) {

            DB::beginTransaction();

            /** Menambahakan data penjualan */
            $sale = Sale::create([
                'code' => time(),
                'data' => $carts,
                'total' => (int) $request->total
            ]);

            /** Looping data penjualan */
            foreach ($sale->data as $data) {
                $product = Product::find($data->product_id);

                /** Mengurangi data product */
                $product->decrement('stock', $data->quantity);

                /** Masukkan ke table penjualan product */
                SaleProduct::create([
                    'product_id' => $data->product_id,
                    'quantity' => $data->quantity,
                    'total_price' => $product->sell * $data->quantity,
                ]);
            }

            /** Hapus data di cart */
            $this->destroy();

            DB::commit();

            return redirect()->back()->with('success', 'Berhasil di input ke dalam data penjualan');
        }

        DB::rollback();
        return redirect()->back()->with('success', 'Tidak ada data di dalam keranjang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        DB::table('carts')->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data keranjang');
    }
}
