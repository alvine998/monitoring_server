<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://www.gstatic.com/firebasejs/live/3.0/firebase.js"></script>
    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyABGqX5EiG2q1qenVVEPniztUBYi6nOsv4",
            authDomain: "monitoringserver-f0680.firebaseapp.com",
            databaseURL: "https://monitoringserver-f0680-default-rtdb.firebaseio.com",
            projectId: "monitoringserver-f0680",
            storageBucket: "monitoringserver-f0680.appspot.com",
            messagingSenderId: "738234019925",
            appId: "1:738234019925:web:26abcf67ee3a1a757ae4dc"
        };

        firebase.initializeApp(firebaseConfig);

        function doLoginSignUp(strg_mode) {
            if ($('#login_button').text()) {
                firebase.auth().signInWithEmailAndPassword($('#email').val(), $('#password').val()).then(function(result) {
                    console.log('result: ', result);
                    alert("Berhasil Login");
                    window.location.href = "{{route('dashboard.index')}}"
                }).catch(function(err) {
                    alert(err.message);
                })
            }
        }
    </script>
</head>

<body style="background: lightgray">

    <div class="container align-items-center d-flex justify-content-center" style="height: 100vh;">
        <div class="w-50">
            <div class="card border-0 shadow rounded">
                <form onsubmit="doLoginSignUp()">
                    <div class="card-body d-flex justify-content-center flex-column align-items-center">
                        <div class="d-flex flex-row align-items-center">
                            <img src="https://static.vecteezy.com/system/resources/thumbnails/022/418/264/small/3d-isometric-web-hosting-server-transparent-background-free-png.png" alt="server-img" style="margin-left: -50px;" />
                            <div>
                                <h2>LOGIN</h2>
                                <h2>Monitoring</h2>
                                <h2>Server</h2>
                            </div>
                        </div>
                        <div class="mb-3 w-75 mt-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="name@example.com">
                        </div>
                        <div class="mb-3 w-75">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="********">
                        </div>
                        <button type="submit" id="login_button" class="btn btn-md btn-success w-75 mb-3">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>

</html>