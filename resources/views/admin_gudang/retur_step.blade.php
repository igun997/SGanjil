@extends("app.admin_gudang")
@section("title",$title)
@section("content")
<div class="col-lg-8 offset-md-2">
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
          <form  action="{{route("retur.step_action",$no_retur)}}" method="post">
            @csrf
            <div class="form-group">
              <label>Kode Refund</label>
              <input type="text" class="form-control" name="no_retur" value="{{$no_retur}}" readonly>
            </div>
            <div class="form-group">
              <label>Barang</label>
              <select class="form-control select2" name="kode_barang">
                @foreach($poItem as $k => $v)
                <option value="{{$v->barang->kode_barang}}">[{{$v->barang->kode_barang}}] - {{$v->barang->nama_barang}} ({{$v->total_terima}}/{{$v->total_pesan}})</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Jumlah</label>
              <input type="number" class="form-control" name="total_retur">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success">
                Tambah
              </button>
              <a href="{{route("retur.step_cancel",$no_retur)}}" class="btn btn-danger">
                Batalkan 
              </a>
              <a href="{{route("retur.index")}}" class="btn btn-primary">
                Simpan
              </a>
            </div>
          </form>
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
                <th>Jumlah</th>
              </thead>
              <tbody>
                @foreach(\App\Model\ReturDetail::where(["no_retur"=>$no_retur])->get() as $key => $value)
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
