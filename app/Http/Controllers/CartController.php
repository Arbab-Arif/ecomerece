<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    public function cart()
    {

        return view('cart');
    }

    public function add(Request $request)
    {
        $product = Product::find($request->product_id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found'], 404);
        }

        if ($request->quantity > $product->qty) {
            return response()->json(['success' => false, 'message' => 'Not enough stock available'], 400);
        }

        $cart = Session::get('cart', []);
        $cart[$product->id] = [
            'id'        => $product->id,
            'name'      => $product->name,
            'price'     => $product->price,
            'thumbnail' => $product->getImagePath('thumbnail'),
            'qty'       => $request->quantity,
        ];

        Session::put('cart', $cart);

        return response()->json(['success' => true, 'message' => 'Product added to cart']);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed from cart.');
    }

}
