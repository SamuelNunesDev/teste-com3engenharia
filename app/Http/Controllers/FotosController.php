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
    public function index(Request $request)
    {
        $data = $request->data ?? Carbon::now()->format('Y-m-d');
        $arquivos = Arquivo::doDia($data)->get()->filter(fn($arquivo) => Storage::exists($arquivo->caminho));

        return view('admin.fotos', compact('arquivos', 'data'));
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
                $caminho_arquivo = $arquivo->store('public/img');
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

    /**
     * Baixa um arquivo armazenado no servidor.
     * 
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function baixar(Arquivo $arquivo)
    {
        return Storage::download($arquivo->caminho, $arquivo->nome);
    }
}
