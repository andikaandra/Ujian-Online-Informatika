@extends('layouts.dosen')

@section('path', 'Test participants')

@section('style')

@endsection
@section('content')
    <div class="card card-content">
      <div class="card-body">
        <div class="row">
          <div class="col-8">
            <h4 class="card-title mb-0">Soal Ujian {{$ujian->nama}} | Jumlah Soal {{count($ujian->soals)}}</h4>
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
          <div class="row">
            <div class="col-4 col-md-10">
              
            </div>
            <div class="col-12 col-md-2">
              <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah soal</button>
            </div>
          </div>
          <br>
          @php
            $no=1; 
          @endphp
          <table class="display responsive no-wrap table" width="100%">
            <thead class="text-center">
              <th width="10">NO</th>
              <th>Soal</th>
              <th>Jawaban</th>
              <th >Action</th>
            </thead>
            <tbody>
              @foreach($ujian->soals as $u)
              <tr>
                <td align="center">{{$no++}}</td>
                <td>{{$u->id}}</td>
                <td>{{$u->id}}</td>
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

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah soal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<form method="post" id="hapusSoal" action="{{route('hapus.soal')}}">
  @csrf
  <input type="hidden" name="id" id="idSoal">
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
          {orderable: false},
        ]
      });

      $(".delete").click(function() {
        const id = $(this).attr('data-id');
        $('#idSoal').val(id);
        $('#hapusSoal').submit();
      });

  });

</script>
@endsection