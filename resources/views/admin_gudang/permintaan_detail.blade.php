  @extends("app.admin_gudang")
@section("title",$title)
@section("content")
<div class="col-lg-8 offset-lg-2">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">{{$title}}</h5>
    </div>
    <div class="card-body">
      <div class="row">
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
          <div class="form-group">
            <label>Kode Pengajuan</label>
            <input type="text" class="form-control" value="{{$permintaan->kode_permintaan}}" disabled>
          </div>
          <div class="form-group">
            <label>Status Verifikasi</label>
            <input type="text" class="form-control" value="{{ucfirst($permintaan->permintan->verifikasi)}}" disabled>
          </div>
          <div class="form-group">
            <label>Tanggal Pengajuan</label>
            <input type="text" class="form-control" value="{{ucfirst($permintaan->permintan->tgl)}}" disabled>
          </div>

          @if($permintaan->permintan->verifikasi == "menunggu")
          <form action="{{route("permintaan.update_action",[$permintaan->kode_permintaan,"ditolak"])}}" method="get">
          <div class="form-group">
            <a href="{{route("permintaan.update_action",[$permintaan->kode_permintaan,"disetujui"])}}" class="btn btn-success">
              <i class="fa fa-check"> Setujui</i>
            </a>
          </div>
          </form>

          @endif
        </div>
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table dt">
              <thead>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Part</th>
                <th>Kategori</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
              </thead>
              <tbody>
                @foreach($data as $key => $value)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$value->barang->kode_barang}}</td>
                  <td>{{$value->barang->nama_barang}}</td>
                  <td>{{$value->barang->warna_content->warna}}</td>
                  <td>{{$value->barang->kategori_content->kategori}}</td>
                  <td>{{$value->barang->harga_satuan}}</td>
                  <td>{{$value->jumlah}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection
