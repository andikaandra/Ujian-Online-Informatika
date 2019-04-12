@extends('layouts.dosen')

@section('path', 'Fill name and email')

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
        <div class="alert alert-primary">
          
        </div>
        <div class="chart-wrapper mt-3" style="min-height:300px;">
          <table id="listUjian" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th width="10%">Nama</th>
{{--                     <th>Waktu Ujian</th>
                    <th>Nilai benar</th>
                    <th>Nilai salah</th>
                    <th>Waktu mulai</th>
                    <th>Waktu akhir</th>
                    <th>Laporan jawaban</th>
                    <th>Laporan nilai</th> --}}
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              @php
                $n = 1;
              @endphp
              @foreach($listUjian as $ujian)
                <tr>
                    <td align="center">{{$n++}}</td>
                    <td>{{$ujian->nama}}</td>
{{--                     <td>{{$ujian->test_time}}</td>
                    <td>{{$ujian->true_answer}}</td>
                    <td>{{$ujian->false_answer}}</td>
                    <td>{{$ujian->date_start}} | {{$ujian->time_start}}</td>
                    <td>{{$ujian->date_end}} | {{$ujian->time_end}}</td>
                    <td>{{$ujian->result_to_user}}</td>
                    <td>{{$ujian->report_to_user}}</td> --}}
                    <td><button id="detailUjian" class="btn btn-sm btn-info text-white">Detail</button></td>
                </tr>
              @endforeach
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
  $(document).ready( function () {
      $('#listUjian').DataTable({
        "columns": [
          { "width": "5%" },
          { "width": "65%" },
          null
        ]
      });
  } );
</script>
@endsection