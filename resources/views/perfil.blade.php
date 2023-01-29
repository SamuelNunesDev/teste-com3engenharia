@extends('layout.base', ['titulo' => 'Profile - Tires'])

@section('corpo')
    <h1 class="text-center mt-1 mb-3"><i class="bi bi-person-circle"></i>&nbsp; Meu Perfil</h1>
    <div class="container border shadow rounded px-4 pb-4 pt-2 mb-5">
        <div class="mb-4">
            <h2 class="h4 pt-3 mb-0 pb-0">Meus Dados</h2>
            <small class="text-secondary">Atualize os dados da sua conta, nome e endereço de email.</small>
        </div>
        @if(Session::has('sucesso'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> &nbsp;<strong>Sucesso!</strong> {{ Session::get('sucesso') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(Session::has('erro'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> &nbsp;<strong>Erro!</strong> {{ Session::get('erro') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @error('nome')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> &nbsp;<strong>Sucesso!</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        @error('email')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> &nbsp;<strong>Erro!</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        <form action={{ route('usuario.update') }} method="post">
            @csrf
            @method('put')
            <div class="input-group mb-3">
                <span class="input-group-text">Nome:</span>
                <input type="text" class="form-control" name="nome" value="{{ auth()->user()->nome }}">
            </div>
             <div class="input-group mb-3">
                <span class="input-group-text">Email:</span>
                <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}">
            </div>
            <button type="submit" class="btn btn-primary btn-login w-100 py-2 mt-3">Salvar</button>
        </form>
        <hr class="my-3"/>
        <div class="mb-4">
            <h2 class="h4 pt-3 mb-0 pb-0">Atualizar Senha</h2>
            <small class="text-secondary">Certifique-se de que sua conta esteja usando uma senha longa e aleatória para se manter segura.</small>
        </div>
        @if(Session::has('sucesso_senha'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> &nbsp;<strong>Sucesso!</strong> {{ Session::get('sucesso_senha') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(Session::has('erro_senha'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> &nbsp;<strong>Erro!</strong> {{ Session::get('erro_senha') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @error('senha_atual')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> &nbsp;<strong>Sucesso!</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        @error('nova_senha')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> &nbsp;<strong>Erro!</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        @error('senha_confirmar')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> &nbsp;<strong>Erro!</strong> {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        <form action={{ route('usuario.update') }} method="post">
            @csrf
            @method('put')
            <div class="input-group mb-3">
                <span class="input-group-text">Senha atual:</span>
                <input type="password" class="form-control" name="senha_atual" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Nova senha:</span>
                <input type="password" class="form-control" name="nova_senha" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text">Confirme a nova senha:</span>
                <input type="password" class="form-control" name="senha_confirmar" required>
            </div>
            <button type="submit" class="btn btn-primary btn-login w-100 py-2 mt-3">Salvar</button>
        </form>
                <hr class="my-3"/>
        <div class="mb-4">
            <h2 class="h4 pt-3 mb-0 pb-0">Excluir Conta</h2>
            <small class="text-secondary">Depois que sua conta for excluída, não será possível efetuar o login com as suas credenciais.</small>
        </div>
        <form action={{ route('usuario.delete', ['usuario' => auth()->user()->id]) }} method="post" id="formulario-deletar-usuario">
            @csrf
            @method('delete')
            <button type="button" id="btn-deletar-usuario" class="btn btn-danger btn-sm py-2 mt-3"><i class="bi bi-trash"></i> &nbsp; Excluir Conta</button>
        </form>
        <hr/>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#btn-deletar-usuario').on('click', function() {
                 Swal.fire({
                    title: 'Voce tem certeza?',
                    text: 'Deseja excluir seu usuário?',
                    showCancelButton: true,
                    confirmButtonText: 'Sim, excluir.',
                    cancelButtonText: `Não, cancelar.`,
                    icon: 'question'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#formulario-deletar-usuario').submit()
                    }
                })
            })
        })
    </script>
@endsection