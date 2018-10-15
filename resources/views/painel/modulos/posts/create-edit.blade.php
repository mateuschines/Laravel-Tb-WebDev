@extends('painel.templates.dashboard')
@section('conteudo')
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
    <div class="form-group col-md-12">
        <label for="InputUser">Usuario</label>
        <input type="text" class="form-control" id="InputUser" name="user_id" placeholder="Usuario" value="{{$data->user_id or old('user_id')}}">
    </div>
    <div class="form-group col-md-12">
        <label for="InputCategoty">Categoria</label>
        <input type="text" class="form-control" id="InputCategoty" name="category_id" placeholder="Categoria" value="{{$data->category_id or old('category_id')}}">
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
        <input type="text" class="form-control" id="InputFeatured" name="featured" placeholder="Destaque" value="{{$data->featured or old('featured')}}">
    </div>
    <div class="form-group col-md-12">
        <label for="InputStatus">Status</label>
        <input type="text" class="form-control" id="InputStatus" name="status" placeholder="Status" value="{{$data->status or old('status')}}">
    </div>
        <div class="form-group col-md-6">
            <button class="btn btn-info">Enviar</button>
        </div>
    </form>

</div><!--Content Dinâmico-->
@endsection