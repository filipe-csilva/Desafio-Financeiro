<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransacaoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\transacoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        try {
            if ($request->hasFile('documento') && $request->file('documento')->isValid()) {
                
            
                $nomeArquivo = time() . '_' . uniqid() . '.' . $request->documento->extension();
                
                
                $caminho = 'documentos/' . date('Y/m');
                
                $caminhoCompleto = $request->file('documento')->storeAs(
                    $caminho, 
                    $nomeArquivo, 
                    'public'
                );
                
                $transacao = Transacoes::create([
                    'user_id' => Auth::id(),
                    'valor' => $request->valor,
                    'cpf' => preg_replace('/[^0-9]/', '', $request->cpf),
                    'arquivo_nome' => $caminhoCompleto,
                    'status' => 'em_processamento'
                ]);
                
                if($transacao){
                    return redirect()->route('transacoes.index')->with('success','Curso cadastrado com sucesso!');
                }else{
                    return redirect()->route('transacoes.index')->with('error','Não foi possivel cadastrar o curso!!');
                }
            }
            
            return back()
                ->withInput()
                ->with('error', 'Erro ao fazer upload do documento.');
                
        } catch (\Exception $e) {
            Log::error('Erro ao criar transação: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Erro ao processar a transação: ' . $e->getMessage());
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
            'status' => $request['status'],
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
