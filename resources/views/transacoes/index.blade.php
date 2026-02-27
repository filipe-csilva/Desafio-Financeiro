<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #2c3e50 0%, #1e2a36 100%);
            color: #fff;
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
        }
        
        .sidebar .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: #fff;
        }
        
        .sidebar .nav-link.active {
            background-color: #3498db;
            color: #fff;
        }
        
        .sidebar .nav-link i {
            margin-right: 10px;
        }
        
        .navbar-top {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 15px 0;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #3498db;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }
        
        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 sidebar">
                <div class="p-4">
                    <h4 class="text-white mb-4">
                        <i class="bi bi-bank2 me-2"></i>
                        Sistema
                    </h4>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link" href="#">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                    <a class="nav-link active" href="#">
                        <i class="bi bi-arrow-left-right"></i>
                        Transações
                    </a>
                    <a class="nav-link" href="#">
                        <i class="bi bi-people"></i>
                        Clientes
                    </a>
                    <a class="nav-link" href="#">
                        <i class="bi bi-gear"></i>
                        Configurações
                    </a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 px-0">
                <!-- Top Navbar -->
                <div class="navbar-top">
                    <div class="d-flex justify-content-between align-items-center px-4">
                        <div class="d-flex align-items-center">
                            <button class="btn btn-link d-md-none text-dark me-3">
                                <i class="bi bi-list fs-4"></i>
                            </button>
                            <h5 class="mb-0">Olá, Usuário</h5>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-bell fs-5 me-3"></i>
                            <div class="user-avatar">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Your existing content -->
                <div class="main-content p-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <!-- Your existing code starts here -->
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
                                            <th>Status</th>
                                            <th class="d-flex justify-content-end align-items-center">Ações</th>
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
                                                <td class="d-flex justify-content-end">
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-three-dots-vertical"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a href=" {{ route('transacoes.show', $transacao->id) }} " class="dropdown-item">Ver</a>
                                                            </li>
                                                            <li>
                                                                <a href=" {{ route('transacoes.edit', $transacao->id) }} " class="dropdown-item">Editar</a>
                                                            </li>
                                                            <li>
                                                                <form action="{{ route( 'transacoes.destroy', $transacao->id ) }}" method="POST" class="d-inline">
                                                                    @csrf @method('DELETE')
                                                                    <button class="dropdown-item">Excluir</button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Your existing code ends here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>