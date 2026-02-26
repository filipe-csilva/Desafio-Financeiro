<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransacoesRequest;
use App\Models\transacoes;
use Illuminate\Http\Request;

class TransacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transacoes = Transacoes::all();

        return view('transacoes.index', ['transacoes' => $transacoes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transacoes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(transacoes $transacoes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(transacoes $transacoes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, transacoes $transacoes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(transacoes $transacoes)
    {
        //
    }
}
