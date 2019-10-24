@extends("app.kepala_gudang")
@section("title",$title)
@section("content")
<div class="col-lg-12">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Data PO</h5>
    </div>
    <div class="card-body">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table dt">
            <thead>
              <th>No</th>
              <th>Kode PO</th>
              <th>Suplier</th>
              <th>Status PO</th>
              <th>Validasi Keuangan</th>
              <th>Validasi Atasan</th>
              <th>Ket</th>
              <th>Tanggal PO</th>
              <th>Aksi</th>
            </thead>
            <tbody>
              @foreach($po as $key => $value)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$value->no_po}}</td>
                <td>{{$value->suplier->nama_suplier}}</td>
                <td>{{ucfirst(($value->status_keuangan == "confirmed")?"Terkonfirmasi":"Belum Di Konfirmasi")}}</td>
                <td>{{ucfirst($value->status)}}</td>
                <td>{{ucfirst($value->validasi)}}</td>
                <td>{{$value->ket}}</td>
                <td>{{$value->tgl_po}}</td>
                <td>
                  <a href="{{route("po_kepala.detail",$value->no_po)}}" class="btn btn-primary">
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
