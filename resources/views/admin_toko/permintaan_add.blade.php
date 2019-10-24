@extends("app.admin_toko")
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
        <form  action="{{route("permintaan_toko.add_action")}}" method="post">
          @csrf
          <div class="form-group">
            <label>Kode Permintaan</label>
            <input type="text" class="form-control" name="kode_permintaan" readonly value="{{$kode_permintaan}}">
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
