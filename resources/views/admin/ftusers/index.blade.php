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
                    <th>User Orders</th>
                </tr>
            </thead>
            <tbody>

            @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->firstname}} {{$user->lastname}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->userorders}}</td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection