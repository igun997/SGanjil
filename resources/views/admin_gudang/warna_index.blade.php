@extends("app.admin_gudang")
@section("title",$title)
@section("content")
<div class="col-lg-4">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Tambah Suplier</h5>
    </div>
    <div class="card-body">
      <div class="col-md-12">
        @if(session()->has("msg"))
        <div class="alert alert-success">{{session()->get("msg")}}</div>
        @endif
        @if ($errors->any())
          <div class="alert alert-danger">
              @foreach ($errors->all() as $error)
                  <p>{{ $error }}</p>
              @endforeach
          </div>
         @endif
        <form action="{{route("warna.add_action")}}" method="post">
          @csrf
          <div class="form-group">
            <label>Nama Warna</label>
            <input type="text" class="form-control" name="warna" placeholder="">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success">
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-8">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">{{$title}}</h5>
    </div>
    <div class="card-body">
      <table class="table dt">
        <thead>
          <th>No</th>
          <th>Nama Warna</th>
          <th>Aksi</th>
        </thead>
        <tbody>
          @foreach($warna as $key => $value)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$value->warna}}</td>
            <td>
              <a href="{{route("warna.update",$value->id_warna)}}" class="btn btn-warning">
                <i class="fa fa-edit"></i>
              </a>
              <a href="{{route("warna.delete",$value->id_warna)}}" class="btn btn-danger">
                <i class="fa fa-trash"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</div>

@endsection
