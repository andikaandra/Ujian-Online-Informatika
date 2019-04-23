@extends('layouts.dosen')

@section('path', 'Test participants')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.6/quill.snow.css" />
@endsection
@section('content')
    <div class="card card-content">
      <div class="card-body">
        <div class="row">
          <div class="col-8">
            <h4 class="card-title mb-0">Soal Ujian {{$ujian->nama}} | Jumlah Soal {{count($ujian->soals)}}</h4>
            <div class="small text-muted">SMART Exam</div>
          </div>
          <div class="col d-none d-md-block">
          {{-- <img id="result" src="{{asset('/storage/question-image/TT0e6o8M2uHuNw5GlAafOrdBpjr26SSBhtuUwwwy.png')}}" alt=""> --}}
          </div>
        </div>
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
          <div class="row">
            <div class="col-12 col-md-2">
              <a href="{{url('dosen/list-ujian')}}" role="button" class="mb-2 btn btn-block btn-info text-white"><i class="fas fa-backward"></i> &nbsp;Kembali</a>
            </div>
            <div class="col">
              
            </div>
            <div class="col-12 col-md-2">
              <button type="button" class="mb-2 btn btn-block btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" id="tambah"><i class="fas fa-plus"></i> &nbsp; Tambah soal</button>
            </div>
          </div>
          <br>
          @php
            $no=1; 
          @endphp
          <table class="display responsive no-wrap table" width="100%">
            <thead class="text-center">
              <th width="10">NO</th>
              <th>Soal</th>
              <th>Jawaban</th>
              <th >Action</th>
            </thead>
            <tbody>
              @foreach($ujian->soals as $u)
              <tr>
                <td align="center">{{$no++}}</td>
                <td><?php echo str_limit($u->deskripsi, 60, '...'); ?></td>
                <td>{{$u->jawaban}}</td>
                <td align="center">
                  <button class="btn btn-info text-white btn-sm view" data-id="{{$u->id}}">View</button>
                  <button class="btn btn-danger btn-sm delete" data-id="{{$u->id}}">Hapus</button>
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

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalData" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" id="formsoal" enctype="multipart/form-data" action="{{route('tambah.soal')}}">
        @csrf
      <div class="modal-header">
        <h5 class="modal-title">Tambah soal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="nama">Deskripsi soal</label>
          <div id="editor" class="mb-3"></div>
          <input type="hidden" id="description" name="description">
        </div>
        <hr>
        <div class="form-group">
          <label for="">Gambar untuk soal <em class="text-danger">(opsional)</em></label><br>
          <input type="file" accept="image/*" onchange="readURL(this);" name="image" /><br>
          <img id="result" src="#"/ alt="&nbsp;">
        </div>
        <hr>
        <div class="form-group">
          <label for="">Pilihan</label>
          <ol type="A">
            <li><input type="text" class="form-control mb-2" name="pilihan1" autocomplete="off"></li>
            <li><input type="text" class="form-control mb-2" name="pilihan2" autocomplete="off"></li>
            <li><input type="text" class="form-control mb-2" name="pilihan3" autocomplete="off"></li>
            <li><input type="text" class="form-control mb-2" name="pilihan4" autocomplete="off"></li>
            <li><input type="text" class="form-control mb-2" name="pilihan5" autocomplete="off" ></li>
          </ol>
          <small class="text-danger">*Kosongkan pilihan E jika pilihan hanya 4</small>
        </div>
        <hr>
        <div class="form-group">
          <label for="">Jawaban</label><br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="cb1" value="pilihan1" name="jawaban" required>
              <label class="form-check-label" for="cb1">A</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="cb2" value="pilihan2" name="jawaban" required>
              <label class="form-check-label" for="cb2">B</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="cb3" value="pilihan3" name="jawaban" required>
              <label class="form-check-label" for="cb3">C</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="cb4" value="pilihan4" name="jawaban" required>
              <label class="form-check-label" for="cb4">D</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="cb5" value="pilihan5" name="jawaban" required>
              <label class="form-check-label" for="cb5">E</label>
            </div>
        </div>
        <br><br>
      </div>
      <input type="hidden" name="ujian_id" value="{{$ujian->id}}">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="modalData2" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit soal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="nama">Deskripsi soal</label>
          <div class="form-control" readonly id="editor2"></div>
        </div>
        <hr>
        <div class="form-group">
          <label for="">Gambar soal</label><br>
          <img id="gambarview" src="#" alt="&nbsp;">
        </div>
        <hr>
        <div class="form-group">
          <label for="">Pilihan</label>
          <ol type="A">
            <li><input type="text" class="form-control mb-2" id="pilihan1view" readonly></li>
            <li><input type="text" class="form-control mb-2" id="pilihan2view" readonly></li>
            <li><input type="text" class="form-control mb-2" id="pilihan3view" readonly></li>
            <li><input type="text" class="form-control mb-2" id="pilihan4view" readonly></li>
            <li><input type="text" class="form-control mb-2" id="pilihan5view" readonly ></li>
          </ol>
        </div>
        <hr>
        <div class="form-group">
          <label for="nama">Jawaban</label>
          <input type="text" class="form-control" readonly id="jawabanview">
        </div>
        <br><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<input type="hidden" id="path" value="{{asset('/storage')}}">
<form method="post" id="hapusSoal" action="{{route('hapus.soal')}}">
  @csrf
  <input type="hidden" name="id" id="idSoal">
</form>    
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.6/quill.js"></script>

<script>
  const toolbarOptions = [
    ['bold', 'italic', 'underline', 'strike'],
    ['blockquote', 'code-block'],
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    [{ 'script': 'sub'}, { 'script': 'super' }],
    ['clean']
  ];

  const quill = new Quill('#editor', {
    theme: 'snow',
    modules: {
      toolbar: toolbarOptions
    },
    placeholder: 'Deskripsi soal.',
  });

</script>
<script>
  $('#body-section').removeClass('aside-menu-lg-show');

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
          $('#result').attr('src', e.target.result).width(150).height('auto');
      };

      reader.readAsDataURL(input.files[0]);
    }
  }

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

      $(".delete").click(function() {
        const id = $(this).attr('data-id');
        $('#idSoal').val(id);
        $('#hapusSoal').submit();
      });

      $(".view").click(async function() {
        const id = $(this).attr('data-id');
        let data;
        try {
            data = await $.ajax({
              url: '{{url('dosen/list/soal/data')}}/' + id
            });
        } catch (e) {
          alert("Ajax error");
          console.log(e);
          return;
        }
        $('#editor2').html(data.soal.deskripsi)
        $('#pilihan1view').val(data.soal.pilihan_a)
        $('#pilihan2view').val(data.soal.pilihan_b)
        $('#pilihan3view').val(data.soal.pilihan_c)
        $('#pilihan4view').val(data.soal.pilihan_d)
        $('#pilihan5view').val(data.soal.pilihan_e)
        $('#jawabanview').val(data.soal.jawaban)
        if (data.soal.file_path) {
          $('#gambarview').attr('src', $('#path').val()+data.soal.file_path).width(150).height('auto');
        }
        else{
          $('#gambarview').attr('src', '');
        }
        console.log($('#path').val() + data.soal.file_path);
        $("#modalData2").modal('show');
      });

      $("#formsoal").submit(function(e) {
        var myEditor = document.querySelector('#editor')
        var html = myEditor.children[0].innerHTML

        // if (!html.length) {
        //   alert("Cannot be empty!");
        //   return false;
        // }
        if ($('input[name=jawaban]:checked').val()=="pilihan5" && $("input[name='pilihan5']").val().length == 0) {
          alert("Pilihan 'E' tidak boleh kosong!")
          e.preventDefault();
        }
        $("input[name='description']").val(html);

      });

  });

</script>
@endsection