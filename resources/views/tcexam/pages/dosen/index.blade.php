@extends('tcexam.layouts.dosen')

@section('path', 'Dashboard')

@section('style')

@endsection
@section('content')
    <div class="card card-content" data-step="1" data-intro="Hello, welcome to SmartExam.">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-5">
            <h4 class="card-title mb-0">SMART Exam</h4>
            <div class="small text-muted">Dashboard</div>
          </div>
          <div class="col-sm-7 d-none d-md-block">            
          </div>          
        </div>
        <hr>
        <div class="chart-wrapper mt-3" style="min-height:300px;">
          <div class="email-unverified">
            <p>Hello {{Auth::user()->name ? Auth::user()->name : ' '}} 
              <strong>{{Auth::user()->kode}}</strong>. <br> </p>
          </div>
          <div class="row">
            
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
  function completeTour() {
    try {
        res = $.ajax({
          url: '{{url('tcexam/finish-tour')}}',
          method: 'POST',
          data: {'_token': '{{ csrf_token() }}'}
        });
        // console.log(res);
    } catch (error) {
        alert("error");
        console.log(error);
        return;
    }
  }

  $(function() {  
    var hadTour = {{Auth::user()->has_finish_tour}};
    if(!hadTour){
      introJs().oncomplete(function() {
        completeTour();
      }).onexit(function(){
        completeTour();
      }).start();
    }
  });
</script>
@endsection