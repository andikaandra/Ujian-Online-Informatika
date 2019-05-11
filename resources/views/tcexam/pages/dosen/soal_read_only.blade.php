@extends('tcexam.layouts.dosen')

@section('path', 'Test participants')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.6/quill.snow.css" />
@endsection
@section('content')
    <div class="card card-content">
      <div class="card-body">
        <div class="row">
          <div class="col-8">
            <h4 class="card-title mb-0"></h4>
            <div class="small text-muted">SMART Exam</div>
          </div>
          <div class="col d-none d-md-block">
          </div>
        </div>
        <hr>
        <hr>
        @if($errors->any())
          <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
              {{ $error }}<br>
            @endforeach
          </div>
        @elseif(\Session::has('success'))
            <div class="alert alert-success">
              {!! \Session::get('success') !!}
            </div>
        @elseif(\Session::has('error'))
            <div class="alert alert-danger">
              {!! \Session::get('error') !!}
            </div>
        @endif
        <div class="chart-wrapper mt-3" style="min-height:300px;">
          <br>
          @php
            $no=1; 
          @endphp
          <table class="display responsive no-wrap table" width="100%">
            <thead class="text-center">
              <th width="10">NO</th>
              <th>Soal</th>
              <th>Jawaban Soal</th>
              <th>Jawaban Peserta</th>
              <th >Status</th>
            </thead>
            <tbody>
              @foreach($packets->packet as $pack)
              <tr>
                <td align="center">{{$no++}}</td>
                <td><?php echo str_limit($pack->soal->deskripsi, 80, '...'); ?></td>
                <td><?php echo str_limit($pack->jawaban_soal, 30, '...'); ?></td>
                <td><?php echo str_limit($pack->jawaban, 30, '...'); ?></td>
                <td align="center">
                  @if($pack->jawaban_soal == $pack->jawaban)
                    <button class="btn btn-success text-white btn-sm" disabled>Benar</button>
                  @else
                    <button class="btn btn-danger text-white btn-sm" disabled>Salah</button>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <hr>
        </div>
      </div>
    </div>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.6/quill.js"></script>

<script>
  $('#body-section').removeClass('aside-menu-lg-show');

    $(function () {

      let dataTable = $(".table").DataTable({
        responsive: true,
        pageLength: 50,
        columns: [
          null,
          null,
          null,
          {orderable: false},
        ]
      });

  });

</script>
@endsection