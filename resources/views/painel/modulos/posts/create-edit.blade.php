@extends('painel.templates.dashboard')
@section('conteudo')

@
<div class="title-pg">
    <h1 class="title-pg">Cadasro de Posts</h1>
</div>

<div class="content-din">

     <!-- Alert Errors start -->
     @if( isset($errors) && count($errors) > 0 )
     <div class="col-md-12">
         <div class="alert alert-warning alert-dismissible">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             <h4><i class="icon fa fa-warning"></i> Atenção!</h4>
             @foreach( $errors->all() as $error)
                 <p>{{$error}}</p>
             @endforeach
         </div>
     </div>
    @endif
 <!-- /.Alert Errors start -->
 <!-- form start -->
    @if(isset($data))
    <form 
    class="form form-search form-ds"  
    method="post" action="{{route('posts.update', $data->id)}}" enctype="multipart/form-data">
        {{ method_field('PUT') }}
    @else
    <form 
    class="form form-search form-ds"  
    method="post" action="{{route('posts.store')}}" enctype="multipart/form-data">
    @endif
        {{ csrf_field() }} 
    
    <div class="form-group col-md-12">
        <label for="InputName">Titulo</label>
        <input type="text" class="form-control" id="InputName" name="title" placeholder="Titulo" value="{{$data->title or old('title')}}">
    </div>
    <!--<div class="form-group col-md-12">
        <label for="InputUser">Usuario</label>
        <input type="text" class="form-control" id="InputUser" name="user_id" placeholder="Usuario" value="$data->user_id or old('user_id')">
    </div>-->
        <div class="form-group col-md-12">
            <label for="user_id">Selecione o Usuario</label>
            <select name="user_id" class="form-control" required="ON" id="user_id">

            <?php if (isset($data)){ ?>
                <option value="{{$data->user_id}}">{{$data->user_id}}</option>
                @foreach ($resultsU as $user_l)
                    <option value="{{$user_l->id}}" > {{$user_l->name}}</option>
                @endforeach

            <?php } else { ?>

                <option>Clique aqui</option>
                @foreach ($resultsU as $user_l)
                    <option value="{{$user_l->id}}" > {{$user_l->name}}</option>
                @endforeach
            <?php } ?>


            </select>


        </div>
    <div class="form-group col-md-12">
            <label for="category_id">Selecione uma Categoria</label>
            <select name="category_id" class="form-control" required="ON" id="category_id">

            <?php if (isset($data)){ ?>
                <option value="{{$data->category_id}}">{{$data->category_id}}</option>
                @foreach ($resultsC as $category_l)
                    <option value="{{$category_l->id}}" > {{$category_l->name}}</option>
                @endforeach

            <?php } else { ?>

                <option>Clique aqui</option>
                @foreach ($resultsC as $category_l)
                    <option value="{{$category_l->id}}" > {{$category_l->name}}</option>
                @endforeach
            <?php } ?>


            </select>


        </div>
    <!-- textarea -->
    <div class="form-group col-md-12">
        <label>Descrição</label>
        <textarea class="form-control" rows="5" name="description" placeholder="Digite aqui ...">{{$data->description or old('description')}}</textarea>
    </div>
    <div class="form-group col-md-12">
        <label for="InputDate">Data</label>
        <input type="text" class="form-control" id="InputDate" name="date" placeholder="Data" value="{{$data->date or old('date')}}">
    </div>
    <div class="form-group col-md-12">
        <label for="InputHour">Hora</label>
        <input type="text" class="form-control" id="InputHour" name="hour" placeholder="Hora" value="{{$data->hour or old('hour')}}">
    </div>
    <div class="form-group col-md-12">
        <label for="InputFeatured">Destaque</label>
        <input type="number" class="form-control" id="InputFeatured" name="featured" placeholder="Destaque" value="{{$data->featured or old('featured')}}">
    </div>
    <div class="form-group col-md-12">
            <label for="status">Selecione um Status</label>
            <select name="status" class="form-control" required="ON" id="status">

            <?php if (isset($data)){ ?>
                <option value="{{$data->status}}">{{$data->status}}</option>
                <option value="A">Ativo postado</option>
                <option value="R">Rascunho não postato</option>
                

            <?php } else { ?>

                <option value="">Clique aqui</option>
                <option value="A">Ativo postado</option>
                <option value="R">Rascunho não postato</option>
                
            <?php } ?>


            </select>


        </div>
        <div class="form-group col-md-6">
            <button class="btn btn-info">Enviar</button>
        </div>
    </form>

</div><!--Content Dinâmico-->
@endsection
