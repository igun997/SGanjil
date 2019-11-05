@extends("app.kepala_gudang")
@section("title",$title)
@section("content")
<div class="col-lg-6 offset-lg-3">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Update Barang</h5>
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
        <form action="{{route("kepala.barang.update_action",$data->kode_barang)}}" method="post">
          @csrf
          <div class="form-group">
            <label>Kode Barang</label>
            <input type="text" class="form-control" disabled value="{{$data->kode_barang}}">
          </div>
          <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" class="form-control" name="nama_barang" value="{{$data->nama_barang}}">
          </div>
          <div class="form-group">
            <label>Warna Barang</label>
            <select class="form-control" name="warna">
              @foreach(App\Model\Warna::all() as $k => $v)
              @if($v->id_warna == $data->warna)
              <option value="{{$v->id_warna}}" selected>{{$v->warna}}</option>
              @else
              <option value="{{$v->id_warna}}">{{$v->warna}}</option>
              @endif
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Kategori Barang</label>
            <select class="form-control" name="kategori">
              @foreach(App\Model\Kategori::all() as $k => $v)
              @if($v->id_kategori == $data->kategori)
              <option value="{{$v->id_kategori}}" selected>{{$v->kategori}}</option>
              @else
              <option value="{{$v->id_kategori}}">{{$v->kategori}}</option>
              @endif
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label>Stok Awal</label>
            <input type="number" class="form-control" name="stok_awal" value="{{$data->stok_awal}}">
          </div>
          <div class="form-group">
            <label>Stok Minimum</label>
            <input type="number" class="form-control" name="stok_minimum" min="0" value="{{$data->stok_minimum}}" placeholder="">
          </div>
          <div class="form-group">
            <label>Harga Satuan</label>
            <input type="number" class="form-control" name="harga_satuan" value="{{$data->harga_satuan}}">
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
@endsection
