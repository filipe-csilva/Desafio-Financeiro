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
                    <h2>Cadastro de Transação</h2>
                    <a href="{{ route('transacoes.index') }}" class="btn btn-primary">Voltar</a>
                </div>

                @if($errors->any())

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                @endif

                <form action="{{ route('transacoes.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="form-group mt-3 mb-3">
                        <label>Valor</label>
                        <input type="text" id="valor" name="valor" class="form-control" value="{{ old('valor') }}">
                    </div>
                    <div class="form-group mt-3">
                        <label>CPF</label>
                        <input type="text" id="cpf" name="cpf" class="form-control" value="{{ old('cpf') }}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="documento">Documento Comprobatório*</label>
                        
                        {{-- Área de upload customizada --}}
                        <div class="custom-file">
                            <input type="file" 
                                    class="custom-file-input @error('documento') is-invalid @enderror" 
                                    id="documento" 
                                    name="documento" 
                                    accept=".pdf,.jpg,.jpeg,.png"
                                    required>
                            <label class="custom-file-label" for="documento">
                                Escolher arquivo...
                            </label>
                        </div>

                        {{-- Preview do arquivo selecionado --}}
                        <div id="preview-container" class="mt-2 d-none">
                            <div class="alert alert-info">
                                <i class="fas fa-file"></i> 
                                <span id="file-name"></span>
                            </div>
                        </div>

                        @error('documento')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        <small class="form-text text-muted">
                            Formatos aceitos: PDF, JPG, JPEG, PNG (máx. 5MB)
                        </small>
                    </div>
                    <div class="form-group mt-3">
                        <button class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>