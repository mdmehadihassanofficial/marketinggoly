<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
<script>
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyCWIYecsREqPAlToy8KDuHIg8lqaPTxtnA",
  authDomain: "goly-final-project.firebaseapp.com",
  projectId: "goly-final-project",
  storageBucket: "goly-final-project.firebasestorage.app",
  messagingSenderId: "167423088874",
  appId: "1:167423088874:web:6d8865d9481fc05cb71f93",
  measurementId: "G-VE4VGRSKEW"
};
firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();
function startFCM25() {
    messaging
        .requestPermission()
        .then(function () {
            return messaging.getToken()
        })
        .then(function (response) {
         // console.log(response);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route("user.deviceTokenStore")}}',
                type: 'POST',
                data: {
                    token: response
                },
                dataType: 'JSON',
                success:function (data) {
                    // console.log(data);
                    // console.log('///////////////////');
                    // console.log(data.msg.message);
                    // console.log('////////////////');
                    // console.log(data.msg.completed);
                    if (data.msg.message == "success") {
                        Swal.fire({
                            text: data.msg.completed,
                            icon: "success",
                            buttonsStyling:!1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton:
                                    "btn btn-primary",
                            },
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            timer: 2000,
                        });
                       // alert(data.msg.completed);
                    }else{
                         Swal.fire({
                            text: data.msg.error,
                            icon: "error",
                            buttonsStyling: !1,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton:
                                    "btn btn-primary",
                            },
                        });
                    }
                    //alert('Token stored.');
                },
                error:function (error) {
                    //alert(error);
                },
            });
        }).catch(function (error) {
            alert(error);
        });
}
messaging.onMessage(function (payload) {
    const title = payload.notification.title;
    console.log(payload);
    const options = {
        body: payload.notification.body,
        icon: payload.notification.icon,
    };
    new Notification(title, options);
});
</script>