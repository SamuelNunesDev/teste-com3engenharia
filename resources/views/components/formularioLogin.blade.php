@if($formulario == 'login')
    <form class="px-5 acesso" action="{{ route('autenticar') }}" method="post">
        <div class="row justify-content-center mb-3">
            <img src="{{ asset('assets/img/logo.png') }}" alt="aperam" id="img-logo"/>
        </div>
        <div class="row mb-4">
            <label class="text-center">Preencha os campos abaixo e entre em sua conta</label>
        </div>
        @csrf
        @if(Session::has('erro'))
            <div class="alert alert-danger text-center"><i class="bi bi-exclamation-triangle"></i> {{ Session::get('erro') }}</div>
        @endif
        @if(Session::has('sucesso'))
            <div class="alert alert-success text-center"><i class="bi bi-check-circle"></i> {{ Session::get('sucesso') }}</div>
        @endif
        <div class="mb-4">
            <label for="email" class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Digite seu e-mail" value="{{ old('email') }}" required>
            </div>
            @error('email')
                <div class="form-text text-danger">
                    <i class="bi bi-exclamation-triangle"></i> <span class="text-bold"> Erro: </span>{{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
                <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" class="form-control" placeholder="********" id="senha" name="password" required>
                <span class="input-group-text bg-white btn border" id="btn-visualizar-senha"><i id="icone-olho-senha" class="bi bi-eye"></i></span>
            </div>
            @error('password')
                <div class="form-text text-danger">
                    <i class="bi bi-exclamation-triangle"></i> <span class="text-bold"> Erro: </span>{{ $message }}
                </div>
            @enderror
        </div>
        <div class="row">
            <div class="text-end">
                <a class="text-decoration-none" href={{ route('cadastro.usuario') }}>Criar Nova Conta</a>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-login w-100 py-2 mt-3">Entrar</button>
    </form>
@else
    <form class="px-5 cadastro" action="{{ route('salvar.usuario') }}" method="post">
        @if(Session::has('erro'))
            <div class="alert alert-danger text-center"><i class="bi bi-exclamation-triangle"></i> {{ Session::get('erro') }}</div>
        @endif
        <div class="row justify-content-center mb-3">
            <img src="{{ asset('assets/img/logo.png') }}" alt="aperam" id="img-logo"/>
        </div>
        <div class="row mb-4">
            <label class="text-center">Preencha os campos abaixo e crie sua conta</label>
        </div>
        @csrf
        <div class="mb-3">
            <label for="Nome" class="form-label">Nome</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person-circle"></i></i></span>
                <input type="Nome" name="nome" class="form-control" placeholder="Digite seu nome" required>
            </div>
            @error('nome')
                <div class="form-text text-danger">
                    <i class="bi bi-exclamation-triangle"></i> <span class="text-bold"> Erro: </span>{{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="Digite seu e-mail" required>
            </div>
            @error('email')
                <div class="form-text text-danger">
                    <i class="bi bi-exclamation-triangle"></i> <span class="text-bold"> Erro: </span>{{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
                <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" class="form-control" placeholder="********" id="senha" name="password" required>
                <span class="input-group-text bg-white btn border" id="btn-visualizar-senha"><i id="icone-olho-senha" class="bi bi-eye"></i></span>
            </div>
            @error('password')
                <div class="form-text text-danger">
                    <i class="bi bi-exclamation-triangle"></i> <span class="text-bold"> Erro: </span>{{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="confirmacao-senha" class="form-label">Confirme sua senha</label>
                <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" class="form-control" placeholder="********" id="confirmacao-senha" name="confirmacao_senha" required>
                <span class="input-group-text bg-white btn border" id="btn-visualizar-confirmacao-senha"><i id="icone-confirme-sua-senha" class="bi bi-eye"></i></span>
            </div>
            @error('confirmacao_senha')
                <div class="form-text text-danger">
                    <i class="bi bi-exclamation-triangle"></i> <span class="text-bold"> Erro: </span>{{ $message }}
                </div>
            @enderror
        </div>
        <div class="row">
            <div class="text-end">
                <a class="text-decoration-none" href={{ route('login') }}>Já tenho uma conta</a>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-login w-100 py-2 mt-3">Entrar</button>
    </form>
@endif

