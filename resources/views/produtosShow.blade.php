@extends('layouts.app')

    <!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>

</head>
<body>

@section('content')

    <form id="buscaProduto">
        <div class="container" align="right">
            <a href="{{route('indexProdutoCreate')}}">Cadastro de Produto</a>
        </div>
        <div class="container">
            <div class="form-group">
                <label for="exampleInputEmail1">Pesquisa de produto por nome</label>
                <input type="text" onkeyup="submitForm()" class="form-control" name="criterio" id="criterio"
                       aria-describedby="emailHelp" placeholder="Digite o nome do Produto...">
            </div>
        </div>
    </form>

    <div class="container">
        <div class="row">
            <form id="buscaComida">
                @csrf
                <button type="submit"
                        style="border-radius: 15px ; color: white ; background-color: #1d68a7 ; padding-left: 25px ; padding-right: 25px">
                    Comida
                </button>
            </form>
            <form id="buscaMoveis">
                @csrf
                <button type="submit"
                        style="border-radius: 15px ; color: white ; background-color: #1d68a7 ; padding-left: 25px ; padding-right: 25px">
                    Moveis
                </button>
            </form>
            <form id="buscaBebida">
                @csrf
                <button type="submit"
                        style="border-radius: 15px ; color: white ; background-color: #1d68a7; padding-left: 25px ; padding-right: 25px">
                    Bebidas
                </button>
            </form>
            <form id="">
                @csrf
                <button type=""
                        style="border-radius: 15px ; color: white ; background-color: green; padding-left: 25px ; padding-right: 25px">
                    Ativar
                </button>
            </form>
        </div>
    </div>

    <div class="container">
            <form id="buscaCheck">
                @csrf
                <input type="checkbox" class="form-check-input" name="comida" value = "comida">
                <label>Teste 1 </label>
                <br>
                <input type="checkbox" class="form-check-input" name = "bebida" value = "bebida">
                <label>Teste 2</label>
                <br>
                <button type="submit" class="btn btn-primary">Mandar</button>
            </form>

    </div>


    <br>


    @foreach($produtos as $produto)
        <div class="modal fade" id="modalUpdate{{$produto->id}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Título do modal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="editPaciente" class="modal-body">
                        <div class=" container">
                            <form id="form{{$produto->id}}">
                                @csrf
                                Nome: <label for="name{{$produto->id}}"></label>
                                <input id="name{{$produto->id}}" name="nome" class="form-control"
                                       value="{{$produto->nome}}" required>
                                <br>
                                Descricao: <label for="ultimo{{$produto->id}}"></label>
                                <input id="descricao{{$produto->id}}" name="descricao"
                                       class="form-control"
                                       value="{{$produto->descricao}}" required>
                                <br>
                                Valor: <label for="name{{$produto->id}}"></label>
                                <input id="valor{{$produto->id}}" name="valor" class="form-control"
                                       value="{{$produto->valor}}" required>
                                <br>
                                <select class="form-control" name="disponibilidade"
                                        id="disponibilidade{{$produto->id}}">
                                    <option>Sim</option>
                                    <option>Não</option>
                                </select>

                                <br>
                                <div class="row" style="float: right; left: 30%">
                                    <button type="submit" class="btn btn-success">Salvar mudanças
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- script para edicao -->
                        <script>
                            $(function () {
                                $('form[id="form{{$produto->id}}"]').submit(function (event) {
                                    event.preventDefault();
                                    $.ajax({
                                        url: "{{route('updateProduto',['id'=>$produto->id])}}",
                                        type: "post",
                                        data: $(this).serialize(),
                                        dataType: 'json',
                                        success: function (response) {
                                            if (response.success === true) {
                                                $("#footer{{$produto->id}}").fadeIn();
                                                $("#message{{$produto->id}}").text(response.message);
                                                $.wait(function () {
                                                    $("#footer{{$produto->id}}").fadeOut();
                                                }, 5);
                                                $("#buscaProduto").submit();
                                            }
                                        }
                                    });
                                });
                                $.wait = function (callback, seconds) {
                                    return window.setTimeout(callback, seconds * 1000);
                                }
                            });
                        </script>
                    </div>
                    <div class="modal-footer" id="footer{{$produto->id}}" style="display: none">
                        <span id="message{{$produto->id}}" style="color: green"></span>
                    </div>
                    <div class="modal-footer" id="footerError{{$produto->id}}"
                         style="display: none">
                        <span id="message{{$produto->id}}" style="color: red"></span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach <!-- model para update -->

    @foreach($produtos as $produto)
        <div class="modal fade" id="modalDelete{{$produto->id}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Produto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="editPaciente" class="modal-body">
                        <div class=" container">
                            <form id="formDelete{{$produto->id}}">
                                @csrf
                                <div>
                                    <h4>Deletar o produto {{$produto->nome}}?</h4>
                                </div>
                                <br>
                                <div class="row" style="float: right; left: 30%">
                                    <button id="#modDelete" style="float: right" type="submit" class="btn btn-success">
                                        Deletar Produto
                                    </button>
                                </div>
                            </form>
                        </div>


                        <!-- script para edicao -->
                        <script>
                            $(function () {
                                $('form[id="formDelete{{$produto->id}}"]').submit(function (event) {
                                    event.preventDefault();
                                    $.ajax({
                                        url: "{{route('deleteProduto',['id'=>$produto->id])}}",
                                        type: "post",
                                        data: $(this).serialize(),
                                        dataType: 'json',
                                        success: function (response) {
                                            if (response.success === true) {
                                                $("#footer{{$produto->id}}").fadeIn();
                                                $("#message{{$produto->id}}").text(response.message);
                                                $.wait(function () {
                                                    $("#footer{{$produto->id}}").fadeOut();
                                                }, 5);
                                                $("#buscaProduto").submit();
                                                $('#modDelete').modal('hide');
                                            }
                                        }
                                    });
                                });
                                $.wait = function (callback, seconds) {
                                    return window.setTimeout(callback, seconds * 1000);
                                }
                            });
                        </script>
                    </div>
                    <div class="modal-footer" id="footer{{$produto->id}}" style="display: none">
                        <span id="message{{$produto->id}}" style="color: green"></span>
                    </div>
                    <div class="modal-footer" id="footerError{{$produto->id}}"
                         style="display: none">
                        <span id="message{{$produto->id}}" style="color: red"></span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach <!-- model para delete -->

    @foreach($produtos as $produto)
        <div class="modal fade" id="modalVisu{{$produto->id}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Produto {{$produto->nome}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="editPaciente" class="modal-body">
                        <div class=" container">
                            <form id="form{{$produto->id}}">
                                @csrf
                                Nome: <label for="name{{$produto->id}}"></label>
                                <input id="name{{$produto->id}}" name="nome" class="form-control"
                                       value="{{$produto->nome}}" required disabled>
                                <br>
                                Descricao: <label for="ultimo{{$produto->id}}"></label>
                                <input id="descricao{{$produto->id}}" name="descricao"
                                       class="form-control"
                                       value="{{$produto->descricao}}" required disabled>
                                <br>
                                Valor: <label for="name{{$produto->id}}"></label>
                                <input id="valor{{$produto->id}}" name="valor" class="form-control"
                                       value="{{$produto->valor}}" required disabled>
                                <br>
                                <select class="form-control" name="disponibilidade" id="disponibilidade{{$produto->id}}"
                                        disabled>
                                    <option>Sim</option>
                                    <option>Não</option>
                                </select>

                                <br>
                                <div class="row" style="float: right; left: 30%">

                                </div>
                            </form>
                        </div>

                        <!-- script para edicao -->
                        <script>
                            $(function () {
                                $('form[id="form{{$produto->id}}"]').submit(function (event) {
                                    event.preventDefault();
                                    $.ajax({
                                        url: "{{route('updateProduto',['id'=>$produto->id])}}",
                                        type: "post",
                                        data: $(this).serialize(),
                                        dataType: 'json',
                                        success: function (response) {
                                            if (response.success === true) {
                                                $("#footer{{$produto->id}}").fadeIn();
                                                $("#message{{$produto->id}}").text(response.message);
                                                $.wait(function () {
                                                    $("#footer{{$produto->id}}").fadeOut();
                                                }, 5);
                                                $("#buscaProduto").submit();
                                            }
                                        }
                                    });
                                });
                                $.wait = function (callback, seconds) {
                                    return window.setTimeout(callback, seconds * 1000);
                                }
                            });
                        </script>
                    </div>
                    <div class="modal-footer" id="footer{{$produto->id}}" style="display: none">
                        <span id="message{{$produto->id}}" style="color: green"></span>
                    </div>
                    <div class="modal-footer" id="footerError{{$produto->id}}"
                         style="display: none">
                        <span id="message{{$produto->id}}" style="color: red"></span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach <!-- model para visuzalizar produto -->


    <div class="container" align="center">
        <table id="tabelaProdutos" class="table">
            <thead>

            </thead>
            <tbody>


            </tbody>
        </table>

    </div>

    <script>
        function submitForm() {
            if ($("#criterio").val() === "") {
                $("#tabelaProdutos").html("");
            } else {
                $("#buscaProduto").submit();
            }
        }
    </script> <!-- script para ir dando submit a cada letra digitada -->


    <script>
        $(function () {
            $('form[id="buscaProduto"]').submit(function (event) {
                event.preventDefault();
                $.ajax({
                    url: "{{route('mostraProduto')}}",
                    type: "get",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if (response.success === true) {
                            var newRow = $("<tr>");
                            var cols = "";
                            cols += '<th>Nome</th>';
                            cols += '<th>Descricao</th>';
                            cols += '<th>Valor</th>';
                            cols += '<th>Quantidade</th>';
                            cols += '<th>Disponibilidade</th>';
                            cols += '<th></th>';
                            cols += '<th></th>';
                            newRow.append(cols);

                            $("#tabelaProdutos").html("").append(newRow).fadeIn();
                            //funcionou
                            $.each(response.data, function (item, value) {
                                var newRow = $("<tr>");
                                var cols = "";
                                cols += '<td>' + response.data[item]["nome"] + '</td>';
                                cols += '<td>' + response.data[item]["descricao"] + '</td>';
                                cols += '<td>' + response.data[item]["valor"] + '</td>';
                                cols += '<td>' + response.data[item]["quantidade"] + '</td>';
                                if (response.data[item]["disponibilidade"] === 'Sim') {
                                    cols += '<td style="color: green">' + response.data[item]["disponibilidade"] + '</td>';
                                } else {
                                    cols += '<td style="color: red">' + response.data[item]["disponibilidade"] + '</td>';
                                }
                                cols += '<td><a  href="#" data-toggle="modal" data-target="#modalUpdate' + response.data[item]['id'] + '" style="width: 55px;">Editar</a>\n</td>';
                                cols += '<td><a  href="#" data-toggle="modal" data-target="#modalDelete' + response.data[item]['id'] + '" style="width: 55px;">Delete</a>\n</td>';
                                cols += '<td><a  href="#" data-toggle="modal" data-target="#modalVisu' + response.data[item]['id'] + '" style="width: 55px;">Visualizar</a>\n</td>';


                                newRow.append(cols);
                                $("#tabelaProdutos").append(newRow).fadeIn();
                            });
                        } else {
                            //erro
                        }
                    }
                });
            });
        });
    </script> <!-- funcao que mostra pelo input -->

    <script>
        $(function () {
            $('form[id="buscaComida"]').submit(function (event) {
                event.preventDefault();
                $.ajax({
                    url: "{{route('mostraComida')}}",
                    type: "get",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if (response.success === true) {
                            var newRow = $("<tr>");
                            var cols = "";
                            cols += '<th>Nome</th>';
                            cols += '<th>Descricao</th>';
                            cols += '<th>Valor</th>';
                            cols += '<th>Quantidade</th>';
                            cols += '<th>Disponibilidade</th>';
                            cols += '<th></th>';
                            cols += '<th></th>';
                            newRow.append(cols);

                            $("#tabelaProdutos").html("").append(newRow).fadeIn();
                            //funcionou
                            $.each(response.data, function (item, value) {
                                var newRow = $("<tr>");
                                var cols = "";
                                cols += '<td>' + response.data[item]["nome"] + '</td>';
                                cols += '<td>' + response.data[item]["descricao"] + '</td>';
                                cols += '<td>' + response.data[item]["valor"] + '</td>';
                                cols += '<td>' + response.data[item]["quantidade"] + '</td>';
                                if (response.data[item]["disponibilidade"] === 'Sim') {
                                    cols += '<td style="color: green">' + response.data[item]["disponibilidade"] + '</td>';
                                } else {
                                    cols += '<td style="color: red">' + response.data[item]["disponibilidade"] + '</td>';
                                }
                                cols += '<td><a  href="#" data-toggle="modal" data-target="#modalUpdate' + response.data[item]['id'] + '" style="width: 55px;">Editar</a>\n</td>';
                                cols += '<td><a  href="#" data-toggle="modal" data-target="#modalDelete' + response.data[item]['id'] + '" style="width: 55px;">Delete</a>\n</td>';
                                cols += '<td><a  href="#" data-toggle="modal" data-target="#modalVisu' + response.data[item]['id'] + '" style="width: 55px;">Visualizar</a>\n</td>';


                                newRow.append(cols);
                                $("#tabelaProdutos").append(newRow).fadeIn();
                            });
                        } else {
                            //erro
                        }
                    }
                });
            });
        });
    </script> <!-- funcao que mostra pela comida -->

    <script>
        $(function () {
            $('form[id="buscaMoveis"]').submit(function (event) {
                event.preventDefault();
                $.ajax({
                    url: "{{route('mostraMoveis')}}",
                    type: "get",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if (response.success === true) {
                            var newRow = $("<tr>");
                            var cols = "";
                            cols += '<th>Nome</th>';
                            cols += '<th>Descricao</th>';
                            cols += '<th>Valor</th>';
                            cols += '<th>Quantidade</th>';
                            cols += '<th>Disponibilidade</th>';
                            cols += '<th></th>';
                            cols += '<th></th>';
                            newRow.append(cols);

                            $("#tabelaProdutos").html("").append(newRow).fadeIn();
                            //funcionou
                            $.each(response.data, function (item, value) {
                                var newRow = $("<tr>");
                                var cols = "";
                                cols += '<td>' + response.data[item]["nome"] + '</td>';
                                cols += '<td>' + response.data[item]["descricao"] + '</td>';
                                cols += '<td>' + response.data[item]["valor"] + '</td>';
                                cols += '<td>' + response.data[item]["quantidade"] + '</td>';
                                if (response.data[item]["disponibilidade"] === 'Sim') {
                                    cols += '<td style="color: green">' + response.data[item]["disponibilidade"] + '</td>';
                                } else {
                                    cols += '<td style="color: red">' + response.data[item]["disponibilidade"] + '</td>';
                                }
                                cols += '<td><a  href="#" data-toggle="modal" data-target="#modalUpdate' + response.data[item]['id'] + '" style="width: 55px;">Editar</a>\n</td>';
                                cols += '<td><a  href="#" data-toggle="modal" data-target="#modalDelete' + response.data[item]['id'] + '" style="width: 55px;">Delete</a>\n</td>';
                                cols += '<td><a  href="#" data-toggle="modal" data-target="#modalVisu' + response.data[item]['id'] + '" style="width: 55px;">Visualizar</a>\n</td>';


                                newRow.append(cols);
                                $("#tabelaProdutos").append(newRow).fadeIn();
                            });
                        } else {
                            //erro
                        }
                    }
                });
            });
        });
    </script> <!-- funcao que mostra pelos moveis -->

    <script>
        $(function () {
            $('form[id="buscaBebida"]').submit(function (event) {
                event.preventDefault();
                $.ajax({
                    url: "{{route('mostraBebidas')}}",
                    type: "get",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if (response.success === true) {
                            var newRow = $("<tr>");
                            var cols = "";
                            cols += '<th>Nome</th>';
                            cols += '<th>Descricao</th>';
                            cols += '<th>Valor</th>';
                            cols += '<th>Quantidade</th>';
                            cols += '<th>Disponibilidade</th>';
                            cols += '<th></th>';
                            cols += '<th></th>';
                            newRow.append(cols);

                            $("#tabelaProdutos").html("").append(newRow).fadeIn();
                            //funcionou
                            $.each(response.data, function (item, value) {
                                var newRow = $("<tr>");
                                var cols = "";
                                cols += '<td>' + response.data[item]["nome"] + '</td>';
                                cols += '<td>' + response.data[item]["descricao"] + '</td>';
                                cols += '<td>' + response.data[item]["valor"] + '</td>';
                                cols += '<td>' + response.data[item]["quantidade"] + '</td>';
                                if (response.data[item]["disponibilidade"] === 'Sim') {
                                    cols += '<td style="color: green">' + response.data[item]["disponibilidade"] + '</td>';
                                } else {
                                    cols += '<td style="color: red">' + response.data[item]["disponibilidade"] + '</td>';
                                }
                                cols += '<td><a  href="#" data-toggle="modal" data-target="#modalUpdate' + response.data[item]['id'] + '" style="width: 55px;">Editar</a>\n</td>';
                                cols += '<td><a  href="#" data-toggle="modal" data-target="#modalDelete' + response.data[item]['id'] + '" style="width: 55px;">Delete</a>\n</td>';
                                cols += '<td><a  href="#" data-toggle="modal" data-target="#modalVisu' + response.data[item]['id'] + '" style="width: 55px;">Visualizar</a>\n</td>';


                                newRow.append(cols);
                                $("#tabelaProdutos").append(newRow).fadeIn();
                            });
                        } else {
                            //erro
                        }
                    }
                });
            });
        });
    </script> <!-- funcao que mostra pelas bebidas -->

     <script>
        $(function () {
            $('form[id="buscaCheck"]').submit(function (event) {
                event.preventDefault();
                $.ajax({
                    url: "{{route('pegaCheck')}}",
                    type: "post",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (response) {
                        if (response.success === true) {
                            var newRow = $("<tr>");
                            var cols = "";
                            cols += '<th>Nome</th>';
                            cols += '<th>Descricao</th>';
                            cols += '<th>Valor</th>';
                            cols += '<th>Quantidade</th>';
                            cols += '<th>Disponibilidade</th>';
                            cols += '<th></th>';
                            cols += '<th></th>';
                            newRow.append(cols);

                            $("#tabelaProdutos").html("").append(newRow).fadeIn();
                            //funcionou
                            $.each(response.data, function (item, value) {
                                var newRow = $("<tr>");
                                var cols = "";
                                cols += '<td>' + response.data[item]["nome"] + '</td>';
                                cols += '<td>' + response.data[item]["descricao"] + '</td>';
                                cols += '<td>' + response.data[item]["valor"] + '</td>';
                                cols += '<td>' + response.data[item]["quantidade"] + '</td>';
                                if (response.data[item]["disponibilidade"] === 'Sim') {
                                    cols += '<td style="color: green">' + response.data[item]["disponibilidade"] + '</td>';
                                } else {
                                    cols += '<td style="color: red">' + response.data[item]["disponibilidade"] + '</td>';
                                }
                                cols += '<td><a  href="#" data-toggle="modal" data-target="#modalUpdate' + response.data[item]['id'] + '" style="width: 55px;">Editar</a>\n</td>';
                                cols += '<td><a  href="#" data-toggle="modal" data-target="#modalDelete' + response.data[item]['id'] + '" style="width: 55px;">Delete</a>\n</td>';
                                cols += '<td><a  href="#" data-toggle="modal" data-target="#modalVisu' + response.data[item]['id'] + '" style="width: 55px;">Visualizar</a>\n</td>';


                                newRow.append(cols);
                                $("#tabelaProdutos").append(newRow).fadeIn();
                            });
                        } else {
                            //erro
                        }
                    }
                });
            });
        });
    </script>  <!--funcao que mostra pelos moveis -->

@endsection

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>


</body>
</html>
