@extends("app.admin_toko")
@section("title",$title)
@section("content")

<div class="col-lg-12">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Data Permintaan Barang</h5>
    </div>
    <div class="card-body">
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
      <div class="col-md-12">
        <div class="form-group">
          <a href="{{route("permintaan_toko.add")}}" class="btn btn-success">Tambah Permintaan</a>
        </div>
        <div class="table-responsive">
          <table class="table dt">
            <thead>
              <th>No</th>
              <th>Kode Permintaan</th>
              <th>Status Verifikasi</th>
              <th>Tanggal Pengajuan</th>
              <th>Aksi</th>
            </thead>
            <tbody>
              @foreach(App\Model\Permintaan::orderBy("tgl","desc")->get() as $key => $value)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$value->kode_permintaan}}</td>
                <td>{{ucfirst($value->verifikasi)}}</td>
                <td>{{$value->tgl}}</td>
                <td>
                  <a href="{{route("permintaan_toko.detail",$value->kode_permintaan)}}" class="btn btn-primary">
                    <i class="fa fa-search"></i>
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
