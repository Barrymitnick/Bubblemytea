<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product_to_Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
    }

    public function add(Request $request)
    {
        $res = Order::select('Id')->where('isOrdered', 0)->where('User_Id', $_COOKIE['id'])->get();
        if (count($res) != 0) {
            $product_to_order = new Product_to_Order([]);
            $product_to_order->Qty = $request->qty;
            $product_to_order->Popping_Id = $request->popping;
            $product_to_order->sugar = $request->sugar;
            $product_to_order->Order_Id = $res[0]->Id;
            $product_to_order->Product_Id = $request->product_id;
            $product_to_order->save();
        } else {
            $order = new Order([]);
            $order->User_Id = $_COOKIE['id'];
            $order->save();

            $product_to_order = new Product_to_Order([]);
            $product_to_order->Qty = $request->qty;
            $product_to_order->Popping_Id = $request->popping;
            $product_to_order->sugar = $request->sugar;
            $product_to_order->Order_Id = $order->Id;
            $product_to_order->Product_Id = $request->product_id;
            $product_to_order->save();
        }

        return redirect('home')->with('successMessage', 'Your order has been added to the basket. 🎉🎉🎉');
    }

    public function getAll()
    {
        $res = Order::select('Id')->where('isOrdered', 0)->where('User_Id', $_COOKIE['id'])->get();
        if (count($res) != 0) {
            $data = DB::select('SELECT Image, product_to_order.Id as id, product.Name as productName, popping.Name as poppingName, sugar, Qty, Price from product_to_order LEFT JOIN product ON product.Id = product_to_order.Product_Id LEFT JOIN popping ON popping.Id = product_to_order.Popping_Id WHERE Order_Id = ' . $res[0]->Id . ';');
            // dd($res);
            return view('cart', [
                'name' => $_COOKIE['name'],
                'orderProducts' => $data,
                'orderId' => $res[0]->Id,
            ]);
        } else {
            return view('cart', [
                'noOrder' => true,
                'name' => $_COOKIE['name'],
            ]);
        }
    }

    public function checkoutOrder(Request $request)
    {
        // dd($request);
        $data = DB::update('UPDATE `order` SET amount = ' . $request->amount . ', isOrdered = 1 WHERE Id = ' . $request->id . ';');

        return redirect('home')->with('successMessage', 'Your order has been successfully processed. 🎉🎉🎉');
    }

    public function fetchOrderHistory()
    {
        $data = [];
        $order = DB::select('SELECT * FROM `order` WHERE User_Id = ' . $_COOKIE['id'] . ' AND isOrdered = 1;');

        if (count($order) == 0) {
            return view('history', [
                'name' => $_COOKIE['name'],
                'noOrder' => true
            ]);
        } else {
            for ($i = 0; $i < count($order); $i++) {
                $productOrder = DB::select('SELECT Image, product_to_order.Id as id, product.Name as productName, popping.Name as poppingName, sugar, Qty, Price from product_to_order LEFT JOIN product ON product.Id = product_to_order.Product_Id LEFT JOIN popping ON popping.Id = product_to_order.Popping_Id WHERE Order_Id = ' . $order[$i]->Id . ';');
                $data[$i] = [
                    'order' => $order[$i],
                    'productOrder' => $productOrder
                ];
            }
            // dd($data[0]['order']);
            return view('history', [
                'name' => $_COOKIE['name'],
                'data' => $data
            ]);
        }
    }

    public function deleteOrder(Request $request)
    {
        DB::delete('DELETE FROM product_to_order WHERE Id = ' . $request->id . ';');
        return $this->getAll();
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
            'dateCreated' => 'required',
            'isOrdered' => 'required',
            'user_id' => 'required|exists:user,Id'
        ]);

        $order = Order::create($validatedData);

        // return redirect()->route('orders.index')->with('success', 'Order created successfully');
    }

    /**
     * Display the specified resource.
     * 
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'dateCreated' => 'required',
            'isOrdered' => 'required',
            'user_id' => 'required|exists:user,Id'
        ]);

        $order->update($validatedData);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
    }
}
