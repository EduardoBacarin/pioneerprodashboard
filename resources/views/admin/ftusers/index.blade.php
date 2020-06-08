@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>
        Fleet Things Users
        <a href="{{route('ftusers.save')}}" class="btn btn-sm btn-success">Update Users</a>
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
                    <th style="position: sticky; top: 0; background-color: #b7d7e8;">Id</th>
                    <th style="position: sticky; top: 0; background-color: #b7d7e8;">Name</th>
                    <th style="position: sticky; top: 0; background-color: #b7d7e8;">Customer E-mail</th>
                    <th style="position: sticky; top: 0; background-color: #b7d7e8;">Address E-mail</th>
                    <th style="position: sticky; top: 0; background-color: #b7d7e8;">Address 1</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td><a href="https://shop.fleetthings.com/Admin/Customer/Edit/{{$user->id}}" target="_blank">{{$user->id}}</a></td>
                    <td>{{$user->firstname}} {{$user->lastname}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->addressemail}}</td>
                    <td>{{$user->address1}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="row">
            {{ $users->links() }}
        </div>
    </div>
</div>

@endsection