<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="editModalLabel">Edit Member Data</h4>
      </div>
      <div class="modal-body">
        <form id="form_jobseeker">
          <div class="row">
            <div class="col-xs-12 col-sm-6">
              <div class="form-group">
                <label for="email">Email:</label>
                <input class="form-control" id="email" type="email" name="email" required readonly></input>
              </div>
              <div class="form-group">
                  <label for="name">Nama:</label>
                  <input class="form-control" id="name" name="name"></input>
              </div>
              <div class="form-group">
                <label for="ktp_id">No. KTP:</label>
                <input class="form-control" id="ktp_id" name="ktp_id"></input>
              </div>
            </div>
            <div class="col-xs-12 col-sm-6">
              <div class="form-group">
                <label for="gender">Gender:</label>
                <select class="form-control" id="gender" name="gender">
                  <option value="L">Laki-Laki</option>
                  <option value="P">Perempuan</option>
                </select>
              </div>
              <div class="form-group">
                <label for="birthplace">Tempat Lahir:</label>
                <input class="form-control" id="birthplace" name="birthplace"></input>
              </div>
              <div class="form-group">
                <label for="birthdate">Tanggal Lahir:</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate"></input>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <div class="form-group">
                <label for="address">Alamat:</label>
                <textarea class="form-control" id="address" name="address" rows="4"></textarea>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="editmodalbtn">Save changes</button>
      </div>
    </div>
  </div>
</div>