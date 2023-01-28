<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FotosController extends Controller
{
    /**
     * Acesso a tela de fotos.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('admin.fotos');
    }

    /**
     * Salva arquivos.
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $arquivos = array();
            $agora = Carbon::now();
            $criador = $request->criado_por;
            foreach($request->arquivos as $arquivo) {
                $nome_arquivo = $arquivo->getClientOriginalName();
                $caminho_arquivo = Storage::disk('public')->put('img', $arquivo);
                $arquivos[] = [
                    'nome' => $nome_arquivo,
                    'caminho' => $caminho_arquivo,
                    'criado_por' => $criador,
                    'criado_em' => $agora,
                    'atualizado_em' => $agora
                ];
            }
            Arquivo::insert($arquivos);
    
            return new Response(['mensagem' => 'Sucesso! '.count($arquivos).' arquivo(s) cadastrado(s)!'], 201);
        } catch(Exception $e) {
            return new Response(['mensagem' => 'Houve um erro ao tentar fazer o upload das imagens. Erro:'.$e->getMessage()]);
        }
    }
}
