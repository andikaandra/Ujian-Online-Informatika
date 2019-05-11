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
                  <div id="time" style="font-size: 25px"></div><hr>
                  @php
                  date_default_timezone_set('Asia/Jakarta');
                  $format = 'Y-m-d H:i:s';
                  $start = DateTime::createFromFormat($format, substr($ujian->date_start, 0, 11).$ujian->time_start);
                  $end = DateTime::createFromFormat($format, substr($ujian->date_end, 0, 11).$ujian->time_end);
                  $now = (new DateTime())->format($format);
                  @endphp
                  @if(count($ujian->soals) == $ujian->jumlah_soal)
                    @if($now > $end->format($format))
                      <button class="btn btn-danger text-white btn-block" style="cursor: no-drop;" disabled>ALREADY ENDED</button>
                    @elseif($now < $start->format($format))
                      <button class="btn btn-info text-white btn-block" style="cursor: no-drop;" disabled>NOT STARTED YET</button>
                    @else
                      <form action="{{route('join.ujian')}}" method="post">
                        @csrf
                        <input type="hidden" name="ujian_id" value="{{$ujian->id}}">
                        <button type="submit" class="btn btn-success btn-block">JOIN</button>
                      </form>
                    @endif
                  @else
                      <button class="btn btn-danger text-white btn-block" style="cursor: no-drop;" disabled>EXAM IS NOT READY YET</button>                  
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

    var start = <?php echo json_encode($ujian->time_start); ?>;

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }

    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        // add a zero in front of numbers<10
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
        if ((h + ":" + m + ":" + s) == start) {
          window.location.reload();
        }

        t = setTimeout(function () {
            startTime()
        }, 500);
    }
    startTime();

</script>
@endsection