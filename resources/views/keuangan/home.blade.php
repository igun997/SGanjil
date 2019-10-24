@extends("app.keuangan")
@section("title",$title)
@section("content")
<div class="col-lg-12">
  <div class="col-lg-12">
    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-redo"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PO Tidak Sah</span>
              <span class="info-box-number">
                {{\App\Model\Po::where(["validasi"=>"ditolak"])->where(["validasi"=>"menunggu"])->count()}}
              </span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-redo"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">PO Sah</span>
              <span class="info-box-number">
                {{\App\Model\Po::where(["status_keuangan"=>"confirmed","validasi"=>"disetujui"])->count()}}
              </span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-undo"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Retur Tidak Sah</span>
              <span class="info-box-number">
                    {{\App\Model\Retur::where(["status_keuangan"=>"unconfirm"])->count()}}
              </span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-undo"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Retur Sah</span>
              <span class="info-box-number">
                {{\App\Model\Retur::where(["status_keuangan"=>"confirmed"])->count()}}
              </span>
            </div>
          </div>
        </div>
      </div>
  </div>

</div>

@endsection
