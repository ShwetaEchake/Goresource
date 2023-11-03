@extends('layouts.admin')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <!--   <center>
                <button id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" class="btn btn-danger btn-xs btn-flat">Allow for Notification</button>
            </center>
 -->
            <br>

            <div class="card">
              <!--    <div class="card-warning"> -->
                <div class="card-header">{{ __('NOTIFICATION') }}</div>
  
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
  
                   <form action="{{ route('send.notification') }}" method="POST" enctype="multipart/form-data">
        
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" required="">
                        </div>
                        <div class="form-group">
                            <label>Detail</label>
                            <textarea class="form-control" name="detail" required=""></textarea>
                          </div>
                            <div class="form-group">
                            <label>Icon</label>
                            <input type="file" name="image" class="form-control"  size="60" name="icon">
                        </div><br>

                     
                        <button type="submit" class="btn btn-flat btn-primary">Send Notification</button>
                    </form>
  
                </div>
            </div>
       <!--  </div> -->
    </div>
    </div>
</div>
  <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
<script>
  
    
    var firebaseConfig = {
    apiKey: "AIzaSyCL3IMjybY0b2O0tUsCxvT65VR6HE3hMN4",
  authDomain: "diskoveroo-b74e3.firebaseapp.com",
  projectId: "diskoveroo-b74e3",
  storageBucket: "diskoveroo-b74e3.appspot.com",
  messagingSenderId: "1068646423844",
  appId: "1:1068646423844:web:acbbfb6784efbe0d2da7b1",
  measurementId: "G-B95JJ2QJ69"

  };
      
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
  
    function initFirebaseMessagingRegistration() {
            messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function(token) {
        
                console.log(token);
   
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
  
                $.ajax({
                    url: '{{ route("save-token") }}',
                    type: 'POST',
                    data: {
                        token: token
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        alert('Token saved successfully.');
                    },
                    error: function (err) {
                        console.log('User Chat Token Error'+ err);
                    },
                });
  
            }).catch(function (err) {
                console.log('User Chat Token Error'+ err);
            });
     }  
      
    messaging.onMessage(function(payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(noteTitle, noteOptions);
    });
   
</script>

@endsection