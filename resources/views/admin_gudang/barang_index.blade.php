@extends("app.admin_gudang")
@section("title",$title)
@section("content")
<div class="col-lg-4">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Tambah Barang</h5>
    </div>
    <div class="card-body">
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
        <form action="{{route("barang.add_action")}}" method="post">
          @csrf
          <div class="form-group">
            <label>Kode Barang</label>
            <input type="text" class="form-control" name="kode_barang" placeholder="">
          </div>
          <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" class="form-control" name="nama_barang" placeholder="">
          </div>
          <div class="form-group">
            <label>Part</label>
            <select class="form-control" name="warna">
              @foreach(App\Model\Warna::all() as $k => $v)
              <option value="{{$v->id_warna}}">{{$v->warna}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Kategori Barang</label>
            <select class="form-control" name="kategori">
              @foreach(App\Model\Kategori::all() as $k => $v)
              <option value="{{$v->id_kategori}}">{{$v->kategori}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Stok Awal</label>
            <input type="number" class="form-control" name="stok_awal" min="0" placeholder="">
          </div>
          <div class="form-group">
            <label>Stok Minimum</label>
            <input type="number" class="form-control" name="stok_minimum" min="0" placeholder="">
          </div>
          <div class="form-group">
            <label>Harga Satuan</label>
            <input type="number" class="form-control" name="harga_satuan" min="0" placeholder="">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success">
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-8">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">{{$title}}</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table dt">
        <thead>
          <th>No</th>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th>Warna</th>
          <th>Kategori</th>
          <th>Harga Satuan</th>
          <th>Stok Awal</th>
          <th>Stok Minimum</th>
        </thead>
        <tbody>
          @foreach($barang as $key => $value)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$value->kode_barang}}</td>
            <td>{{$value->nama_barang}}</td>
            <td>{{$value->warna_content->warna}}</td>
            <td>{{$value->kategori_content->kategori}}</td>
            <td>{{$value->harga_satuan}}</td>
            <td>{{$value->stok_awal}}</td>
            <td>{{$value->stok_minimum}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      </div>
    </div>
  </div>

</div>

@endsection
