<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catalog;

class BaseController extends Controller
{
    public function getIndex(){
        $catalogs = Catalog::whereNotNull('url')->orderBy('name')->get();
        return view('welcome', compact('catalogs'));
    }
}
