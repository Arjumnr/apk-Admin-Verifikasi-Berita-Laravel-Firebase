<!-- modal insert -->
                                                  
<button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahuser">Tambah Berita</a>
  </button>
<div class="example-modal">
    <div id="tambahuser" class="modal fade" role="dialog" style="display:none;">
      <div class="modal-dialog"> 
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h3>Tambah Berita</h3>
          </div>
          <div class="modal-body">
            <form action="" method="POST" role="form">
                <div class="form-group">
                    <div class="row">
                    <label class="col-sm-3 control-label text-right">Gambar Berita <span class="text-red">*</span></label>         
                    <div class="col-sm-8"><input type="file" class="form-control" name="" placeholder="Id User" value=""></div>
                    </div>
                  </div>
              <div class="form-group">
                <div class="row">
                <label class="col-sm-3 control-label text-right">Link Berita <span class="text-red">*</span></label>         
                <div class="col-sm-8"><input type="text" class="form-control" name="id_user" placeholder="Paste Link Berita..." value=""></div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                <label class="col-sm-3 control-label text-right">Judul Berita <span class="text-red">*</span></label>
                <div class="col-sm-8"><input type="text" class="form-control" name="username" placeholder="Masukkan Judul Berita..." value=""></div>
                </div>
              </div>
              
              
              <div class="modal-footer">
                <button id="nosave" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
                <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div><!-- modal insert close -->