@extends("app.keuangan")
@section("title",$title)
@section("content")
<div class="col-lg-12">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Persetujuan PO</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table dt table-bordered">
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
                <a href="{{route("validasi.po.detail",$value->no_po)}}" class="btn btn-success">
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
<div class="col-lg-12">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Persetujuan Retur</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table dt table-bordered">
          <thead>
            <th>No</th>
            <th>No Retur</th>
            <th>No PO</th>
            <th>Validasi Keuangan</th>
            <th>Status Transaksi</th>
            <th>Tanggal Pengajuan</th>
            <th>Aksi</th>
          </thead>
          <tbody>
            @foreach($retur as $key => $value)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$value->no_retur}}</td>
              <td>{{$value->no_po}}</td>
              <td>{{ucfirst(($value->status_keuangan == "confirmed")?"Terkonfirmasi":"Belum Di Konfirmasi")}}</td>
              <td>{{ucfirst($value->status)}}</td>
              <td>{{$value->tanggal_retur}}</td>
              <td>
                <a href="{{route("validasi.retur.detail",$value->no_retur)}}" class="btn btn-success">
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

@endsection
