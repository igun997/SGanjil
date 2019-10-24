@extends("app.admin_gudang")
@section("title",$title)
@section("content")
<div class="col-lg-8 offset-md-2">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">{{$title}}</h5>
    </div>
    <div class="card-body">
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
      <div class="col-md-12">
        <form  action="{{route("laporan_gudang.index.aksi")}}" method="post">
          @csrf
          <div class="form-group">
            <label>Mulai</label>
            <input type="date" class="form-control" name="mulai">
          </div>
          <div class="form-group">
            <label>Sampai</label>
            <input type="date" class="form-control" name="sampai">
          </div>
          <div class="form-group">
            <label>Laporan</label>
            <select class="form-control" name="kategori">
              <option value="barangmasuk">Barang Masuk</option>
              <option value="returbarang">Retur Barang</option>
              <option value="permintaanbarang">Permintaan Barang</option>
              <!-- <option value="rekap">Rekapitulasi Barang</option> -->
            </select>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success">
              Download Laporan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>

@endsection
