<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidationRequest;
use App\Models\Category;

class CategoriaController extends Controller
{
    protected $model;
    protected $totalPages = 15;
    protected $views = 'painel.modulos.categorias';
    protected $rotas = 'categorias';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function index()
    {//get() pega todos
        //paginate é quantos quero pegar
        $datas = $this->model->paginate($this->totalPages);

        return view ("{$this->views}.index", compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()//faz a view de cadastrar
    {
        return view ("{$this->views}.create-edit");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//
    {
        //validar os dados
        $this->validate($request, $this->model->rules() );//nao sei se esta certo!!!

        $dataForm = $request->all();//pegando todos os dados da variavel request do formulario
        //dd($dataForm); imprime um json do seu formulario

        //Verificar se existe a imagem
        if ( $request->hasFile('image')){
            //pegar a imagem
            $image = $request->file('image');
            //Definir no nome da imagem
            $nameFile = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();

            $upload = $image->storeAs("{$this->rotas}", $nameFile);

            if ( $upload )//se for verdadeiro
                $dataForm['image'] = $nameFile;//guardar o nome verdadeiro
            else
                return redirect()//ira voltar a rota index
                    ->route("{$this->rotas}.index")
                    ->withErrors(['errors' => 'Erro no upload da imagem'])
                    ->withInput();
        }
    
        //inserir os dados do banco de vc esta usando issso é magico
        $insert = $this->model->create($dataForm);
        //RETORNADO MENSAGEM PARA VIEW
           if($insert)
               return redirect()
                   ->route("{$this->rotas}.index")
                   ->with(['success'=>'Cadastro realizado com sucesso!']);
           else
               return redirect()
                   ->route("{$this->rotas}.create")
                   ->withErrors(['errors' => 'Falha ao cadastrar'])
                   ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)//ira procurar o id que eu tomandadno
    {
        //Recuperar usuário
        $data = $this->model->find($id);
        return view("{$this->views}.show", compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->model->find($id);
 
        return view("{$this->views}.create-edit", compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         //VALIDA OS DADOS
         $this->validate($request, $this->model->rules());
         //PEGANDO OS DADOS DO FORMULÁRIO
         $dataForm = $request->all();
         //Criar objeto usuario
         $data = $this->model->find($id);
 
         //Verificar se existe a imagem
        if ( $request->hasFile('image')){
             //pegar a imagem
             $image = $request->file('image');
 
             //Definir no nome da imagem
            if ($data->image == ''){
                $nameImage = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();
                $dataForm['image'] = $nameImage;
            } else {
                $nameImage = $data->image;
            }
 
             $upload = $image->storeAs('categorias', $nameImage);
 
             if ( $upload )
                 $dataForm['image'] = $nameImage;
             else
                 return redirect()
                     ->route("{$this->rotas}.index")
                     ->withErrors(['errors' => 'Erro no upload da imagem'])
                     ->withInput();
         }
        //Alterar os dados
        $update = $data->update($dataForm);
        if($update)
            return redirect()
                ->route("{$this->rotas}.index")
                ->with(['success'=>'Alteração realizada com sucesso!']);
        else
            return redirect()
                ->route("{$this->rotas}.update")
                ->withErrors(['errors' => 'Falha ao editar'])
                ->withInput(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->model->find($id);
        $delete = $data->delete();
        if ($delete) {
            return redirect()
                ->route("{$this->rotas}.index")
                ->with(['success'=>"{$data->name} excluido com sucesso!"]);
        } else {
            return redirect()
                ->route("{$this->rotas}.show")
                ->withErrors(['errors'=>'Falha ao excluir!']);
        }
    }

    public function search(Request $request)
    {
        //Recupera os dados do formulário
        $dataForm = $request->get('pesquisa');
        //Filtra os usuários
        $datas = $this->model
            ->where('name', 'LIKE', "%{$dataForm}%")
            ->paginate($this->totalpages);
        return view("{$this->views}.index", compact('datas', 'dataForm'));
    }
}
