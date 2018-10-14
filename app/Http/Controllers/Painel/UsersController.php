<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidationRequest;
use App\User;

class UsersController extends Controller
{
    protected $model;
    protected $totalPages = 15;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function index()
    {//get() pega todos
        //paginate é quantos quero pegar
        $users = $this->model->paginate($this->totalPages);

        return view ('painel.modulos.usuario.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()//faz a view de cadastrar
    {
        return view ('painel.modulos.usuario.create-edit');
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

        //criptografar senha
        $dataForm['password'] = bcrypt($dataForm['password']);

        //Verificar se existe a imagem
        if ( $request->hasFile('image')){
            //pegar a imagem
            $image = $request->file('image');
            //Definir no nome da imagem
            $nameFile = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();

            $upload = $image->storeAs('users', $nameFile);

            if ( $upload )//se for verdadeiro
                $dataForm['image'] = $nameFile;//guardar o nome verdadeiro
            else
                return redirect()//ira voltar a rota index
                    ->route('usuarios.index')
                    ->withErrors(['errors' => 'Erro no upload da imagem'])
                    ->withInput();
        }
    
        //inserir os dados do banco de vc esta usando issso é magico
        $insert = $this->model->create($dataForm);
        //RETORNADO MENSAGEM PARA VIEW
           if($insert)
               return redirect()
                   ->route('usuarios.index')
                   ->with(['success'=>'Cadastro realizado com sucesso!']);
           else
               return redirect()
                   ->route('usuarios.create')
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
        return view('painel.modulos.usuario.show', compact('data'));
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
 
        return view('painel.modulos.usuario.create-edit', compact('data'));
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
         $this->validate($request, $this->model->rules($id));
         //PEGANDO OS DADOS DO FORMULÁRIO
         $dataForm = $request->all();
         //Criar objeto usuario
         $data = $this->model->find($id);
 
         //CRIPTOGRAFANDO A SENHA
         $dataForm['password'] = bcrypt($dataForm['password']);
 
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
 
             $upload = $image->storeAs('users', $nameImage);
 
             if ( $upload )
                 $dataForm['image'] = $nameImage;
             else
                 return redirect()
                     ->route('usuarios.index')
                     ->withErrors(['errors' => 'Erro no upload da imagem'])
                     ->withInput();
         }
        //Alterar os dados
        $update = $data->update($dataForm);
        if($update)
            return redirect()
                ->route('usuarios.index')
                ->with(['success'=>'Alteração realizada com sucesso!']);
        else
            return redirect()
                ->route('usuarios.update')
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
                ->route("usuarios.index")
                ->with(['success'=>"{$data->name} excluido com sucesso!"]);
        } else {
            return redirect()
                ->route("usuarios.show")
                ->withErrors(['errors'=>'Falha ao excluir!']);
        }
    }

    public function search(Request $request)
    {
        //Recupera os dados do formulário
        $dataForm = $request->get('pesquisa');
        //Filtra os usuários
        $users = $this->model
            ->where('name', 'LIKE', "%{$dataForm}%")
            ->orWhere('email', 'LIKE', "%{$dataForm}%")/*pode ser um ou outro*/
            ->paginate($this->totalpages);
        return view("painel.modulos.usuario.index", compact('users', 'dataForm'));
    }
}
