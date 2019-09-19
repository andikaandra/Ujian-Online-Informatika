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
            <h4 class="card-title mb-0">Soal Ujian {{$ujian->nama}} | Jumlah Soal {{count($ujian->soals)}}</h4>
            <div class="small text-muted">SMART Exam</div>
          </div>
          <div class="col d-none d-md-block">
          {{-- <img id="result" src="{{asset('/storage/question-image/TT0e6o8M2uHuNw5GlAafOrdBpjr26SSBhtuUwwwy.png')}}" alt=""> --}}
          </div>
        </div>
        <hr>
        @if(count($ujian->soals)!=$ujian->jumlah_soal)
          <div class="alert alert-danger">
            Ujian dapat dimulai jika soal telah mencapai {{$ujian->jumlah_soal}} butir
          </div>        
        @endif
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
              <a href="{{url('tcexam/dosen/list-ujian')}}" role="button" class="mb-2 btn btn-block btn-info text-white"><i class="fas fa-backward"></i> &nbsp;List Ujian</a>
            </div>
            <div class="col">
              
            </div>
            <div class="col-12 col-md-2">
              @if(count($ujian->soals)<$ujian->jumlah_soal)
              <button type="button" class="mb-2 btn btn-block btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" id="tambah"><i class="fas fa-plus"></i> &nbsp; Tambah soal</button>
              @else
              <button type="button" class="mb-2 btn btn-block btn-success" style="cursor: default;" disabled="">Soal mencukupi</button>
              @endif
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
                <td width="45%">click view to read question</td>
                <td width="30%">{{ substr($u->jawaban,0,30) }}</td>
                <td align="center">
                  <button class="btn btn-info text-white btn-sm view" data-id="{{$u->id}}">View</button>
                  <button class="btn btn-danger btn-sm delete" data-id="{{$u->id}}">Hapus</button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <hr>
          <small class="text-danger">*Fitur ini digunakan jika akan mengimport soal ujian dari ujian anda yang lainnya</small><br>
          <div class="row">
            <div class="col-md-2 col-6">
              Import soal dari :
            </div>
            <form action="{{route('import.soal')}}" method="post">
            <div class="col">
              <div class="form-row">
                <div class="form-group col">
                  <select class="selectpicker form-control" data-live-search="true" name="ujian" id="ujian" placeholder="Nama Ujian">
                    @foreach($listUjian as $uj)
                      <option value="{{$uj->id}}">{{$uj->nama}}</option> 
                    @endforeach
                  </select>                
                </div>
                <div class="form-group col">
                  @csrf
                  <input type="hidden" name="ujianid" value="{{$ujian->id}}">
                  <button class="btn btn-info text-white" type="submit">Import</button>
                </div>
              </div>
              </div>
            </form>
          </div>
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
          <div id="editor" style="height: 375px;" class="mb-3"></div>
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
            <li><input type="text" class="form-control mb-2" name="pilihan1" autocomplete="off" required></li>
            <li><input type="text" class="form-control mb-2" name="pilihan2" autocomplete="off" required></li>
            <li><input type="text" class="form-control mb-2" name="pilihan3" autocomplete="off" required></li>
            <li><input type="text" class="form-control mb-2" name="pilihan4" autocomplete="off" required></li>
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
      <form method="post" id="formsoaledit" enctype="multipart/form-data" action="{{route('edit.soal')}}">
        @csrf
      <div class="modal-header">
        <h5 class="modal-title">Edit soal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="nama">Deskripsi soal</label>
          <div class="form-control" style="height: 375px;" class="mb-3" id="editor2"></div>
          <input type="hidden" id="descriptionedit" name="descriptionedit">
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
            <li><input type="text" class="form-control mb-2" name="pilihan1view" id="pilihan1view" autocomplete="off" required></li>
            <li><input type="text" class="form-control mb-2" name="pilihan2view" id="pilihan2view" autocomplete="off" required></li>
            <li><input type="text" class="form-control mb-2" name="pilihan3view" id="pilihan3view" autocomplete="off" required></li>
            <li><input type="text" class="form-control mb-2" name="pilihan4view" id="pilihan4view" autocomplete="off" required></li>
            <li><input type="text" class="form-control mb-2" name="pilihan5view" id="pilihan5view" autocomplete="off" ></li>
          </ol>
        </div>
        <hr>
        <div class="form-group">
          <label for="">Jawaban</label><br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="cb1view" value="pilihan1view" name="jawabanview" required>
              <label class="form-check-label" for="cb1view">A</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="cb2view" value="pilihan2view" name="jawabanview" required>
              <label class="form-check-label" for="cb2view">B</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="cb3view" value="pilihan3view" name="jawabanview" required>
              <label class="form-check-label" for="cb3view">C</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="cb4view" value="pilihan4view" name="jawabanview" required>
              <label class="form-check-label" for="cb4view">D</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" id="cb5view" value="pilihan5view" name="jawabanview" required>
              <label class="form-check-label" for="cb5view">E</label>
            </div>
        </div>
{{--         <div class="form-group">
          <label for="nama">Jawaban</label>
          <input type="text" class="form-control" readonly id="jawabanview">
        </div> --}}
        <br><br>
      </div>
      <input type="hidden" id="soal_ids" name="soal_id" value="">
      <input type="hidden" name="ujian_id" value="{{$ujian->id}}">
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
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
<script src="//cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.6/quill.js"></script>

<script>
  const toolbarOptions = [
    ['bold', 'italic', 'underline', 'strike'],
    ['blockquote', 'code-block'],

    [{ 'header': 1 }, { 'header': 2 }],
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    [{ 'script': 'sub'}, { 'script': 'super' }],
    [{ 'indent': '-1'}, { 'indent': '+1' }],
    [{ 'direction': 'rtl' }],

    [{ 'size': ['small', false, 'large', 'huge'] }],
    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
    [ 'link', 'image', 'formula' ],
    [{ 'color': [] }, { 'background': [] }],
    [{ 'align': [] }],

    ['clean']
  ];

  const quill = new Quill('#editor', {
    theme: 'snow',
    modules: {
      toolbar: toolbarOptions
    },
    placeholder: 'Deskripsi soal.',
  });

  const quill2 = new Quill('#editor2', {
    theme: 'snow',
    modules: {
      toolbar: toolbarOptions
    },
    placeholder: 'Deskripsi soal.',
  });

  function selectLocalImage() {
      const input = document.createElement('input');
      input.setAttribute('type', 'file');
      input.click();

      // Listen upload local image and save to server
      input.onchange = () => {
        const file = input.files[0];

        // file type is only image.
        if (/^image\//.test(file.type)) {
          saveToServer(file);
        } else {
          console.warn('You could only upload images.');
        }
      };
    }

    /**
     * Step2. save to server
     *
     * @param {File} file
     */
    function saveToServer(file) {
      let res;
      try {
          var fd = new FormData();        
          fd.append('image', file);
          fd.append('_token', '{{ csrf_token() }}');
          fd.append('ujian_id', '{{$ujian->id}}');

          $.ajax({
            url: `{{url('/tcexam/dosen/upload/image')}}`, 
            method: 'POST',
            processData: false,
            contentType: false,
            cache: false,
            enctype: 'multipart/form-data',
            data: fd,
            success:function(data) {
              console.log(data)
              insertToEditor(data);
            }
          });
      } catch (error) {
          alert("error accepting");
          console.log(error);
          return;
      }
    }

    function insertToEditor(url) {
      let base_url = `{{url('/')}}`
      const range = quill.getSelection();
      quill.insertEmbed(range.index, 'image', `${base_url}storage/${url}`);
    }

    quill.getModule('toolbar').addHandler('image', () => {
      selectLocalImage();
    });

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
              url: '{{url('tcexam/dosen/list/soal/data')}}/' + id
            });
        } catch (e) {
          alert("Ajax error");
          console.log(e);
          return;
        }

        quill2.root.innerHTML = data.soal.deskripsi

        $('#soal_ids').val(id)
        $('#pilihan1view').val(data.soal.pilihan_a)
        $('#pilihan2view').val(data.soal.pilihan_b)
        $('#pilihan3view').val(data.soal.pilihan_c)
        $('#pilihan4view').val(data.soal.pilihan_d)
        $('#pilihan5view').val(data.soal.pilihan_e)
        if (data.soal.pilihan_a==data.soal.jawaban) {
          $("#cb1view").prop("checked", true);
        }
        else if(data.soal.pilihan_b==data.soal.jawaban){
          $("#cb2view").prop("checked", true);
        }
        else if(data.soal.pilihan_c==data.soal.jawaban){
          $("#cb3view").prop("checked", true);
        }
        else if(data.soal.pilihan_d==data.soal.jawaban){
          $("#cb4view").prop("checked", true);
        }
        else if(data.soal.pilihan_e==data.soal.jawaban){
          $("#cb5view").prop("checked", true);
        }

        if (data.soal.file_path) {
          $('#gambarview').attr('src', $('#path').val()+data.soal.file_path).width(150).height('auto');
        }
        else{
          $('#gambarview').attr('src', '');
        }
        $("#modalData2").modal('show');
      });

      $("#formsoal").submit(function(e) {
        var myEditor = document.querySelector('#editor')
        var html = myEditor.children[0].innerHTML

        if ($('input[name=jawaban]:checked').val()=="pilihan5" && $("input[name='pilihan5']").val().length == 0) {
          alert("Pilihan 'E' tidak boleh kosong!")
          e.preventDefault();
        }
        // let w = quill.getContents()
        $("input[name='description']").val(html);

      });

      $("#formsoaledit").submit(function(e) {
        var myEditor = document.querySelector('#editor2')
        var html = myEditor.children[0].innerHTML

        if ($('input[name=jawabanview]:checked').val()=="pilihan5view" && $("input[name='pilihan5view']").val().length == 0) {
          alert("Pilihan 'E' tidak boleh kosong!")
          e.preventDefault();
        }
        $("input[name='descriptionedit']").val(html);

      });

  });

</script>
@endsection
