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
          <th>Kode Permintan</th>
          <!--<th>Validasi keuangan</th> -->
          <th>Status Transaksi</th>
          <th>Tanggal Pengajuan</th>
          <th>Aksi</th>
        </thead>
        <tbody>
          @foreach($permintaan as $key => $value)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$value->kode_permintaan}}</td>
           <!-- <td>{{ucfirst(($value->status_keuangan == "confirmed")?"Di Konfirmasi":"Belum Di Konfirmasi")}}</td> -->
            <td>{{ucfirst($value->verifikasi)}}</td>
            <td>{{$value->tgl}}</td>
            <td>
              <a href="{{route("permintaan.detail",$value->kode_permintaan)}}" class="btn btn-warning">
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
