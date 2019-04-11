<form method="post" id="dataPeserta" enctype="multipart/form-data" action="{{route('upload.data')}}">
  @csrf
  <div class="form-group">
    <label for="university">College / University</label>
    <input type="text" class="form-control" name="university" id="university" placeholder="University" required>
  </div>
  <hr>
  <div class="form-group">
    <label for="participant">Number of Participant</label>
    <select class="form-control" id="participant" required>
      <option value="0" selected>Number of Participants</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
    </select>
  </div>
  <div id="participant-box">
    
  </div>
  <hr>
  <div class="form-group">
    <label for="nama_bank">Bank name</label>
    <input type="text" class="form-control" name="nama_bank" placeholder="ex : BNI" required>
  </div>
  <div class="form-group">
    <label for="nama_pengirim">Account Sender</label>
    <input type="text" class="form-control" name="nama_pengirim" placeholder="Account Sender" required>
  </div>
  <div class="form-group">
    <label for="jumlah_tf">Ammount</label>
    <input type="text" class="form-control" name="jumlah_tf" placeholder="Ammount" required>
  </div>
  <div class="form-group">
    <label for="">Proof of Payment</label>
    <br><input type="file" name="bukti_pembayaran" accept="image/*" value="" required><br>
    <small class="form-text text-muted">Max size 1 mb</small>
  </div>
  <input type="hidden" name="user" value="{{Auth::user()->id}}">
  <input type="hidden" id="jumlah_peserta" name="jumlah_peserta" value="">
  <button class="btn btn-sm btn-info text-white" type="submit">
    <i class="far fa-paper-plane"></i>&nbsp; Submit
  </button>
</form>