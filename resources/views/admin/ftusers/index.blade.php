@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>
        Fleet Things Users
    <a href="" class="btn btn-sm btn-success">Novo Usuário</a>
    </h1>

    <form  style="float:right; margin-top: -30px;" class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                <tr>
                    <td>23333</td>
                    <td>Fernando Motta</td>
                    <td>fvvmotta@gmail.com</td>
                    <td>
                    <a href="" class="btn btn-sm btn-info">Edit</a>

                    <a href="" class="btn btn-sm btn-warning">More Info</a>

                        <form class="d-inline" method="POST" action="" onsubmit="return confirm('Tem Certeza que Deseja Excluir?')">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>

                    </td>
                </tr>

            </tbody>
        </table>
    </div>
</div>


@endsection