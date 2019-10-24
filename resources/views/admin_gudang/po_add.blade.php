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
        <form  action="{{route("po.add_action")}}" method="post">
          @csrf
          <div class="form-group">
            <label>Kode PO</label>
            <input type="text" class="form-control" name="no_po" readonly value="{{$no_po}}">
          </div>
          <div class="form-group">
            <label>Supplier</label>
            <select class="form-control" name="id_suplier">
              @foreach(\App\Model\Suplier::all() as $k => $v)
              <option value="{{$v->id_suplier}}">{{$v->nama_suplier}} - ({{$v->ket}})</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success">
              Lanjutkan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>

@endsection
