      <aside class="aside-menu" data-step="2" data-intro="This is your section about information">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link">
              <i class="icon-list"></i>
            </a>
          </li>
        </ul>
        <!-- Tab panes-->
        <div class="tab-content">
          <div class="tab-pane active" id="timeline" role="tabpanel">
            <div class="list-group list-group-accent">
              <div class="list-group-item list-group-item-accent-secondary bg-light text-center font-weight-bold text-muted text-uppercase small">Fill Data</div>
              <div class="list-group-item list-group-item-accent-{{ Auth::user()->name ? 'success' : 'danger' }} list-group-item-divider">
                <div class="row">
                  <div class="col-10">
                  Fill Name
                  </div>
                  <div class="col-2 float-right text-right">
                    @if(Auth::user()->name)
                      <i class="fa fa-chevron-circle-left text-info" aria-hidden="true"></i>
                    @else
                    <i class="fa fa-times text-danger" aria-hidden="true"></i>
                    @endif
                  </div>
                </div>
              </div>
              <div class="list-group-item list-group-item-accent-{{ Auth::user()->email ? 'success' : 'danger' }} list-group-item-divider">
                <div class="row">
                  <div class="col-10">
                  Fill Email
                  </div>
                  <div class="col-2 float-right text-right">
                    @if(Auth::user()->email)
                      <i class="fa fa-chevron-circle-left text-info" aria-hidden="true"></i>
                    @else
                    <i class="fa fa-times text-danger" aria-hidden="true"></i>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </aside>