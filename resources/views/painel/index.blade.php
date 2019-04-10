@extends('templates.template')

@section('content')

    <h3 class="mt-2">Listagem dos Produtos</h3>
    <a href="{{route('products.create')}}" class="btn btn-primary mt-3"><i class="fas fa-plus"></i> Novo Produto</a>
    <table class="table table-striped mt-2">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col w-100">Nome</th>
            <th scope="col w-100">Descrição</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>

        <tbody>

        @foreach($prod as $product)
            <tr>
                <th scope="row">
                    {{$i++}}
                </th>

                <td>
                    {{$product->name}}
                </td>

                <td>
                    {{$product->description}}
                </td>

                <td>
                    <a href="products/{{$product->id}}/edit" class="btn btn-warning"><i class="fas fa-edit"></i>Editar</a>
                    <a href="{{route('products.show', $product->id)}}" class="btn btn-danger"><i class="fas fa-trash-alt "></i> Excluir</a>
                </td>
            </tr>
        @endforeach

        @if(count($prod)==0)
            <tr>
                <td colspan="4"><h3 class="text-danger">Não há produtos cadastrados</h3></td>
            </tr>
        @endif
        </tbody>
    </table>

@endsection