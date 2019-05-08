@extends('layouts.mahasiswa')

@section('path', 'Ujian')

@section('style')

@endsection
@section('content')
    <div class="card card-content">
      <div class="card-body">
        <div class="row">
          <div class="col-8">
            <h4 class="card-title mb-0">Soal no : {{$index+1}}</h4>
            <div class="text-muted">{{$ujian->nama}}</div>
          </div>
          <div class="col d-none d-md-block">
          </div>
        </div>
        <hr>
        <div class="chart-wrapper mt-3" style="min-height:300px;">
          <div class="row justify-content-center">
            <div class="col">
              {!!$soal->soal->deskripsi!!}
              @if($soal->soal->file_path)
                <img id="gambarview" src="{{asset('/storage').$soal->soal->file_path}}" alt="gambar soal" class="img-fluid" style=" max-width:600px;" >
              @endif
              @php
                $pilihana = $soal->soal->pilihan_a;
                $pilihanb = $soal->soal->pilihan_b;
                $pilihanc = $soal->soal->pilihan_c;
                $pilihand = $soal->soal->pilihan_d;
                $pilihane = $soal->soal->pilihan_e;
                $jawaban = $soal->jawaban;
              @endphp
              <hr>
              <form action="{{route('jawab.soal')}}" method="post">
              @csrf
              <div class="form-check">
                <input class="form-check-input" type="radio" id="cb1" value="{{$pilihana}}" name="jawaban" required {{$jawaban==$pilihana ? 'checked' : ''}}>
                <label class="form-check-label" for="">
                  {{$pilihana}}
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" id="cb2" value="{{$pilihanb}}" name="jawaban" required {{$jawaban==$pilihanb ? 'checked' : ''}}>
                <label class="form-check-label" for="">
                  {{$pilihanb}}
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" id="cb3" value="{{$pilihanc}}" name="jawaban" required {{$jawaban==$pilihanc ? 'checked' : ''}}>
                <label class="form-check-label" for="">
                  {{$pilihanc}}
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" id="cb4" value="{{$pilihand}}" name="jawaban" required {{$jawaban==$pilihand ? 'checked' : ''}}>
                <label class="form-check-label" for="">
                  {{$pilihand}}
                </label>
              </div>
              @if(strlen($pilihane)>0)
              <div class="form-check">
                <input class="form-check-input" type="radio" id="cb4" value="{{$pilihane}}" name="jawaban" required {{$jawaban==$pilihane ? 'checked' : ''}}>
                <label class="form-check-label" for="">
                  {{$pilihane}}
                </label>
              </div>
              @endif
              <br>
              <div class="row">
                <input type="hidden" name="ujian" value="{{$ujian}}">
                <button type="submit" name="packet_id" value="{{$soal->id}}" class="mx-3 text-white btn btn-success"> Simpan</button>
                </form>
                <form action="{{route('reset.soal')}}" method="post">
                @csrf
                <input type="hidden" name="ujian" value="{{$ujian}}">
                <button type="submit" name="packet_id" value="{{$soal->id}}" class="text-white btn btn-warning"> Reset</button>
                </form>                
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="row">
          <div class="col">
            @if($index>0)
            <form action="{{url('mahasiswa/exam').'/'.$ujian->id.'/'.urlencode($ujian->nama)}}">
            @csrf
            <button type="submit" name="packet_id" class="text-white btn btn-info" value="{{$index-1}}"><i class="fa fa-chevron-circle-left text-white" aria-hidden="true"></i> Sebelumnya</button>
            </form>
            @endif
          </div>
          <div class="col text-center">
            @if($soal->jawaban!=null && $soal->status!=-1)
              <form action="{{route('ragu.ragu')}}" method="post">
              @csrf
              <button type="submit" name="packet_id" value="{{$soal->id}}" class="text-white btn btn-warning"><i class="fa text-white fa-exclamation"></i> Ragu-Ragu</button>
              </form>
            @elseif($soal->status==-1)
              <form action="{{route('yakin.yakin')}}" method="post">
              @csrf
              <button type="submit" name="packet_id" value="{{$soal->id}}" class="text-white btn btn-success"><i class="fa text-white fa-exclamation"></i> Yakin</button>
              </form>
            @endif
          </div>
          <div class="col text-right">
            @if($index<$total-1)
            <form action="{{url('mahasiswa/exam').'/'.$ujian->id.'/'.urlencode($ujian->nama)}}">
            @csrf
            <button type="submit" name="packet_id" class="text-white btn btn-info" value="{{$index+1}}">Selanjutnya <i class="fa fa-chevron-circle-right text-white" aria-hidden="true"></i></button>
            </form>
            @endif
          </div>
        </div>
      </div>
    </div>
@endsection

@section('script')
<script>
    // $('#body-section').removeClass('aside-menu-lg-show');
    $('#body-section').removeClass('sidebar-lg-show');
    $(function() {  
      // console.log($('cb1').val());
    });
</script>
@endsection