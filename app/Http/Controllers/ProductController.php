<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(File::exists('products.json')) {
            $products = file_get_contents('products.json');
            $jsonProducts = json_decode($products,true);
            $total = 0;
            foreach ($jsonProducts as $r) {
                $total += $r['price_per'] * $r['quantity'];
            }
        }
        return view('products.index', compact('jsonProducts', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $input = request::all();
        
        if($input['description'] != '' && $input['quantity'] != '' && $input['price_per'] != ''){
            if(File::exists('products.json')) {
                $products = File::get('products.json');
                $productsJson = json_decode($products, true);
                array_push($productsJson, $input);
                File::put('products.json', json_encode($productsJson, JSON_PRETTY_PRINT));
            } else {
                $data = array();
                array_push($data, $input);
                File::put('products.json', json_encode($data, JSON_PRETTY_PRINT));
            }
            
            return "true";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = File::get('products.json');
        $productsJson = json_decode($products, true);
        $i = 0;
        
        foreach ($productsJson as $r) {
            if ($id === $r['description']) {
                array_splice($productsJson, $i, 1);
            }
            $i++;
        }
        
        File::put('products.json', json_encode($productsJson, JSON_PRETTY_PRINT));
        
    }
}
