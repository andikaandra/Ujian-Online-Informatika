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
            </div>
            @isset($index)
            <div class="list-group-item list-group-item-accent-primary list-group-item-divider">
              <div class="row">
                <div class="col-10">
                Question
                </div>
                <div class="col-2 float-right text-right">
                  <i class="fa fa-chevron-circle-right text-info" aria-hidden="true"></i>
                </div>
              </div>
            </div>
            @include('pages.mahasiswa.include.aside-question')
            @endisset
          </div>
        </div>
      </aside>