<?php

namespace App\Http\Controllers;

use App\Models\Popping;
use App\Models\Product_to_Order;
use App\Models\Product;
use Illuminate\Http\Request;

class Product_to_OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_to_orders = Product_to_Order::all();
        return view('product_to_orders.index', compact('product_to_orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('product_to_orders.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Qty' => 'required|integer',
            'isOrdered' => 'required|boolean',
            'Product_Id' => 'required|exists:product,Id',
            'Order_Id' => 'required|exists:order,Id',
            'Popping_Id' => 'required|exists:popping,Id',
        ]);

        $product_to_order = Product_to_Order::create($validatedData);

        return redirect()->route('product_to_orders.index')->with('success', 'Product_to_Order created successfully');
    }

    /**
     * Display the specified resource.
     * 
     * @param  Product_to_Order  $product_to_order
     * @return \Illuminate\Http\Response
     */
    public function show(Product_to_Order $product_to_Order)
    {
        return view('product_to_orders.show', compact('product_to_order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product_to_Order  $product_to_Order
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_to_Order $product_to_Order)
    {
        $products = Product::all();
        return view('product_to_orders.edit', compact('product_to_Order', 'products'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  Product_to_Order  $product_to_Order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product_to_Order $product_to_Order)
    {
        $validatedData = $request->validate([
            'Qty' => 'required|integer',
            'isOrdered' => 'required|boolean',
            'Product_Id' => 'required|exists:product,Id',
            'Order_Id' => 'required|exists:order,Id',
            'Popping_Id' => 'required|exists:popping,Id',
        ]);

        $product_to_order->update($validatedData);

        return redirect()->route('product_to_orders.index')->with('success', 'Product_to_Order updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  Product_to_Order  $product_to_Order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_to_Order $product_to_Order)
    {
        $product_to_Order->delete();

        return redirect()->route('product_to_orders.index')->with('success', 'Product_to_Order deleted successfully');
    }
}
