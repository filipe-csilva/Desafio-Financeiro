<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransacaoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\transacoes;
use Illuminate\Http\Request;

class TransacoesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transacoes = Transacoes::orderBy('created_at', 'desc')->get();

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
    public function store(TransacaoRequest $request)
    {
        //dd("chegou aqui");
        $data = [
            'user_id' => Auth::id(),
            'valor' => $request['valor'],
            'cpf' => $request['cpf'],
            'status' => 'em_processamento'
        ];

        if ($request->hasFile('arquivo')) {
            $file = $request->file('arquivo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('transacoes', $fileName, 'public');
            
            $data['arquivo'] = $filePath;
            $data['arquivo_nome'] = $file->getClientOriginalName();
        }

        $transacao = Transacoes::create($data);

        if($transacao){
            return redirect()->route('transacoes.index')->with('success','Curso cadastrado com sucesso!');
        }else{
            return redirect()->route('transacoes.index')->with('error','Não foi possivel cadastrar o curso!!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transacoes $transaco)
    {
        return view('transacoes.show', ['transacao' => $transaco]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transacoes $transaco)
    {
        return view('transacoes.update', ['transacao' => $transaco]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transacoes $transaco)
    {
        $data = [
            'user_id' => Auth::id(),
            'valor' => $request['valor'],
            'cpf' => $request['cpf'],
            'status' => 'em_processamento'
        ];

        if ($request->hasFile('arquivo')) {
            $file = $request->file('arquivo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('transacoes', $fileName, 'public');
            
            $data['arquivo'] = $filePath;
            $data['arquivo_nome'] = $file->getClientOriginalName();
        }

        $atualizado = $transaco->update($data);

        if($atualizado){
            return redirect()->route('transacoes.index')->with('success','Transação atualizada com sucesso!');
        }else{
            return redirect()->route('transacoes.index')->with('error','Não foi possível atualizar a transação!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $transacao = Transacoes::find($id);
        
        if (!$transacao) {
            return redirect()->route('transacoes.index')->with('error','Transação não encontrada!!');
        }
        
        $deletou = $transacao->delete();

        if($deletou){
            return redirect()->route('transacoes.index')->with('success','Transação apagada com sucesso!');
        }else{
            return redirect()->route('transacoes.index')->with('error','Não foi possível apagar a transação!!');
        }
    }
}
