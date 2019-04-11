<form method="post" action="{{route('choose.cabang')}}">
  @csrf
  <div class="form-group">
    <label for="competition">Competition Branch</label>
    <select class="form-control" name="competition" id="cabang-list" required>
      <option value="Essay">Essay</option>
      <option value="Literature Review">Literature Review</option>
      <option value="Public Poster">Public Poster</option>
      <option value="Research Paper">Research Paper</option>
      <option value="Educational Video">Educational Video</option>
    </select>
  </div>
  <div class="rule-box">
    <div class="card">
      <div class="card-header bg-danger" id="rule-name">
        
      </div>
      <div class="card-body text-justify">
        <h5 class="card-title">Rules : </h5>
        <ul id="rule-list">
        </ul>
        <a href="" id="rule-link" class="btn btn-info text-white btn-sm float-right"></a>
      </div>
    </div>
  </div>
  <input type="hidden" name="user" value="{{Auth::user()->id}}">
  <button class="btn btn-sm btn-info text-white" type="submit">
    <i class="far fa-paper-plane"></i>&nbsp; Submit
  </button>
</form>