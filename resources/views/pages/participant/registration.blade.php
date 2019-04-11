@extends('layouts.participant')

@section('path', 'Registration')

@section('style')

@endsection
@section('content')
    <div class="card card-content">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-5">
            <h4 class="card-title mb-0">Registration</h4>
            <div class="small text-muted">AMSW <?php echo date("Y"); ?></div>
          </div>
          <div class="col-sm-7 d-none d-md-block">

          </div>
        </div>
        <hr>
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
        <div class="chart-wrapper mt-3" style="min-height:300px;">
          @if(Auth::user()->status > 1)
            <div class="alert alert-info">
              You choose <strong>{{Auth::user()->competition}}</strong> As your competition, 
               @if(Auth::user()->status < 4 )
                Reset your data here.
               @endif
            </div>
          @endif
          @if(Auth::user()->status==1)
            @include('includes.participant.form.choose-cabang')
          @elseif(Auth::user()->status==2)
            @include('includes.participant.form.upload-data')
          @elseif(Auth::user()->status==3)
            hjh
          @endif
        </div>
      </div>
      <div class="card-footer">

      </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
  //menghandle jika direfresh tapi udah diganti
  let text = $('#cabang-list').find(":selected").text();
  $('#rule-name').html(text);
  $('#rule-link').html("<i class='fas fa-download'></i> Download " + text + " guidebook");
  $('#rule-link').attr("href", "{{url('download/guidebook-')}}"+ (text.toLowerCase()).replace(" ", "-"));

  $('#cabang-list').on('change', function() {

    let text = $('#cabang-list').val();

    $('#rule-name').html(text);
    $('#rule-link').html("<i class='fas fa-download'></i> Download " + text + " guidebook");
    $('#rule-link').attr("href", "{{url('download/guidebook-')}}"+ (text.toLowerCase()).replace(" ", "-"));

    //todo : add rule

    $('#rule-list').html(text);
  });


    var addCols = function (num){
        for (var iter = 1; iter <= num; iter++) {
            var myCol = $('<div class=""></div>');
            var myPanel = $('<div class="col-md-12"><div align="center"><strong>Participant '+iter+'</strong></div><div class="form-group"><label for="nama'+iter+'">Full Name</label><input type="text" class="form-control" id="nama'+iter+'" name="nama'+iter+'" placeholder="" required></div><div class="form-row"><div class="form-group col-md-6"><label for=""><em>Curriculum Vitae</em></label><br><input type="file" accept="application/pdf" name="cv'+iter+'" id="file" required><small class="form-text text-muted">File must be .pdf extension, Max size 1 mb.</small><a href="#">Download CV templates</a></div><div class="form-group col-md-6"><label for="">4x6 Photo</label><br><input type="file" accept="image/*" name="foto'+iter+'" id="file" required><small class="form-text text-muted">Max size 1 mb.</small></div></div><div class="form-row my-2"><div class="form-group col-md-6"><label for="">ID Card(KTP)</label><br><input type="file" accept="image/*" name="ktp'+iter+'" id="file" required><small class="form-text text-muted">Max size 1 mb.</small></div><div class="form-group col-md-6"><label for="">Student ID Card(KTM)</label><br><input type="file" accept="image/*" name="ktm'+iter+'" id="file" required><small class="form-text text-muted">Max size 1 mb.</small></div></div></div><hr>');
            myPanel.appendTo(myCol);
            myCol.appendTo('#participant-box');
        }
    };

  let peserta = $('#participant').find(":selected").text();
  $('#participant').on('change', function() {

    let peserta = $('#participant').val();

    $("#participant-box").empty();

    if (peserta>=3 && peserta<=6) {
        addCols(peserta);
    }
    return false;

  });

  $("#dataPeserta").submit(e => {
    if ($('#participant').val()==0) {
      e.preventDefault();
    }
    $('#jumlah_peserta').val($('#participant').val());
  });
</script>
@endsection