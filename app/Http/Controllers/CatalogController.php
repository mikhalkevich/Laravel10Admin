<?php

namespace App\Http\Controllers;

use App\Models\CatalogBook;
use App\Models\CatalogOnliner;
use App\Models\CatalogOnlinerLink;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Catalog;
use App\Parser\ProductOnlinerParse;
use Carbon\Carbon;

use App\Parser\CatalogOnlinerParse;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catalogs = Catalog::orderBy('id', 'DESC')->get();
        return view('admin.catalogs', compact('catalogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Catalog::create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $catalog = Catalog::find($id);
        return view('admin.catalog_edit', compact('catalog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $catalog = Catalog::find($id);
        $catalog->update($request->all());
        return redirect('admin/catalog');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $catalog = Catalog::find($id);
        $catalog->delete();
        return redirect()->back();
    }

    public function getUrl($url)
    {
        $catalog = Catalog::where('url', $url)->first();
        return view('catalog', compact('catalog'));
    }

    public function getOnliner()
    {
        $parse = new CatalogOnlinerParse;
        $parse->getParse('https://catalog.onliner.by/');
        return view('axios.catalog');
    }

    public function getCatalogOnliner()
    {
        $catalogs = CatalogOnliner::all();
        return view('admin.catalog_onliner', compact('catalogs'));
    }

    public function getData($id = null)
    {
        $catalogs_onliner = CatalogOnliner::where('data_id', $id)->get();
        return view('catalog_data', compact('catalogs_onliner', 'id'));
    }

    public function getCatalogCatalog($data_id = null, $id = null)
    {

        $catalogs_onliner = CatalogOnliner::where('data_id', $data_id)->get();
        $catalog_link = CatalogOnlinerLink::find($id);
        $catalog_name = config('catalog.onliner.' . $data_id);
        $product_test = Product::whereDate('created_at', Carbon::today())->where('catalog_onliner_link_id', $catalog_link->id)->first();
        if (!$product_test) {
            $parse_obj = (new ProductOnlinerParse())->getParse($catalog_link);
        }
        $products = Product::where('catalog_onliner_link_id', $catalog_link->id)->get();

        return view('catalog_catalog', compact('catalogs_onliner', 'catalog_link', 'id', 'data_id', 'catalog_name', 'products'));
    }

    public function subcatalogs($catalog_book)
    {
        $subcatalogs = CatalogBook::where('parent_id', $catalog_book)->get();

        return view('helpers.subcatalog', compact('subcatalogs'));
    }
}
