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
        <form action="{{route("suplier.add_action")}}" method="post">
          @csrf
          <div class="form-group">
            <label>Nama Supplier</label>
            <input type="text" class="form-control" name="nama_suplier" placeholder="">
          </div>
          <div class="form-group">
            <label>No HP</label>
            <input type="text" class="form-control" name="no_hp" placeholder="">
          </div>
          <div class="form-group">
            <label>Alamat Supplier</label>
            <textarea name="alamat" class="form-control" rows="4" cols="80"></textarea>
          </div>

          <div class="form-group">
            <label>Keterangan</label>
            <textarea name="ket" class="form-control" rows="4" cols="80"></textarea>
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
          <th>Nama Supplier</th>
          <th>No HP</th>
          <th>Ket</th>
          <th>Alamat</th>
          <th>Aksi</th>
        </thead>
        <tbody>
          @foreach($suplier as $key => $value)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$value->nama_suplier}}</td>
            <td>{{$value->no_hp}}</td>
            <td>{{$value->ket}}</td>
            <td>{{$value->alamat}}</td>
            <td>
              <a href="{{route("suplier.update",$value->id_suplier)}}" class="btn btn-warning">
                <i class="fa fa-edit"></i>
              </a>
              <a href="{{route("suplier.delete",$value->id_suplier)}}" class="btn btn-danger">
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
