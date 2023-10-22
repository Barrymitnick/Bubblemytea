<?php

namespace App\Http\Controllers;

use App\Models\Popping;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!isset($_COOKIE['name'])) {
            return redirect('login');
        }
        $poppings = Popping::all();
        $products = Product::all();
        return view('home', [
            'products' => $products,
            'poppings' => $poppings,
            'name' => $_COOKIE['name'],
            'email' => $_COOKIE['email']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product([
            'Name' => $request->get('Name'),
            'Price' => $request->get('Price'),
            'Description' => $request->get('Description'),
        ]);

        if ($request->hasFile('Image')) {
            $image = $request->file('Image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $request->file('Image')->storeAs('public/images', $filename);
            $product->Image = $filename;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function getData()
    {
        $products = Product::all();
        $poppings = Popping::all();

        return view('admin', [
            'products' => $products,
            'poppings' => $poppings,
            'name' => $_COOKIE['name']
        ]);
    }

    public function add (Request $request){

        DB::insert('INSERT INTO `product` (`Name`, `Price`, `Description`, `Image`) VALUES ("' . $request->name . '", "' . $request->price . '", "' . $request->description . '", "' . $request->image . '");');

        return $this->getData();
    }

    public function edit (Request $request){

        if( $request->action == "edit" ){
            DB::update('UPDATE `product` SET `Name` = "' . $request->name . '", `Price` = "' . $request->price . '", `Description` = "' . $request->description . '", `Image` = "' . $request->image . '" WHERE `product`.`Id` = ' . $request->id . ';');
        } else {
            DB::delete('DELETE FROM `product` WHERE `Id` = "' . $request->id . '";');
        }


        return $this->getData();
    }

    /**
     * Display the specified resource.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *  
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function editp(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->Name = $request->get('Name');
        $product->Price = $request->get('Price');
        $product->Description = $request->get('Description');

        if ($request->hasFile('Image')) {
            $image = $request->file('Image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $request->file('Image')->storeAs('public/images', $filename);
            $product->Image = $filename;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
