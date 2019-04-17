@extends('layouts.dosen')

@section('path', 'Fill name and email')

@section('style')

@endsection
@section('content')
    <div class="card card-content">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-5">
            <h4 class="card-title mb-0">Peserta Ujian {{$ujian->nama}}</h4>
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
        <div class="chart-wrapper mt-3" style="min-height:300px;">
          <div class="row">
            <div class="col-4 col-md-2">
              Pilih peserta ujian :
            </div>
            <div class="col-8 col-md-8">
              <div class="form-group">
                <select class="selectpicker form-control" data-live-search="true" multiple>
                  <option>Mustard</option>
                </select>
              </div>
            </div>
            <div class="col-12 col-md-2">
              <button type="submit" class="btn btn-primary btn-block">Simpan</button>
            </div>
          </div>
          <hr>
          <br>
          <table class="table table-striped table-hover">
            <thead>
              <th>ID</th>
              <th>Nama</th>
              <th>NRP</th>
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
@endsection

@section('script')
<script>
  $('#body-section').removeClass('aside-menu-lg-show');

  $(document).ready( function () {
      $('select').selectpicker();
      let dataTable = $(".table").DataTable({
        responsive: true,
        ajax: '{{url('/dosen/list/ujian/peserta')}}'+'/'+{{$ujian->id}},
        columns: [
          {data: "id"},
          {data: "nama"},
          {data: null,
            render: function(data, type, row) {
                return "0 | <a href='ujian/peserta/"+row.id+"' role='button' class='btn btn-info text-white btn-sm participant' data-id='"+row.id+"'>Participant</a>";
            }
          },
          {data: null,
            render: function(data, type, row) {
                return "<button class='btn btn-success btn-sm info' data-id='"+row.id+"'>Info</button>";
            }
          }
        ]
      });

      $(document).on('click', '.info', async function(){
        const id = $(this).attr('data-id');
        let data;

        try {
            data = await $.ajax({
              url: '{{url('dosen/list/ujian/data')}}/' + id
            });
        } catch (e) {
          alert("Ajax error");
          console.log(e);
          return;
        }
        // console.log((data.ujian.date_start))
        $('#id_ujian').val(data.ujian.id)
        $('#nama').val(data.ujian.nama)
        $('#waktu_ujian').val(data.ujian.test_time)
        $('#nilai_benar').val(data.ujian.true_answer)
        $('#nilai_salah').val(data.ujian.false_answer)
        $('#jumlah_soal').val(data.ujian.jumlah_soal)
        $('#tanggal_mulai').val((data.ujian.date_start).slice(0, 10))
        $('#waktu_mulai').val(data.ujian.time_start)
        $('#tanggal_akhir').val((data.ujian.date_end).slice(0, 10))
        $('#waktu_akhir').val(data.ujian.time_end)
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