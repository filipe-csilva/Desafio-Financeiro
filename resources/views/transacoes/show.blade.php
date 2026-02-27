<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Transação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5 mb-5">
                <div class="border-bottom d-flex justify-content-between align-items-center">
                    <h2>Detalhes da Transação</h2>
                    <a href="{{ route('transacoes.index') }}" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i> Voltar
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success mt-2" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger mt-2" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="card mt-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Informações da Transação #{{ $transacao->id }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="150">ID:</th>
                                        <td>{{ $transacao->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Valor:</th>
                                        <td><strong>R$ {{ number_format($transacao->valor, 2, ',', '.') }}</strong></td>
                                    </tr>
                                    <tr>
                                        <th>CPF:</th>
                                        <td>{{ $transacao->cpf }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status:</th>
                                        <td>
                                            @php
                                                $statusClass = [
                                                    'em_processamento' => 'warning',
                                                    'aprovada' => 'success',
                                                    'negada' => 'danger'
                                                ][$transacao->status] ?? 'secondary';
                                            @endphp
                                            <span class="badge bg-{{ $statusClass }}">
                                                {{ strtoupper(str_replace('_', ' ', $transacao->status)) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @if($transacao->arquivo_nome)
                                    <tr>
                                        <th>Comprovante:</th>
                                        <td>
                                            <img src="{{ asset('storage/' . $transacao->arquivo_nome) }}" alt="Comprovante da Transação" class="img-fluid">
                                        </td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="150">Data Criação:</th>
                                        <td>{{ $transacao->created_at ? $transacao->created_at->format('d/m/Y H:i:s') : 'Não disponível' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Última Atualização:</th>
                                        <td>{{ $transacao->updated_at ? $transacao->updated_at->format('d/m/Y H:i:s') : 'Não disponível' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Usuário:</th>
                                        <td>{{ $transacao->user_id }} (ID do usuário)</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>