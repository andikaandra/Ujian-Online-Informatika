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
          <form>
          @csrf
          <div class="row">
            <div class="col-4 col-md-2">
              Pilih peserta ujian :
            </div>
            <div class="col-8 col-md-8">
              <div class="form-group">
                <select class="selectpicker form-control" id="peserta" data-live-search="true" multiple name="peserta[]">
                  @foreach($users as $user)
                  <option value="{{$user->id}}">{{$user->kode}} | {{$user->name}}</option> 
                  @endforeach
                </select>
              </div>
            </div>
            <input type="hidden" name="ujian_id" value="{{$ujian->id}}">
            <div class="col-12 col-md-2">
              <button type="submit" class="btn btn-primary btn-block submit-participant">Simpan</button>
            </div>
          </div>
          </form>
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

    $(function () {
      $('select').selectpicker();
      let dataTable = $(".table").DataTable({
        responsive: true,
        ajax: '{{url('/dosen/list/ujian/peserta')}}'+'/'+{{$ujian->id}},
        columns: [
          {data: 'id'},
          {data: 'user_id'},
          {data: 'user_id'},
          {data: null,
            render: function(data, type, row) {
                return "<button class='btn btn-success btn-sm info' data-id='"+row.id+"'>Info</button>";
            }
          }
        ]
      });

      $('form').on('submit', function (e) {
          e.preventDefault();
          alertify.confirm('Confirmation', 'Would you like to add these participants?', async function() {
              let res;
              try {
                  res = await $.ajax({
                          url: `{{url('dosen/add/ujian/peserta')}}`, 
                          method: 'POST',
                          data: $('form').serialize()
                        });    
              } catch (error) {
                  alert("error adding");
                  console.log(error);
                  return;
              }
              console.log(res);
              alertify.success('participant added!');
              dataTable.ajax.reload(null, false);
            }, 
            function() { 
                // alertify.error('Cancel')
            }
          );
          // $("#peserta").val("");
      });

  });

</script>
@endsection