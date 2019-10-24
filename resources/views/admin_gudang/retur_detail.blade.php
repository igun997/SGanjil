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
            <label>Kode Refund</label>
            <input type="text" class="form-control" value="{{$retur->no_retur}}" disabled>
          </div>
          <div class="form-group">
            <label>Status Transaksi</label>
            <input type="text" class="form-control" value="{{ucfirst($retur->retur->status)}}" disabled>
          </div>
          <div class="form-group">
            <label>Tanggal Refund</label>
            <input type="text" class="form-control" value="{{ucfirst($retur->retur->tanggal_retur)}}" disabled>
          </div>
          @if($retur->retur->status == "diproses" && $retur->retur->status_keuangan == "confirmed")
          <div class="form-group">
            <a href="{{route("retur.update_action",[$retur->no_retur,"selesai"])}}" class="btn btn-success">
              Selesaikan
            </a>
          </div>
          @endif
        </div>
        <div class="col-md-12">
          <div class="table-resreturnsive">
            <table class="table dt">
              <thead>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Warna</th>
                <th>Kategori</th>
                <th>Harga Satuan</th>
                <th>Total Refund</th>
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
                  <td>{{$value->total_retur}}</td>
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
