@extends("app.admin_gudang")
@section("title",$title)
@section("content")
<div class="col-lg-12">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">{{$title}}</h5>
    </div>
    <div class="card-body">
      <div class="form-group">
        <a href="{{route("po.add")}}" class="btn btn-success">Tambah PO</a>
      </div>
      <table class="table dt">
        <thead>
          <th>No</th>
          <th>Kode PO</th>
          <th>Suplier</th>
          <th>Validasi Keuangan</th>
          <th>Validasi Atasan</th>
          <th>Ket</th>
          <th>Tanggal Pengajuan</th>
          <th>Aksi</th>
        </thead>
        <tbody>
          @foreach($po as $key => $value)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$value->no_po}}</td>
            <td>{{$value->suplier->nama_suplier}}</td>
            <td>{{ucfirst(($value->status_keuangan == "confirmed")?"Terkonfirmasi":"Belum Di Konfirmasi")}}</td>
            <td>{{ucfirst($value->validasi)}}</td>
            <td>{{$value->ket}}</td>
            <td>{{$value->tgl_po}}</td>
            <td>
              <a href="{{route("po.detail",$value->no_po)}}" class="btn btn-warning">
                <i class="fa fa-search"></i>
              </a>
              <!-- <a href="{{route("po.hapus",$value->no_po)}}" class="btn btn-danger">
                <i class="fa fa-trash"></i>
              </a> -->
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

</div>

@endsection
