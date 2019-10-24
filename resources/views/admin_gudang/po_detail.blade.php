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
            <label>Kode PO</label>
            <input type="text" class="form-control" value="{{$po->no_po}}" disabled>
          </div>
          <div class="form-group">
            <label>Status Transaksi</label>
            <input type="text" class="form-control" value="{{ucfirst($po->po->status)}}" disabled>
          </div>
          <div class="form-group">
            <label>Status Verifikasi Keuangan</label>
            <input type="text" class="form-control" value="{{ucfirst(($po->po->status_keuangan == "confirmed")?"Sudah Di Konfirmasi":"Belum di Konfirmasi")}}" disabled>
          </div>
          <div class="form-group">
            <label>Status Verifikasi Atasan</label>
            <input type="text" class="form-control" value="{{ucfirst($po->po->validasi)}}" disabled>
          </div>
          @if($po->po->validasi == "ditolak")
          <div class="form-group">
            <label>Alasan Penolakan</label>
            <textarea disabled class="form-control" rows="8" cols="80">{{$po->po->ket}}</textarea>
          </div>
          @endif
          <div class="form-group">
            <label>Tanggal Purchase Order</label>
            <input type="text" class="form-control" value="{{ucfirst($po->po->tgl_po)}}" disabled>
          </div>
          @if($po->po->validasi == "disetujui" && $po->po->status == "diproses")
          <div class="row">
            <div class="col-md-6">
                <form  action="{{route("po.terima",$po->no_po)}}" method="post">
                @csrf
                <div class="form-group">
                  <label>Barang</label>
                  <select class="form-control select2" name="id_po_detail">
                    @foreach(App\Model\PoDetail::where(["no_po"=>$po->no_po])->get() as $k => $v)
                    <option value="{{$v->id_po_detail}}">[{{$v->kode_barang}}] - {{$v->barang->nama_barang}} ({{$v->total_terima}}/{{$v->total_pesan}})</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Terima</label>
                  <input type="number" class="form-control"  name="total_terima">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-success">
                    Terima Barang
                  </button>
                </div>
              </form>
            </div>
            <div class="col-md-6">
              <form  action="{{route("po.retur",$po->no_po)}}" method="post">
              @csrf
              <div class="form-group">
                <label>Barang</label>
                <select class="form-control select2" name="kode_barang">
                  @foreach(App\Model\PoDetail::where(["no_po"=>$po->no_po])->get() as $k => $v)
                  <option value="{{$v->kode_barang}}">[{{$v->kode_barang}}] - {{$v->barang->nama_barang}} ({{$v->total_terima}}/{{$v->total_pesan}})</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Total Retur</label>
                <input type="number" class="form-control"  name="total_retur">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-danger">
                  Retur Barang
                </button>
              </div>
            </form>
            </div>
          </div>
          @endif
        </div>
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table dt">
              <caption>Barang Diterima</caption>
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
          <hr>
        </div>
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table dt">
              <caption>Detail Barang Diterima</caption>
              <thead>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Diterima</th>
                <th>Tanggal Diterima</th>
              </thead>
              <tbody>
                @foreach($data_diterima as $key => $value)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$value->po_detail->barang->kode_barang}}</td>
                  <td>{{$value->po_detail->barang->nama_barang}}</td>
                  <td>{{$value->total_terima}}</td>
                  <td>{{date("d-m-Y",strtotime($value->tgl_terima))}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <hr>
        </div>
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table dt">
              <caption>Data Retur</caption>
              <thead>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Total Retur</th>
                <th>Tanggal Retur</th>
              </thead>
              <tbody>
                @if(!empty($data_retur))
                @foreach($data_retur->retur_details as $key => $value)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$value->kode_barang}}</td>
                  <td>{{$value->barang->nama_barang}}</td>
                  <td>{{$value->total_retur}}</td>
                  <td>{{date("d-m-Y",strtotime($data_retur->tanggal_retur))}}</td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
          </div>
          <hr>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection
