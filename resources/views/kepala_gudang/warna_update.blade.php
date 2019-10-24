@extends("app.admin_gudang")
@section("title",$title)
@section("content")
<div class="col-lg-6 offset-lg-3">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Update Warna</h5>
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
        <form action="{{route("kepala.warna.update_action",$data->id_warna)}}" method="post">
          @csrf

          <div class="form-group">
            <label>Nama Warna</label>
            <input type="text" class="form-control" name="warna" value="{{$data->warna}}">
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
