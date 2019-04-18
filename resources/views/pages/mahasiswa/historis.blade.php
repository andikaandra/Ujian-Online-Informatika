@extends('layouts.mahasiswa')

@section('path', 'History')

@section('style')

@endsection
@section('content')
    <div class="card card-content">
      <div class="card-body">
        <div class="row">
          <div class="col-8">
            <h4 class="card-title mb-0">History and Test list</h4>
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
          @php
            $no=1; 
          @endphp
          <table class="table table-striped table-hover table-sm" width="100%">
            <thead class="text-center">
              <th width="10">NO</th>
              <th>Nama</th>
              <th width="15%">Jumlah Benar</th>
              <th width="15%">Jumlah Salah</th>
              <th width="20%">Nilai</th>
            </thead>
            <tbody>
              @foreach($ujian as $u)
              <tr>
                <td>{{$no++}}</td>
                <td>{{$u->ujians->nama}}</td>
                <td align="center">{{$u->total_true_answer ?? '-'}}</td>
                <td align="center">{{$u->total_false_answer ?? '-'}}</td>
                <td align="center">{{$u->nilai ?? '-'}}</td>
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

    $('#body-section').removeClass('aside-menu-lg-show');

    $(function () {
      let dataTable = $(".table").DataTable({
      });

  });

</script>
@endsection