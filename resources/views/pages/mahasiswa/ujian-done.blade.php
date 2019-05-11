@extends('layouts.mahasiswa')

@section('path', 'Ujian')

@section('style')

@endsection
@section('content')
    <div class="card card-content">
      <div class="card-body">
        <div class="row">
          <div class="col-8">
            <h4 class="card-title mb-0">{{$ujian->nama}}</h4>
            <div class="small text-muted">SMART Exam</div>
          </div>
          <div class="col d-none d-md-block">
          </div>
        </div>
        <hr>
        <div class="chart-wrapper mt-3" style="min-height:300px;">
          <div class="container h-100">
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
            <div class="row align-items-center h-100 ">
              <div class="col-12 col-md-6 mx-auto">
                <div class="jumbotron text-center bg-white">
                  <strong>Name</strong> : {{$ujian->nama}}<br>
                  <strong>Start time</strong> : {{substr($ujian->date_start, 0, 11).$ujian->time_start}}<br>
                  <strong>End time</strong> : {{substr($ujian->date_end, 0, 11).$ujian->time_end}}<br>
                  <strong>True point</strong> : {{$ujian->true_answer}}<br>
                  <strong>False point</strong> : {{$ujian->false_answer}}<br>
                  <strong>Total Questions</strong> : {{count($ujian->soals)}}<br><br>

                  <strong>Lecturer</strong> : {{$ujian->dosen->name ?? 'Mr. lecturer'}}<br><br>
                  <h4>
                    <strong>Nilai</strong> : {{$ujian->result_to_user=='ya' ? $nilai : 'Secret'}}<br>
                  </h4>
                  @if($nilai > $ujian->pass_test)
                    <div class="alert alert-success">
                      Congratulation, You pass the test
                    </div>
                  @else
                    <div class="alert alert-warning">
                      You <strong>dont</strong> pass the test, please contact your lecturer for more information
                    </div>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
      </div>
    </div>
@endsection

@section('script')
<script>

    $('#body-section').removeClass('aside-menu-lg-show');
    $('#body-section').removeClass('sidebar-lg-show');
</script>
@endsection