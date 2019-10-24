@extends("app.admin_gudang")
@section("title",$title)
@section("content")
<div class="col-lg-4">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Tambah Kategori</h5>
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
        <form action="{{route("kategori.add_action")}}" method="post">
          @csrf
          <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" class="form-control" name="kategori" placeholder="">
          </div>
          <div class="form-group">
            <label>Keterangan Kategori</label>
            <textarea name="ket" class="form-control" rows="8" cols="80"></textarea>
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
          <th>Nama Kategori</th>
          <th>Keterangan Kategori</th>
          <th>Aksi</th>
        </thead>
        <tbody>
          @foreach($kategori as $key => $value)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$value->kategori}}</td>
            <td>{{$value->ket}}</td>
            <td>
              <a href="{{route("kategori.update",$value->id_kategori)}}" class="btn btn-warning">
                <i class="fa fa-edit"></i>
              </a>
              <a href="{{route("kategori.delete",$value->id_kategori)}}" class="btn btn-danger">
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
