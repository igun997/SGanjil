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
        <form  action="{{route("retur.add_action")}}" method="post">
          @csrf
          <div class="form-group">
            <label>Kode Refund</label>
            <input type="text" class="form-control" name="no_retur" readonly value="{{$no_retur}}">
          </div>
          <div class="form-group">
            <label>Kode Purchase Order</label>
            <select class="form-control select2" name="no_po">
              @foreach($po as $k => $v)
              <option value="{{$v->no_po}}">{{$v->no_po}}</option>
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
