<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioUpdateRequest;
use App\Models\Usuario;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Acesso a tela de usuário.
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('perfil');
    }

    /**
     * Atualiza o registro do usuário.
     * 
     * @param \App\Http\Requests\UsuarioUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UsuarioUpdateRequest $request)
    {
        try {
            $tipo_erro = 'erro';
            $tipo_sucesso = 'sucesso';
            $usuario = Auth::user();
            if($request->senha_atual && Auth::attempt(['email' => $usuario->email, 'password' => $request->senha_atual]) && ($request->nova_senha === $request->senha_confirmar)) {
                $usuario->update(['password' => Hash::make($request->nova_senha)]);
                $tipo_sucesso = 'sucesso_senha';
            } elseif(!$request->email) {
                $tipo_erro = 'erro_senha';
                throw new Exception('Certifique-se que a sua senha atual está correta e/ou as demais coincidem.');
            }
            $usuario->update($request->only('nome', 'email'));

            return back()->with($tipo_sucesso, 'Dados atualizados com sucesso.');
        } catch(Exception $e) {
            return back()->with($tipo_erro ?? 'erro', 'Houve um erro ao tentar atualizar os dados do usuário. Erro: '.$e->getMessage());
        }
    }

    /**
     * Exclui um registro do usuario logado.
     * 
     * @param \App\Models\Usuario $usuario
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Usuario $usuario)
    {
        try {
            $usuario_logado = Auth::user();
            if($usuario_logado && ($usuario_logado->id === $usuario->id)) {
                Auth::logout();
                $usuario->delete();
            } else {
                throw new Exception('Você está tentando excluir a conta de outro usuário, ação não permitida.');
            }
            return redirect('/login')->with('sucesso', 'Sua conta foi excluída com sucesso.');
        } catch(Exception $e) {
            return back()->with('erro', 'Houve um erro ao tentar excluir sua conta. Erro: '.$e->getMessage());
        }
    }
}
