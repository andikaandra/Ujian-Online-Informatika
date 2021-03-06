@extends('tcexam.layouts.dosen')

@section('path', 'Add Test')

@section('style')

@endsection
@section('content')
    <div class="card card-content">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-5">
            <h4 class="card-title mb-0">Data filling</h4>
            <div class="small text-muted">SMART Exam</div>
          </div>
          <div class="col-sm-7 d-none d-md-block">

          </div>
        </div>
        <hr>
        @if (\Session::has('success'))
            <div class="alert alert-success">
              {!! \Session::get('success') !!}
            </div>
        @endif
        @if (\Session::has('error'))
            <div class="alert alert-danger">
              {!! \Session::get('error') !!}
            </div>
        @endif
        <div class="alert alert-primary">
          You can create new exam here, after that add your participant on your exam list
        </div>
        <div class="chart-wrapper mt-3" style="min-height:300px;">
          <form method="post" id="" action="{{route('tambah.ujian')}}">
            @csrf
            <div class="form-group">
              <label for="nama">Nama Ujian</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama ujian" required>
            </div>
            <div class="form-group">
              <label for="nama">Jumlah soal</label>
              <input type="text" onkeypress='validate(event)' class="form-control" name="jumlah_soal" id="jumlah_soal" placeholder="Jumlah soal" required>
            </div>
            <div class="form-row">
              <div class="form-group col">
                <label for="">Skor jawaban benar</label>
                <input type="text" min="1" class="form-control" id="nilai_benar" name="nilai_benar" placeholder="Skor jika jawaban benar. contoh: 2" required>
              </div>
              <div class="form-group col">
                <label for="">Skor jawaban salah</label>
                <input type="number" class="form-control" min="-100" max="0" id="nilai_salah" name="nilai_salah" placeholder="Skor jika jawaban salah. contoh: 0 atau -1" required>
              </div>
            </div>
            <div class="form-gorup">
              <label for="">Nilai lulus ujian</label>
              <input type="number" min="0" max="100" class="form-control" id="pass_test" name="pass_test" placeholder="Nilai untuk lulus ujian" required>
            </div>
            <hr>
            <div class="form-row">
              <div class="form-group col">
                <label for="">Tanggal mulai</label>
                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" placeholder="Tanggal ujian dimulai" required>
              </div>
              <div class="form-group col">
                <label for="">Waktu mulai</label>
                <input type="time" name="waktu_mulai" class="form-control" id="waktu_mulai" placeholder="Waktu ujian dimulai" required>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col">
                <label for="">Tanggal akhir</label>
                <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" placeholder="Tanggal ujian dimulai" required>
              </div>
              <div class="form-group col">
                <label for="">Waktu akhir</label>
                <input type="time" name="waktu_akhir" class="form-control" id="waktu_akhir"  placeholder="Waktu ujian dimulai" required>
              </div>
            </div>
            <hr>
            <div class="form-row">
              <div class="form-group col">
                <label for="">Laporan jawaban ke mahasiswa</label>
                <select class="custom-select" name="report" required>
                  <option value="tidak" selected>Tidak</option>
                  <option value="ya" >Ya</option>
                </select>
              </div>
              <div class="form-group col">
                <label for="">Laporan nilai ke mahasiswa</label>
                <select class="custom-select" name="result" required>
                  <option value="ya" selected>Ya</option>
                  <option value="tidak">Tidak</option>
                </select>
              </div>
            </div>
            <button class="btn btn-sm btn-info text-white" type="submit">
              <i class="far fa-paper-plane"></i>&nbsp; Submit
            </button>
          </form>
        </div>
      </div>
      <div class="card-footer">

      </div>
    </div>
@endsection

@section('script')
<script>
  $('#body-section').removeClass('aside-menu-lg-show');
  $(document).ready(function(){
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1;
        var yyyy = today.getFullYear();
          if(dd<10){
            dd='0'+dd
          }
          if(mm<10){
            mm='0'+mm
          }

        today = yyyy+'-'+mm+'-'+dd;
        document.getElementById("tanggal_mulai").setAttribute("min", today);
        document.getElementById("tanggal_akhir").setAttribute("min", today);

  });

  function validate(evt) {
    var theEvent = evt || window.event;

    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
      theEvent.returnValue = false;
      if(theEvent.preventDefault) theEvent.preventDefault();
    }
  }
</script>
@endsection