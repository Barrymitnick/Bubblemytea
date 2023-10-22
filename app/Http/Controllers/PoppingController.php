<?php

namespace App\Http\Controllers;

use App\Models\Popping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PoppingController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $poppings = Popping::all();
        return compact('poppings');
        // return view('poppings.index', compact('poppings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('poppings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $popping = new Popping([
            'Name' => $request->name,
        ]);

        $popping->save();

        return redirect()->route('poppings.index')->with('success', 'Popping created successfully.');
    }

    public function deleteOrEdit(Request $request)
    {
        if ($request->action == 'delete') {
            DB::delete('DELETE FROM `popping` WHERE Id = ' . $request->id . ';');
        } else {
            DB::update('UPDATE `popping` SET Name = "' . $request->name . '" WHERE Id = ' . $request->id . ';');
        }
        $x = new ProductController();
        return $x->getData();
    }

    public function add(Request $request)
    {
        DB::insert('INSERT INTO `popping`(`Name`) VALUES("' . $request->name . '");');
        $x = new ProductController();
        return $x->getData();
    }

    /**
     * Display the specified resource.
     *
     * @param  Popping  $popping
     * @return \Illuminate\Http\Response
     */
    public function show(Popping $popping)
    {
        return view('poppings.show', compact('popping'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Popping  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Popping $popping)
    {
        return view('poppings.edit', compact('popping'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Popping  $popping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Popping $popping)
    {
        $popping->name = $request->get('name');

        $popping->save();

        return redirect()->route('poppings.index')->with('success', 'Popping updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Popping  $popping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Popping $popping)
    {
        $popping->delete();

        return redirect()->route('poppings.index')->with('success', 'Popping deleted successfully.');
    }
}
