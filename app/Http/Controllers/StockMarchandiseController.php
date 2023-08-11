<?php

namespace App\Http\Controllers;

use App\Models\StockMarchandise;
use App\Http\Requests\StoreStockMarchandiseRequest;
use App\Http\Requests\UpdateStockMarchandiseRequest;

class StockMarchandiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreStockMarchandiseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStockMarchandiseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StockMarchandise  $stockMarchandise
     * @return \Illuminate\Http\Response
     */
    public function show(StockMarchandise $stockMarchandise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StockMarchandise  $stockMarchandise
     * @return \Illuminate\Http\Response
     */
    public function edit(StockMarchandise $stockMarchandise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStockMarchandiseRequest  $request
     * @param  \App\Models\StockMarchandise  $stockMarchandise
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStockMarchandiseRequest $request, StockMarchandise $stockMarchandise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StockMarchandise  $stockMarchandise
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockMarchandise $stockMarchandise)
    {
        //
    }
}
