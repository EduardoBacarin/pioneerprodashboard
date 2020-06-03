@extends('adminlte::page')

@section('title', 'Inventory')

@section('content_header')
 <body>
  <br />
  
  <div class="container">
    <div class="card mt-4">
        <div class="card-header">
            Laravel 6 Import Excel to database - W3Adda
        </div>
            @if ($errors->any())
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
   @if($message = Session::get('success'))
   <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
   </div>
   @endif
        <div class="card-body">
            <form action="{{route('ftinventory.import')}}" method="POST" name="importform" enctype="multipart/form-data">
                @csrf             
                <input type="file" name="import_file" class="form-control">
                <br>
                <button class="btn btn-success">Import File</button>
            </form>
        </div>
    </div>
    <div class="panel panel-default">
    <div class="panel-heading">
     <h3 class="panel-title">Customer Data</h3>
    </div>
    <div class="panel-body">
     <div class="table-responsive">
      <table class="table table-bordered table-striped">
       <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
               </tr>
       @foreach($data as $d)
       <tr>
        <td>{{ $d->ProductSKU }}</td>
        <td>{{ $d->ProductName }}</td>
        <td>{{ $d->Quantity }}</td>
       </tr>
       @endforeach
      </table>
     </div>
    </div>
</div>

</div>
    
</body>
</html>

@endsection