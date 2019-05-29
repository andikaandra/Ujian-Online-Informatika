<div class="sidebar" data-step="3" data-intro="You can navigate to other menu by click on this section">
<nav class="sidebar-nav">
    <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="{{url('tcexam/dosen')}}" class="nav-link" style="cursor: default;">
        <div class="row justify-content-center">
            <div class="nav-profile-image">
              <img src="{{asset('dashboard/img/avatars/avatar.png')}}" alt="image" style="width: 50px">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="nav-profile-text d-flex flex-column">
              <span class="font-weight-bold mb-2">{{Auth::user()->idr}}</span>
            </div>            
        </div>
        <div class="row justify-content-center">
            <div class="nav-profile-text d-flex flex-column">
              <span class="font-weight-bold mb-2">{{Auth::user()->name}}</span>
            </div>            
        </div>
      </a>
    </li>

    <li class="nav-title">Main Information</li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('tcexam/dosen')}}">
        <i class="nav-icon fas fa-clipboard"></i> Dashboard</a>
    </li>
    <li class="divider"></li>
    <li class="nav-title">Menu</li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('tcexam/dosen/tambah-ujian')}}">
        <i class="nav-icon fas fa-plus"></i> Create Exam</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('tcexam/dosen/list-ujian')}}">
        <i class="nav-icon fas fa-list"></i> List Exam</a>
    </li>
    </ul>
</nav>
<button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>