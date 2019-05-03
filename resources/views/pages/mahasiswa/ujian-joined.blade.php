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
          <div class="row justify-content-center">
            <div class="col-12 col-sm-3">
              <div class="alert alert-primary text-center" role="alert">
                <p><strong>QUESTIONS</strong></p>
                <form action="{{url('mahasiswa/exam').'/'.$ujian->id.'/'.urlencode($ujian->nama)}}">
                @csrf
                @for($i = 0 ; $i < $total ; $i++)
                  @if($i == $index)
                    <button type="submit" name="packet_id" class="text-white btn btn-sm btn-success m-2" style="min-width: 30px" value="{{$i}}">{{$i+1}}</button>
                  @else
                    <button type="submit" name="packet_id" class="text-white btn btn-sm btn-warning m-2" style="min-width: 30px" value="{{$i}}">{{$i+1}}</button>
                  @endif
                @endfor
                </form>
              </div>
            </div>
            <div class="col">
              {!!$soal->soal->deskripsi!!}
              @if($soal->soal->file_path)
                <img id="gambarview" src="{{asset('/storage').$soal->soal->file_path}}" alt="gambar soal" width="500" height="auto">
              @endif
              <hr>
              <div class="form-check">
                <input class="form-check-input" type="radio" id="cb1" value="{{$soal->soal->pilihan_a}}" name="jawaban" required>
                <label class="form-check-label" for="exampleRadios1">
                  {{$soal->soal->pilihan_a}}
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" id="cb2" value="{{$soal->soal->pilihan_b}}" name="jawaban" required>
                <label class="form-check-label" for="exampleRadios1">
                  {{$soal->soal->pilihan_b}}
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" id="cb3" value="{{$soal->soal->pilihan_c}}" name="jawaban" required>
                <label class="form-check-label" for="exampleRadios1">
                  {{$soal->soal->pilihan_c}}
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" id="cb4" value="{{$soal->soal->pilihan_d}}" name="jawaban" required>
                <label class="form-check-label" for="exampleRadios1">
                  {{$soal->soal->pilihan_d}}
                </label>
              </div>
              @if($soal->soal->pilihan_e)
              <div class="form-check">
                <input class="form-check-input" type="radio" id="cb4" value="{{$soal->soal->pilihan_e}}" name="jawaban" required>
                <label class="form-check-label" for="exampleRadios1">
                  {{$soal->soal->pilihan_e}}
                </label>
              </div>
              @endif
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