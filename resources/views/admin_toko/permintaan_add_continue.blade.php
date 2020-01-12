@extends("app.admin_toko")
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
          <form  action="{{route("permintaan_toko.add_continue_action",$data->kode_permintaan)}}" method="post">
            @csrf
            <div class="form-group">
              <label>Kode Permintaan</label>
              <input type="text" class="form-control" name="kode_permintaan" value="{{$data->kode_permintaan}}" readonly>
            </div>
            <div class="form-group">
              <label>Barang</label>
              <select class="form-control select2" name="kode_barang">
                @foreach(App\Model\Barang::all() as $k => $v)
                <option value="{{$v->kode_barang}}">[{{$v->kode_barang}}] - {{$v->nama_barang}} - ({{$v->stok_awal}})</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Jumlah</label>
              <input type="number" class="form-control" name="jumlah">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success">
                Tambah
              </button>
              <a href="{{route("permintaan_toko.add_continue_cancel",$data->kode_permintaan)}}" class="btn btn-danger">
                Batalkan
              </a>
              <a href="{{route("permintaan_toko.index")}}" class="btn btn-primary">
                Simpan
              </a>
            </div>
          </form>
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
                @foreach(\App\Model\PermintaanDetail::where(["kode_permintaan"=>$data->kode_permintaan])->get() as $key => $value)
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
