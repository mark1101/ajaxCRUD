@extends('layouts.app')

    <!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>

@section('content')


    <div class="container" align="right">
        <a href="{{route('indexProdutosShow')}}">Ver Produtos Cadastrados</a>
    </div>


    <div class="container" align="center">
        <form action="{{route('createProduto')}}" method="post">
            @csrf

            <div class="form-group">
                <label style="float: left">Nome do Produto</label>
                <input type="text" class="form-control" name="nome" id="nome" aria-describedby="emailHelp"
                       placeholder="Digite o nome do Produto"required>
            </div>
            <div class="form-group">
                <label style="float: left">Descricao</label>
                <input type="text" class="form-control" name="descricao" id="descricao"
                       placeholder="Descrição do Produto" required>
            </div>
            <div class="form-group">
                <label style="float: left">Valor</label>
                <input type="number" class="form-control" name="valor" id="valor"
                       placeholder="Digite o valor do produto" required>
            </div>
            <div class="form-group">
                <label style="float: left">Quantidade</label>
                <input type="number" class="form-control" name="quantidade" id="quantidade"
                       placeholder="Digite a quantidade do produto em estoque" required>
            </div>
            <div class="form-group">
                <label style="float: left">Disponibilidade</label>
                <select class="form-control" name="disponibilidade" id="disponibilidade">
                    <option>Sim</option>
                    <option>Não</option>
                </select>
            </div>

            <button style="float: right" type="submit" class="btn btn-primary">Cadastrar</button>
        </form>

    </div>



@endsection

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>
</html>
