@extends('adminlte::page')

@section('title', 'Paginas')

@section('content_header')
    <h1>
        Minhas Paginas
    <a href="{{ route('pages.create')}} " class="btn btn-sm btn-success">Nova Pagina</a>
    </h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="50">Id</th>
                    <th>Título</th>
                    <th width="200">Ações</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($pages as $page)
                <tr>
                    <td>{{$page->id}}</td>
                    <td>{{$page->title}}</td>
                    <td>

                        <a href="" target="_blank" class="btn btn-sm btn-success">Ver</a>

                    <a href="{{ route('pages.edit', ['page' =>$page->id]) }}" class="btn btn-sm btn-info">Editar</a>
 
                        <form class="d-inline" method="POST" action="{{ route('pages.destroy', ['page' =>$page->id]) }}" onsubmit="return confirm('Tem Certeza que Deseja Excluir?')">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-sm btn-danger">Excluir</button>
                        </form>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
{{ $pages->links() }}

@endsection