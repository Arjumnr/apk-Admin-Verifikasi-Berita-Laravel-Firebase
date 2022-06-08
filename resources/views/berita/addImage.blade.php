
            
                <div class="form-group">
                    <div class="row">
                    <label class="col-sm-3 control-label text-right">Gambar Berita <span class="text-red">*</span></label>         
                    <div class="col-sm-8">
                        <input type="file" class="form-control" name="image" value="upload" accept=".jpg" onchange="loadFile(event)" id="fileButton">
                        <img id="output/"> 
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

                                // var loadFile = function(event) {
                                //     var output = document.getElementById('output');
                                //     output.src = URL.createObjectURL(event.target.files[0]);
                                //     console.log(output.src);
                                //     output.onload = function() {
                                //     URL.revokeObjectURL(output.src) // free memory
                                //     }
                                // };
                                // var storage = firebase.storage();
                                // var pathReference = storage.ref('Students/defT5uT7SDu9K5RFtIdl.png');
                                // console.log(pathReference);
                                // pathReference.getDownloadURL().then(function(url) {
                                // console.log(url);
                                // })
                    
                                // The part below is largely copy-pasted from the 'Full Example' section from
                                // https://firebase.google.com/docs/storage/web/upload-files
                    
                                // update progress bar
                                uploadTask.on(firebase.storage.TaskEvent.STATE_CHANGED, // or 'state_changed'
                                    function (snapshot) {
                                        // Get task progress, including the number of bytes uploaded and the total number of bytes to be uploaded
                                        var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                                        uploader.value = progress;
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