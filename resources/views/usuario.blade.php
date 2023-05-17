@include('layouts.app')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-laptop"></i> Cadastro</h1>
            <p>Usuarios</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Cadastros</li>
            <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
        </ul>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-6" style="display: inline-block; margin: auto;">
            <div class="tile">
                <h3 class="tile-title">Usuarios</h3>
                <div class="tile-body">
                    <form class="form-horizontal" method="POST" action="{{ route('usuario.store') }}">
                        @csrf
                        <div class="col-md-11 control-label">
                            <p class="help-block">
                                <h11>*</h11> Campo Obrigatório
                            </p>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="input-group-addon">Nome <h11>*</h11></span>
                                    <input id="name" type="text" class="form-control input-md @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="input-group-addon">E-mail<h11>*</h11></span>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="input-group-addon">Senha<h11>*</h11></span>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <span class="input-group-addon">Confime a Senha<h11>*</h11></span>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <button id="Cadastrar" data-toggle="modal" data-target="#exampleModal"
                                        name="Cadastrar" class="btn btn-success" type="Submit">Cadastrar</button>
                                    <button id="cancelar" name="cancelar" class="btn btn-danger"
                                        type="Reset">Cancelar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
