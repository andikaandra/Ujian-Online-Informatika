<form action="{{url('tcexam/mahasiswa/exam').'/'.$ujian->id.'/'.urlencode($ujian->nama)}}">
  @csrf
  @php
    $myPackets = $packets->packet;
    // $myPacketsLen = $total;
    $iteratorIndex=0;
  @endphp
  <hr>
  <div class="row mx-2 justify-content-center">
    @foreach($myPackets as $pac)
      <div class="col-4">
      @if($pac->jawaban == null)
        <button type="submit" name="packet_id" class="text-white btn btn-sm btn-info my-2" style="min-width: 30px; max-width: 60px" value="{{$iteratorIndex}}">{{$iteratorIndex+1}}</button>
      @elseif($pac->status == -1)
        <button type="submit" name="packet_id" class="text-white btn btn-sm btn-warning my-2" style="min-width: 30px; max-width: 60px" value="{{$iteratorIndex}}">{{$iteratorIndex+1}}</button>
      @elseif($pac->jawaban != null)
        <button type="submit" name="packet_id" class="text-white btn btn-sm btn-success my-2" style="min-width: 30px; max-width: 60px" value="{{$iteratorIndex}}">{{$iteratorIndex+1}}</button>
      @endif
      </div>
      @php
        $iteratorIndex=$iteratorIndex+1;
      @endphp
    @endforeach
  </div>
  </form>
  <hr>
  <form action="{{route('finish.test')}}" method="post" id="finishTest">
  @csrf
    <div class="row justify-content-center mb-3">
      <input type="hidden" value="{{$packets->id}}" name="peserta_ujian">
      <input type="hidden" value="{{$packets->ujian_id}}" name="ujian_id">
      <button class="btn btn-success" type="submit">Selesai Ujian</button>  
    </div>
  </form>
  <br><br>
  