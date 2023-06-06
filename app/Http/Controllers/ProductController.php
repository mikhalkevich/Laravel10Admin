<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Catalog;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->simplePaginate(10);
        $catalogs = Catalog::orderBy('id', 'DESC')->get();
        return view('admin.products', compact('products', 'catalogs'));
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
    public function store(ProductRequest $request)
    {
        $request['user_id'] = Auth::user()->id;
        Product::create($request->all());
        return redirect()->back();
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

    public function addCatalog(Request $request, Product $product){
        abort_if(!$request->catalog_id, '404', 'Отсутствует catalog_id');
        $product->catalogs()->syncWithoutDetaching($request->catalog_id);
        return redirect()->back();
    }

    public function addPicture(Request $request, Product $product){
        if($request->has('picture')){
            $product->addMedia($request->file('picture'))->toMediaCollection();
        }
        return redirect()->back();
    }
}
