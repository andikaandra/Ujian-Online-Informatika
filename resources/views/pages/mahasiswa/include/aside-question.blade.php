<form action="{{url('mahasiswa/exam').'/'.$ujian->id.'/'.urlencode($ujian->nama)}}">
@csrf
@php
  $myPackets = $packets->packet;
  // $myPacketsLen = $total;
  $iteratorIndex=0;
@endphp
<ul style="list-style-type:square;">
  @foreach($myPackets as $pac)
    <li>
    @if($pac->jawaban == null)
      <button type="submit" name="packet_id" class="text-white btn btn-sm btn-secondary my-2" style="min-width: 30px" value="{{$iteratorIndex}}">{{$iteratorIndex+1}}</button>
    @elseif($pac->status == -1)
      <button type="submit" name="packet_id" class="text-white btn btn-sm btn-warning my-2" style="min-width: 30px" value="{{$iteratorIndex}}">{{$iteratorIndex+1}}</button>
    @elseif($pac->jawaban != null)
      <button type="submit" name="packet_id" class="text-white btn btn-sm btn-info my-2" style="min-width: 30px" value="{{$iteratorIndex}}">{{$iteratorIndex+1}}</button>
    </li>
    @endif
    @php
      $iteratorIndex=$iteratorIndex+1;
    @endphp
  @endforeach
</ul>
</form>