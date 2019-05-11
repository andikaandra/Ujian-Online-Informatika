@extends('tcexam.layouts.mahasiswa')

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
              <th width="10%">Cek</th>
            </thead>
            <tbody>
              @foreach(Auth::user()->ujians as $u)
              <tr>
                <td>{{$no++}}</td>
                <td>{{$u->ujians->nama}}</td>
                @if($u->ujians->result_to_user == 'ya')
                  <td align="center">{{$u->total_true_answer ?? '-'}}</td>
                  <td align="center">{{$u->total_false_answer ?? '-'}}</td>
                  <td align="center">{{$u->nilai ?? '-'}}</td>
                @else
                  <td align="center">secret</td>
                  <td align="center">secret</td>
                  <td align="center">secret</td>
                @endif
                  <td align="center">
                    <a role="button" class="btn btn-sm btn-info text-white" target="_blank" href="{{url('tcexam/mahasiswa/exam').'/'.$u->ujians->id.'/'.urlencode($u->ujians->nama)}}" style="text-decoration: none;">Cek</a>
                  </td>
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