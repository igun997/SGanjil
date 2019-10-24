@extends("app.kepala_gudang")
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
            <label>Kode PO</label>
            <input type="text" class="form-control" value="{{$po->no_po}}" disabled>
          </div>
          <div class="form-group">
            <label>Status Transaksi</label>
            <br>
            {!! ($po->po->status == "diproses")?"<span class='badge badge-primary'>Diproses</span>":"<span class='badge badge-success'>Selesai</span>" !!}
          </div>
          <div class="form-group">
            <label>Status Verifikasi</label>
            <br>
            {!! ($po->po->validasi == "menunggu")?"<span class='badge badge-primary'>Menunggu</span>":(($po->po->validasi == "ditolak")?"<span class='badge badge-danger'>Ditolak</span>":"<span class='badge badge-success'>Disetujui</span>") !!}
          </div>
          <div class="form-group">
            <label>Tanggal PO</label>
            <input type="text" class="form-control" value="{{ucfirst($po->po->tgl_po)}}" disabled>
          </div>
          @if($po->po->validasi == "menunggu")
          <form action="{{route("po_kepala.update",[$po->no_po,"ditolak"])}}" method="get">
            <div class="form-group">
              <label>Alasan Penolakan</label>
              <textarea name="ket" rows="8" cols="80" class="form-control"></textarea>
            </div>
            <div class="form-group">
              <a href="{{route("po_kepala.update",[$po->no_po,"disetujui"])}}" class="btn btn-success">
                Setujui
              </a>
              <button type="submit" class="btn btn-danger">
                Tolak
              </button>
            </div>
          </form>
          @endif
          <div class="form-group">
            <label>Daftar Barang Dengan Perubahan Harga</label>
            <ol>
            @foreach($data as $k => $v)
            @if($v->bukti != null && $v->persetujuan_harga == 0)
              <li>
                [{{$v->barang->kode_barang}}] {{$v->barang->nama_barang}} ({{$v->barang->harga_satuan}} --> {{$v->harga}})  -
                <span class="badge badge-primary ml-2">Menunggu Verifikasi Keuangan</span>
                <a href="{{url("upload/".$v->bukti)}}" class="btn btn-sm btn-primary ml-2">Download Bukti</a>
              </li>
              @elseif($v->bukti != null && $v->persetujuan_harga == 1)
              <li>
                [{{$v->barang->kode_barang}}] {{$v->barang->nama_barang}} ({{\App\Model\HistoryHarga::where(["bukti"=>$v->bukti])->first()->harga}} --> {{$v->harga}})  -
                <span class="badge badge-success ml-2">Disetujui</span>
                <a href="{{url("upload/".$v->bukti)}}" class="btn btn-sm btn-primary ml-2">Download Bukti</a>
              </li>
              @elseif($v->bukti != null && $v->persetujuan_harga == 2)
              <li>
                [{{$v->barang->kode_barang}}] {{$v->barang->nama_barang}} ({{$v->barang->harga_satuan}} --> {{$v->harga}})  -
                <span class="badge badge-danger ml-2">Ditolak</span>
                <a href="{{url("upload/".$v->bukti)}}" class="btn btn-sm btn-primary ml-2">Download Bukti</a>
              </li>
              @endif
            @endforeach
            </ol>
          </div>
        </div>
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table dt">
              <thead>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Warna</th>
                <th>Kategori</th>
                <th>Harga Satuan</th>
                <th>Total Pesan</th>
                <th>Total Terima</th>
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
                  <td>{{$value->total_pesan}}</td>
                  <td>{{$value->total_terima}}</td>
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
