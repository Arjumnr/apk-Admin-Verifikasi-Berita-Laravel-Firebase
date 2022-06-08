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
            <form action="berita/tambahBerita" enctype=”multipart/form-data” method="GET" role="form">
                <div class="form-group">
                    <div class="row">
                    <label class="col-sm-3 control-label text-right">Gambar Berita <span class="text-red">*</span></label>         
                    <div class="col-sm-8">
                        <input type="file" class="form-control" name="image" value="upload" accept=".jpg" id="fileButton">
                        <img id="output/"> 
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                    <label class="col-sm-3 control-label text-right">Judul Berita <span class="text-red">*</span></label>
                    <div class="col-sm-8"><input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan Judul Berita..." value=""></div>
                    </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <label class="col-sm-3 control-label text-right">Link Berita <span class="text-red">*</span></label>         
                  <div class="col-sm-8"><input type="text" class="form-control" id="link" name="link" placeholder="Paste Link Berita..." value=""></div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                  <label class="col-sm-3 control-label text-right">Deskripsi Berita <span class="text-red">*</span></label>
                  <div class="col-sm-8"><input type="text" class="form-control" id="desc" name="desc" placeholder="Masukkan Judul Berita..." value=""></div>
                  </div>
                </div>

              <div class="modal-footer">
                <button id="nosave" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" id="sumbitButton" onclick="tambah()" class="btn btn-warning btn-mg">Simpan</button>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

                    <script src="https://www.gstatic.com/firebasejs/4.2.0/firebase.js"></script>
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
        
                                  

                                    /* END ADDED THESE LINES */
                                })();
                        </script>
                        <script type="text/javascript">

                            // firebase bucket name
                            // REPLACE WITH THE ONE YOU CREATE
                            // ALSO CHECK STORAGE RULES IN FIREBASE CONSOLE
                            var fbBucketName = 'gambarBerita';
                    
                            // get elements
                            var uploader = document.getElementById('uploader');
                            var fileButton = document.getElementById('fileButton');
                            var submitButton = document.getElementById('submitButton');

                           
                            // listen for file selection
                            fileButton.addEventListener('change', function (e) {
                    
                                // what happened
                                console.log('file upload event', e);
                    
                                // get file
                                var file = e.target.files[0];
                    
                                // create a storage ref
                                var storageRef = firebase.storage().ref(`${fbBucketName}/${file.name}`);
                    
                                // upload file
                                var uploadTask = storageRef.put(file);

                                

                                // The part below is largely copy-pasted from the 'Full Example' section from
                                // https://firebase.google.com/docs/storage/web/upload-files
                    
                                // update progress bar
                                uploadTask.on(firebase.storage.TaskEvent.STATE_CHANGED, // or 'state_changed'
                                    function (snapshot) {
                                        // Get task progress, including the number of bytes uploaded and the total number of bytes to be uploaded
                                        var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                                        console.log('Upload is ' + progress + '% done');
                                        switch (snapshot.state) {
                                            case firebase.storage.TaskState.PAUSED: // or 'paused'
                                                console.log('Upload is paused');
                                                break;
                                            case firebase.storage.TaskState.RUNNING: // or 'running'
                                                console.log('Upload is running');
                                                break;
                                        }
                                    }, function (error) {
                    
                                        // A full list of error codes is available at
                                        // https://firebase.google.com/docs/storage/web/handle-errors
                                        switch (error.code) {
                                            case 'storage/unauthorized':
                                                // User doesn't have permission to access the object
                                                break;
                    
                                            case 'storage/canceled':
                                                // User canceled the upload
                                                break;
                    
                                            case 'storage/unknown':
                                                // Unknown error occurred, inspect error.serverResponse
                                                break;
                                        }
                                    }, function () {
                                        // Upload completed successfully, now we can get the download URL
                                        // save this link somewhere, e.g. put it in an input field
                                        var downloadURL = uploadTask.snapshot.downloadURL;
                                        console.log('downloadURL', downloadURL);

                                    });
                    
                            });
                        </script>