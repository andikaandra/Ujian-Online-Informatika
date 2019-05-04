@extends('layouts.dosen')

@section('path', 'Test participants')

@section('style')

@endsection
@section('content')
    <div class="card card-content">
      <div class="card-body">
        <div class="row">
          <div class="col-8">
            <h4 class="card-title mb-0">Peserta Ujian {{$ujian->nama}} | Jumlah Peserta {{count($ujian->peserta)}}</h4>
            <div class="small text-muted">SMART Exam</div>
          </div>
          <div class="col d-none d-md-block">

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
          <br>
          <form id="addParticipant">
          @csrf
          <div class="row">
            <div class="col-12 col-md-2">
              <a href="{{url('dosen/list-ujian')}}" role="button" class="mb-2 btn btn-block btn-info text-white"><i class="fas fa-backward"></i> &nbsp;List Ujian</a>
            </div>
            <div class="col-12 col-md-2">
              Pilih peserta ujian :
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                <select class="selectpicker form-control" id="peserta" data-live-search="true" multiple name="peserta[]">
                  @foreach($users as $user)
                  <option value="{{$user->id}}">{{$user->idUser}} | {{$user->name}}</option> 
                  @endforeach
                </select>
              </div>
            </div>
            <input type="hidden" name="ujian_id" value="{{$ujian->id}}">
            <div class="col-12 col-md-2">
              <button type="submit" class="btn btn-primary btn-block submit-participant"><i class="fas fa-save"></i> &nbsp;Simpan</button>
            </div>
          </div>
          </form>
          <hr>
          <br>
          @php
            $no=1; 
          @endphp
          <table class="display responsive no-wrap table" width="100%">
            <thead class="text-center">
              <th width="10">NO</th>
              <th>Nama</th>
              <th>NRP</th>
              <th>Nilai</th>
              <th >Action</th>
            </thead>
            <tbody>
              @foreach($ujian->peserta as $u)
              <tr>
                <td class="text-center">{{$no++}}</td>
                <td>{{$u->user->name}}</td>
                <td>{{$u->user->idUser}}</td>
                <td>{{$u->nilai}}</td>
                <td align="center"><button class="btn btn-danger btn-sm delete" data-id="{{$u->id}}">Hapus</button></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">

      </div>
    </div>
<form method="post" id="hapusPeserta" action="{{route('hapus.peserta')}}">
  @csrf
  <input type="hidden" name="id" id="idPesertaUjian">
</form>    
@endsection

@section('script')
<script>
  $('#body-section').removeClass('aside-menu-lg-show');

    $(function () {
      $('select').selectpicker();
      let dataTable = $(".table").DataTable({
        responsive: true,
        pageLength: 50,
        columns: [
          null,
          null,
          null,
          null,
          {orderable: false},
        ]
      });

      $('#addParticipant').on('submit', function (e) {
          e.preventDefault();
          alertify.confirm('Confirmation', 'Would you like to add these participants?', async function() {
              let res;
              try {
                res = await $.ajax({
                        url: `{{url('dosen/add/ujian/peserta')}}`, 
                        method: 'POST',
                        data: $('form').serialize()
                      });
                console.log(res);
              } catch (error) {
                  alert("error adding");
                  console.log(error);
                  return;
              } finally {
                $("#peserta").val("");
              }
              alertify.success('participant added!');
              location.reload();
              // dataTable.ajax.reload(null, false);
            }, 
            function() { 
                // alertify.error('Cancel')
            }
          );
      });

      $(".delete").click(function() {
        const id = $(this).attr('data-id');
        $('#idPesertaUjian').val(id);
        $('#hapusPeserta').submit();
      });

  });

</script>
@endsection