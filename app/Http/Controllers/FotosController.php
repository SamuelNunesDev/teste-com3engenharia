<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateFotoRequest;
use App\Models\Arquivo;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
     * @return \Symfony\Component\HttpFoundation\StreamedResponse|\Illuminate\Contracts\View\View
     */
    public function baixar(Arquivo $arquivo)
    {
        try {
            return Storage::download($arquivo->caminho, $arquivo->nome);
        } catch(Exception $e) {
            return view('paginaInexistente');
        }
    }

    /**
     * Atualiza o registro de um arquivo no banco.
     * 
     * @param \App\Http\Requests\UpdateFotoRequest $request
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function update(UpdateFotoRequest $request)
    {
        try {
            $arquivo = Arquivo::findOrFail($request->id);
            $arquivo->update($request->only('nome'));

            return back()->with('sucesso', 'Nome do arquivo alterado com sucesso.');
        } catch(ModelNotFoundException $e) {
            return new Response(['mensagem' => 'Houve um erro ao tentar atualizar o arquivo. Erro: Arquivo não encontrado ou inexistente.']); 
        } catch(Exception $e) {
            return new Response(['mensagem' => 'Houve um erro ao tentar atualizar o arquivo. Erro: '.$e->getMessage()]); 
        }
    }
}
