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
        $data2 = Produto::all();

        $produtos = count($data);
        $a = Produto::all();

        return view('produtosShow', [
            'produtos' => $data,
            'produtos2' => $data2,
            'total'=> $produtos,
            'a' => $a
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

    public function teste(Request $request)
    {
        $filters = $request->get('filterValues');

        if ($filters) {
            $values = explode(",", $filters);
        }

        for ($i = 0; $i < count($values); $i++) {
            $temp = Produto::where('descricao', 'like', '%' . $values[$i] . '%')->get();
            if($temp != [] && count($temp) > 0){
                $data[] = $temp;
            }
        }

        for ($i = 0; $i < count($data); $i++) {
            foreach ($data[$i] as $item){
                $total[] = $item;
            }
        }


        $final = array_unique($total);
        //dd($total);
        $u = Produto::all();
        $produtos = count($u);

        return view('produtosShow', [
            'a' => $final,
            'total'=> $produtos,
            'produtos' => $u
        ]);


    }
    public function pegaCheck(Request $request)
    {


        $teste = $request->testePesquisa;

        $data = [];
        $total = [];
        for ($i = 0; $i < count($teste); $i++) {
            $temp = Produto::where('descricao', 'like', '%' . $teste[$i] . '%')->get();
            if($temp != [] && count($temp) > 0){
                $data[] = $temp;
            }
        }


        for ($i = 0; $i < count($data); $i++) {
            foreach ($data[$i] as $item){
                $total[] = $item;
            }
        }

        $response['success'] = true;
        $response['data'] = $total;
        $response['quantidade'] = count($total);

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
