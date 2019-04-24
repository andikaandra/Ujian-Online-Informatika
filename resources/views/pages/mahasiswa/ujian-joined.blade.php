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
          <div class="row">
            <div class="col-2">
              <div class="alert alert-primary" role="alert">
                <p><strong>QUESTIONS</strong></p>
                <ul>
                @for($i = 1 ; $i <= $total ; $i ++)
                  <li>{{$i}}</li>
                @endfor
                </ul>
              </div>
            </div>
            <div class="col">
              <ul>
              @foreach($packets->packet as $soal)
                <li>{!!$soal->soal->deskripsi!!}</li>
              @endforeach
              </ul>              
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