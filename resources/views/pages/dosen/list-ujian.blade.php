@extends('layouts.dosen')

@section('path', 'Test list')

@section('style')

@endsection
@section('content')
    <div class="card card-content">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-5">
            <h4 class="card-title mb-0">Your Test list</h4>
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
{{--         <div class="alert alert-primary">          
        </div> --}}
        <div class="chart-wrapper mt-3" style="min-height:300px;">
          <table class="table table-striped table-hover">
            <thead>
              <th>ID</th>
              <th>Nama</th>
              <th>Participant</th>
              <th>Question's</th>
              <th>Status</th>
              <th>Action</th>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">

      </div>
    </div>
    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Detail Ujian</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <form method="post" id="updateUjian" action="{{route('update.ujian')}}">
                  @csrf
                  <div class="form-group">
                    <label for="nama">Nama Ujian</label>
                    <input type="text" maxlength="100" class="form-control" name="nama" id="nama" placeholder="Nama Ujian" required>
                  </div>
                  <div class="form-group">
                    <label for="nama">Jumlah soal</label>
                    <input type="text" onkeypress='validate(event)' onkeyup='getVal()' class="form-control" name="jumlah_soal" id="jumlah_soal" placeholder="Jumlah soal" required>
                  </div>
                  <div class="form-row">
                    <div class="form-group col">
                      <label for="">Skor jawaban benar</label>
                      <input type="text" min="1" class="form-control" id="nilai_benar" name="nilai_benar" placeholder="Skor jika jawaban benar. contoh: 2" required readonly disabled>
                    </div>
                    <div class="form-group col">
                      <label for="">Skor jawaban salah</label>
                      <input type="number" class="form-control" id="nilai_salah" name="nilai_salah" placeholder="Skor jika jawaban salah. contoh: 0 atau -1" required>
                    </div>
                  </div>
                  <div class="form-gorup">
                    <label for="">Nilai lulus ujian</label>
                    <input type="number" min="0" max="100" class="form-control" id="pass_test" name="pass_test" placeholder="Nilai untuk lulus ujian" required>
                  </div>
                  <div class="form-row">
                    <div class="form-group col">
                      <label for="">Tanggal mulai</label>
                      <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" placeholder="Tanggal ujian dimulai" required>
                    </div>
                    <div class="form-group col">
                      <label for="">Waktu mulai</label>
                      <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai" placeholder="Waktu ujian dimulai" required>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col">
                      <label for="">Tanggal akhir</label>
                      <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" placeholder="Tanggal ujian dimulai" required>
                    </div>
                    <div class="form-group col">
                      <label for="">Waktu akhir</label>
                      <input type="time" class="form-control" id="waktu_akhir" name="waktu_akhir" placeholder="Waktu ujian dimulai" required>
                    </div>
                  </div>
                  <hr>
                  <div class="form-row">
                    <div class="form-group col">
                      <label for="">Laporan jawaban ke mahasiswa</label>
                      <select class="custom-select" name="report" required id="report">
                        <option value="tidak">Tidak</option>
                        <option value="ya" >Ya</option>
                      </select>
                    </div>
                    <div class="form-group col">
                      <label for="">Laporan nilai ke mahasiswa</label>
                      <select class="custom-select" name="result" required id="result">
                        <option value="ya">Ya</option>
                        <option value="tidak">Tidak</option>
                      </select>
                    </div>
                  </div>
                  <input type="hidden" name="id_ujian" id="id_ujian">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
                </form>
        </div>
      </div>
    </div>
@endsection

@section('script')
<script>
  $('#body-section').removeClass('aside-menu-lg-show');

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

  function getVal(){
    $('#nilai_benar').val(100/$('#jumlah_soal').val());
  }

  $(document).ready( function () {
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
      // document.getElementById("tanggal_mulai").setAttribute("min", today);
      document.getElementById("tanggal_akhir").setAttribute("min", today);


      let dataTable = $(".table").DataTable({
        responsive: true,
        ajax: '{{url('tcexam/dosen/list/ujian/data')}}',
        columns: [
          {data: "id"},
          {data: "nama"},
          {data: null, className: "text-center",
            render: function(data, type, row) {
                return "<a href='ujian/peserta/"+row.id+"' role='button' class='btn btn-info text-white btn-sm participant' data-id='"+row.id+"'>Participant</a>";
            }
          },
          {data: null, className: "text-center",
            render: function(data, type, row) {
                return "<a href='ujian/soal/"+row.id+"' role='button' class='btn btn-info text-white btn-sm question' data-id='"+row.id+"'>Question</a>";
            }
          },
          {data: null, className: "text-center",
            render: function(data, type, row) {
                let start = new Date((row.date_start).slice(0, 10)+ ' ' + (row.time_start));
                let end = new Date((row.date_end).slice(0, 10)+ ' ' + (row.time_end));
                let now = new Date();
                if (now > end) {
                  return "Berakhir";
                }
                else if(now < start ){
                  return "Belum dimulai";
                }
                else{
                  return "Sedang berlangsung";
                }
                // start    end
            }
          },
          {data: null, className: "text-center",
            render: function(data, type, row) {
                return "<button class='btn btn-success btn-sm info' data-id='"+row.id+"'>Info</button>";
            }
          }
        ]
      });

      $(document).on('click', '.info', async function(){
        var id = $(this).attr('data-id');
        // console.log(id);
        let data;

        try {
            data = await $.ajax({
              url: '{{url('tcexam/dosen/list/ujian/data')}}/' + id
            });
            console.log(id);
        } catch (e) {
          alert("Ajax error");
          console.log(e);
          return;
        }
        // console.log((data.ujian.date_start))
        $('#id_ujian').val(data.ujian.id)
        $('#nama').val(data.ujian.nama)
        $('#nilai_salah').val(data.ujian.false_answer)
        $('#jumlah_soal').val(data.ujian.jumlah_soal)
        $('#pass_test').val(data.ujian.pass_test)
        $('#tanggal_mulai').val((data.ujian.date_start).slice(0, 10))
        $('#waktu_mulai').val(data.ujian.time_start)
        $('#tanggal_akhir').val((data.ujian.date_end).slice(0, 10))
        $('#waktu_akhir').val(data.ujian.time_end)
        $('#nilai_benar').val(100/$('#jumlah_soal').val());
        if (data.ujian.result_to_user=='ya') {
          $("#result").val('ya');
        }
        else{
          $("#result").val('tidak');
        }
        if (data.ujian.report_to_user=='ya') {
          $("#report").val('ya');
        }
        else{
          $("#report").val('tidak');
        }
        $("#modalDetail").modal('show');
        dataTable.ajax.reload(null, false);
      });
  });

</script>
@endsection