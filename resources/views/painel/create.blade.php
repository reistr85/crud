@extends('templates.template')

@section('content')

    @if(isset($prod))
        <h3 class="mt-2">Editar o Produto: {{$prod->name}}</h3>
    @else
        <h3 class="mt-2">Novo Produto</h3>
    @endif
    <a href="{{url('products')}}" class="btn btn-danger mt-3"><i class="fas fa-reply-all"></i> voltar</a>

    <hr />

    @if(isset($errors) and count($errors))
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p class="m-0">{{$error}}</p>
            @endforeach
        </div>
    @endif

    @if(isset($prod) and !isset($show))
        <form action="/products/{{$prod->id}}" method="post" class="">
        {!! method_field('PUT') !!}
    @elseif(isset($show))
        <form action="{{route('products.destroy', $prod->id)}}" method="post" class="">
            {!! method_field('DELETE') !!}
    @else
        <form action="{{route('products.store')}}" method="post" class="">
    @endif

        <input type="hidden" name="_token" value="{{csrf_token()}}" />

            <label for="name">Nome do Produto</label>
        @if(isset($prod))
            <input type="text" name="name" class="form-control" id="name" value="{{$prod->name}}" @if(isset($show)) readonly @endif />
        @else
            <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}" @if(isset($show)) readonly @endif />
        @endif

        <label for="description" class="mt-3">Descrição do Produto</label>

        @if(isset($prod))
            <textarea name="description" id="description" cols="30" rows="5" class="form-control" @if(isset($show)) readonly @endif>{{$prod->description}}</textarea>
        @else
            <textarea name="description" id="description" cols="30" rows="5" class="form-control" @if(isset($show)) readonly @endif>{{old('description')}}</textarea>
        @endif

        @if(isset($show))
            <input type="hidden" name="excluir" value="true" />
            <button class="btn btn-danger mt-2"><i class="fas fa-check"></i> Excluir</button>
        @else
            <button class="btn btn-primary mt-2"><i class="fas fa-check"></i> Cadastrar</button>
        @endif
    </form>

@endsection