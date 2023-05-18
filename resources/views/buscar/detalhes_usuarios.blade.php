@include('layouts.app')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-laptop"></i> Detalhes</h1>
            <p>Usuarios</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Detalhes</li>
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
                        <div class="col-md-11 control-label">
                            <p class="help-block">
                                <h11>*</h11> Campo Obrigatório
                            </p>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="input-group-addon">Nome <h11>*</h11></span>
                                    <input id="name" type="text" class="form-control input-md @error('name') is-invalid @enderror" name="name" value="{{ $usuarios->name }}" required autocomplete="name" autofocus>

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
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $usuarios->email }}" required autocomplete="email">

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
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" value="{{ $usuarios->password }}" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                    <div class="col-md-6">
                                        <span class="input-group-addon">Acesso Admin<h11>*</h11></span>
                                        <input class="form-control" id="admin" name="admin" rows="3" value="{{ $usuarios->admin }}">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-8">
                                    <a class="btn btn-success" type="button" href="{{ route('editarusuarios.edit', $usuarios->id) }}">Editar</a>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</main>
