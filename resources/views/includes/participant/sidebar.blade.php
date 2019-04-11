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
              <span class="font-weight-bold mb-2">{{Auth::user()->name}}</span>
            </div>            
        </div>
      </a>
    </li>

    <li class="nav-title">Main Information</li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('participant')}}">
        <i class="nav-icon fas fa-clipboard"></i> Dashboard</a>
    </li>
    @if(Auth::user()->email_verification == 'verified')
    <li class="nav-title">Pre Registration</li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('participant/registration')}}">
        <i class="nav-icon fas fa-code-branch"></i> Registration</a>
    </li>
    @endif
    {{-- telah diverifikasi oleh admin (status == 4 keatas)--}}
    @if(Auth::user()->status > 3)
    <li class="nav-item">
        <a class="nav-link" href="#">
        <i class="nav-icon fas fa-user-friends"></i> My Team
        <span class="badge badge-primary">NEW</span>
        </a>
    </li>
    @endif
    <li class="divider"></li>
    </ul>
</nav>
<button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>