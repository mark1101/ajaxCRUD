<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutosController extends Controller
{
    public function indexShow()
    {
        return view('produtosShow', [
            'produtos' => $data = Produto::all();
        ]);
    }

    public function indexCreate()
    {
        return view('produtosCreate');
    }

    public function create(Request $request)
    {
        Produto::create($request->all());

        return redirect('/produtosCreate');
    }

    public function mostra(Request $request)
    {

        $data = Produto::where('nome', 'like', '%' . $request->criterio . '%')
            ->get();

        $response['success'] = true;
        $response['data'] = $data;

        echo json_encode($response);
    }

    public function mostraComida()
    {

        $data = Produto::where('descricao', 'like', '%' . 'comida' . '%')
            ->get();

        $response['success'] = true;
        $response['data'] = $data;

        echo json_encode($response);
    }

    public function mostraMoveis()
    {

        $data = Produto::where('descricao', 'like', '%' . 'movel' . '%')
            ->get();

        $response['success'] = true;
        $response['data'] = $data;

        echo json_encode($response);
    }

    public function mostraBebidas()
    {

        $data = Produto::where('descricao', 'like', '%' . 'bebida' . '%')
            ->get();

        $response['success'] = true;
        $response['data'] = $data;

        echo json_encode($response);
    }

    public function pegaCheck(Request $request)
    {

        if($request->comida and $request->bebida != null){
            $data = Produto::where('descricao', 'like', '%' . $request->comida . '%')
                ->and('descrica', 'like', '%' . $request->comida . '%')
                ->get();
        }
        if ($request->comida != null) {
            $data = Produto::where('descricao', 'like', '%' . $request->comida . '%')
                ->get();
        }
        else if ($request->bebida != null){
            $data = Produto::where('descricao', 'like', '%' . $request->bebida . '%')
                ->get();
        }


        $response['success'] = true;
        $response['data'] = $data;

        echo json_encode($response);

    }


    public function puxaProduto($id)
    {
        if (Produto::where('id', $id)->count() == 0) {
            $response['sucess'] = true;
            $response['message'] = "Nenhum Produto Encontrado";

            echo json_encode($response);
        } else {
            $response['sucess'] = true;
            $response['data'] = $data;

            echo json_encode($response);
        }
    }

    public function update(Request $request, $id)
    {

        $data = $request->all();
        unset($data['_token']);
        Produto::where('id', $id)->update($data);

        $response['success'] = true;
        $response['message'] = "Produto editado com sucesso!";

        echo json_encode($response);
    }

    public function delete($id)
    {
        Produto::where('id', $id)->delete();

        $response['success'] = true;
        $response['message'] = "Produto deletado com Sucesso !";

        echo json_encode($response);
    }
}
