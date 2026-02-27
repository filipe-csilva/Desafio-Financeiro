<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5 mb-5">
                <div class="border-bottom d-flex justify-content-between align-items-center">
                    <h2>Editar Transação</h2>
                    <a href="{{ route('transacoes.index') }}" class="btn btn-primary">Voltar</a>
                </div>

                @if($errors->any())

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                @endif

                <form action="{{ route('transacoes.update', $transacao) }}" method="POST">
                    
                    @csrf @method('PUT')

                    <div class="form-group mt-3">
                        <label for="name">Valor da transação</label>
                        <input type="text" id="valor" name="valor" class="form-control" value="{{ $transacao->valor }}">
                    </div>
                    <div class="form-group mt-3">
                        <label>CPF</label>
                        <input type="text" id="cpf" name="cpf" class="form-control" value="{{ $transacao->cpf }}">
                    </div>
                    <div class="form-group mt-3">
                        <button class="btn btn-primary">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>