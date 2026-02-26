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
                    <h2>Listagem de transações</h2>
                    <a href="{{ route('transacoes.create') }}" class="btn btn-primary">Cadastrar Transação</a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success mt-2" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger mt2" role="alert">
                        {{ session('error') }}
                    </div>
                @endif


                <table class="table table-hover table-striped mt-5">
                    <thead>
                        <tr>
                            <th>Data/Hora</th>
                            <th>Valor</th>
                            <th class="d-flex justify-content-start align-items-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transacoes as $transacao)
                            <tr>
                                <td>
                                    @if($transacao->created_at)
                                        {{ $transacao->created_at->format('d/m/Y H:i:s') }}
                                    @else
                                        Data não disponível
                                    @endif
                                </td>
                                <td>R$ {{ $transacao->valor }}</td>
                                <td class="d-flex justify-content-start">
                                    <a href=" {{ route('transacoes.edit', $transacao->id) }} " class="btn btn-success">Editar</a>

                                    <form action="{{ route('transacoes.destroy', $transacao->id ) }}" class="d-line gap-2" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>