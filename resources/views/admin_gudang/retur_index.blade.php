@extends("app.admin_gudang")
@section("title",$title)
@section("content")
<div class="col-lg-12">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">{{$title}}</h5>
    </div>
    <div class="card-body">
      <table class="table dt">
        <thead>
          <th>No</th>
          <th>No Refund</th>
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
              <a href="{{route("retur.detail",$value->no_retur)}}" class="btn btn-success">
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

@endsection
