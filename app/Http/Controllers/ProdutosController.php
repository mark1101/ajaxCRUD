<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdutosController extends Controller
{
    public function indexShow()
    {
        $data = Produto::all();

        return view('produtosShow', [
            'produtos' => $data
        ]);
    }

    public function indexCreate()
    {
        return view('produtosCreate');
    }

    public function create(Request $request)
    {

        $data = $request->all();

        Produto::create($data);

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

        //dd($request->testePesquisa);

        //dd($request->testePesquisa);

        //$teste = $request->testePesquisa;

        //$valor = implode(" " , $teste);
        //dd($valor);
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

        $data = Produto::where('id', $id)->get();
        if (count($data) == 0) {
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

    public function delete(Request $request, $id)
    {

        $data = $request->all();
        unset($data['_token']);
        Produto::where('id', $id)->delete($data);

        $response['success'] = true;
        $response['message'] = "Produto deletado com Sucesso !";

        echo json_encode($response);
    }
}
