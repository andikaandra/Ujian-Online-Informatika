<div class="sidebar">
<nav class="sidebar-nav">
    <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="{{url('participant')}}" class="nav-link" style="cursor: default;">
        <div class="row justify-content-center">
            <div class="nav-profile-image">
              <img src="{{asset('dashboard/img/avatars/avatar.png')}}" alt="image" style="width: 50px">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="nav-profile-text d-flex flex-column">
              <span class="font-weight-bold mb-2">{{Auth::user()->kode}}</span>
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
        <a class="nav-link" href="{{ url('dosen')}}">
        <i class="nav-icon fas fa-clipboard"></i> Dashboard</a>
    </li>
    <li class="divider"></li>
    <li class="nav-title">Menu</li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('dosen/tambah-ujian')}}">
        <i class="nav-icon fas fa-plus"></i> Tambah Ujian</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('dosen/list-ujian')}}">
        <i class="nav-icon fas fa-list"></i> List Ujian</a>
    </li>
    <li class="divider"></li>
    @if(!Auth::user()->name)
    <li class="nav-title">Data filling</li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('data/fill-data')}}">
        <i class="nav-icon fas fa-code-branch"></i> Data</a>
    </li>
    @endif
    </ul>
</nav>
<button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>