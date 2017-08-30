<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Buyer;

class BuyerCategoryController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('scope:read-general')->only('index');
        $this->middleware('can:view,buyer')->only('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Buyer $buyer)
    {
        $categories = $buyer->transactions()->with('product.categories')
        ->get()
        ->pluck('product.categories')
        ->collapse()
        ->unique('id')
        ->values();
        return $this->showAll($categories);
    }
}
