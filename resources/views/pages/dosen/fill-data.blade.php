@extends('layouts.dosen')

@section('path', 'Fill name and email')

@section('style')

@endsection
@section('content')
    <div class="card card-content">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-5">
            <h4 class="card-title mb-0">Data filling</h4>
            <div class="small text-muted">SMART Exam</div>
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
        <div class="alert alert-danger">
          Once you submit your name, you cant change your data
        </div>
        <div class="chart-wrapper mt-3" style="min-height:300px;">
          <form method="post" id="dataPeserta" action="{{route('fill.data')}}">
            @csrf
            <div class="form-group">
              <label for="nama">Complete Name</label>
              <input type="text" maxlength="100" class="form-control" name="nama" id="nama" placeholder="Complete Name" required>
            </div>
            <button class="btn btn-sm btn-info text-white" type="submit">
              <i class="far fa-paper-plane"></i>&nbsp; Submit
            </button>
          </form>
        </div>
      </div>
      <div class="card-footer">

      </div>
    </div>
@endsection

@section('script')
@endsection