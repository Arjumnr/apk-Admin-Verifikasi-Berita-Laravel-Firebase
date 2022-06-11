<!-- modal insert -->
@include('layouts.head')                                               
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
            <form enctype="multipart/form-data"  action="berita/tambahBerita" method="POST" erole="form">
              @csrf  
                <div class="form-group">
                    <div class="row">
                    <label class="col-sm-3 control-label text-right">Gambar Berita <span class="text-red">*</span></label>         
                    <div class="col-sm-8">
                        <input type="file" class="form-control"  name="image" >
                        {{-- <img id="output/">  --}}
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                    <label class="col-sm-3 control-label text-right">Judul Berita <span class="text-red">*</span></label>
                    <div class="col-sm-8"><input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan Judul Berita..." ></div>
                    </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <label class="col-sm-3 control-label text-right">Link Berita <span class="text-red">*</span></label>         
                  <div class="col-sm-8"><input type="text" class="form-control" id="link" name="link" placeholder="Paste Link Berita..." ></div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <label class="col-sm-3 control-label text-right">Deskripsi Berita <span class="text-red">*</span></label>
                  <div class="col-sm-8"><input type="text" class="form-control" id="desc" name="desc" placeholder="Masukkan Judul Berita..." ></div>
                  </div>
                </div>
                

                @method('POST')

              <div class="modal-footer">
                <button id="nosave" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
                <button type="submit"   class="btn btn-warning btn-mg">Simpan</button>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('style/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('style/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('style/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('style/js/sb-admin-2.min.js')}}"></script>

  <!-- Page level plugins -->
  <script src="{{asset('style/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('style/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('style/js/demo/datatables-demo.js')}}"></script>
  {{-- <script src="https://www.gstatic.com/firebasejs/4.2.0/firebase.js"></script>
        <script>
            (() => { // protect the lemmings!
                    // Initialize Firebase
                    const config = {
                    apiKey: "AIzaSyBiOFRX36s49vF1vXcsZoHwPD0-F0sYPIQ",
                    authDomain: "rpl-cc.firebaseapp.com",
                    databaseURL: "https://rpl-cc-default-rtdb.asia-southeast1.firebasedatabase.app",
                    projectId: "rpl-cc",
                    storageBucket: "rpl-cc.appspot.com",
                    messagingSenderId: "G-2XXD1WQKG1"
                    };

                    firebase.initializeApp(config);
                    // firebase.analytics();

                    /* END ADDED THESE LINES */
                })();
        </script>
        <script>
                var upload = document.getElementById('upload');
                upload.addEventListener('change', function(e){
                    var file = e.target.files[0];
                    var storage = firebase.storage();
                    var storageRef = storage.ref('berita/' + file.name);
                    var task = storageRef.put(file);
                    console.log(task);
                });
            
        </script> --}}

