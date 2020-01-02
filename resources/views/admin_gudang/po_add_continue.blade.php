@extends("app.admin_gudang")
@section("title",$title)
@section("content")
<div class="col-lg-12">
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
          <form  action="{{route("po.add_continue_action",$data->no_po)}}" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group">
              <label>No PO</label>
              <input type="text" class="form-control" name="no_po" value="{{$data->no_po}}" readonly>
            </div>
            <div class="form-group">
              <label>Supplier</label>
              <input type="text" class="form-control" value="{{$data->suplier->nama_suplier}}" disabled>
            </div>
            <div class="form-group">
              <label>
                Barang

              </label>
              <select class="form-control select2" id="opsi" name="kode_barang">
                @foreach(App\Model\Barang::whereRaw("stok_minimum >= stok_awal")->get() as $k => $v)
                <option value="{{$v->kode_barang}}" data-harga="{{$v->harga_satuan}}">[{{$v->kode_barang}}] - {{$v->nama_barang}} {{$v->warna_content->warna}} ({{$v->stok_awal}})</option>
                @endforeach
              </select>
              <div id="btnGroup">
                <button type="button" class="btn btn-sm btn-primary mt-2" id="perbaruan">
                  Ajukan Pembaruan Harga
                </button>
              </div>
            </div>
            <div id="kontennya">

            </div>
            <div class="form-group">
              <label>Jumlah</label>
              <input type="number" class="form-control" name="total_pesan">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success">
                Tambah
              </button>
              <a href="{{route("po.add_continue_cancel",$data->no_po)}}" class="btn btn-danger">
                Batalkan
              </a>
              <a href="{{route("po.index")}}" class="btn btn-primary">
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
                <th>Warna</th>
                <th>Kategori</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Perubahan Harga</th>
                <th>Bukti Perubahan Harga</th>
              </thead>
              <tbody>
                @foreach(\App\Model\PoDetail::where(["no_po"=>$data->no_po])->get() as $key => $value)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$value->barang->kode_barang}}</td>
                  <td>{{$value->barang->nama_barang}}</td>
                  <td>{{$value->barang->warna_content->warna}}</td>
                  <td>{{$value->barang->kategori_content->kategori}}</td>
                  <td>{{$value->barang->harga_satuan}}</td>
                  <td>{{$value->total_pesan}}</td>
                  <td>{{$value->harga}}</td>
                  <td>
                    @if($value->bukti != null)
                    <a href="{{url("upload/".$value->bukti)}}" target="_blank" class="btn btn-success">Download Bukti</a>
                    @endif
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

</div>

@endsection
@section("js")
<script type="text/javascript">
  $(document).ready(function() {
    log = null;
    $("#perbaruan").on('click', function(event) {
      event.preventDefault();
      cek = $("#btnGroup #batalkan");
      if (cek.length == 0) {
        $("#perbaruan").after('<button class="btn btn-sm btn-danger ml-2 mt-2" id="batalkan" type="button">Batalkan Pembaruan</button>');
        s = $("#opsi").find(":selected").data("harga");
        console.log(s);
        $("#kontennya").html('<div class="form-group"><label>Harga Baru</label><input required  type="number" class="form-control" name="harga"></div><div class="form-group"><label>Bukti Perubahan Harga</label><input type="file"  class="form-control-file" name="bukti" accept=".pdf,.jpg,.jpeg"></div>');
      }
    });
    $("#btnGroup").on('click', '#batalkan', function(event) {
      event.preventDefault();
      console.log("Cuss");
      $("#kontennya").html("");
      $(this).remove();
    });
  });
</script>
@endsection
