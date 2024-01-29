<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panduan</title>
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
        var database = firebase.database().ref('dashboard');
        let toggle = false
    </script>
</head>

<body style="background: lightgray; height: 50vh;">
    <div class="bg-white p-2 w-100">
        <div class="d-flex align-items-center justify-content-center w-100">
            <h5><a href="/" class="text-dark">Monitoring Server</a></h5>
            <div class="d-flex align-items-center ml-5 mt-2">
                <p id="dashboard"><a href="/dashboard" class="text-dark">Home</a></p>
                <p id="history" class="ml-2"><a href="/history" class="text-dark">History</a></p>
                <p id="guide" style="text-decoration: underline;" class="ml-2"><a href="/guide" class="text-dark">Panduan</a></p>
                <p id="logout" class="ml-2"><a href="/" class="text-danger">Logout</a></p>
            </div>
        </div>
    </div>

    <div class="container d-flex flex-column align-items-center justify-content-center h-100">
        <div class="card border-0 shadow rounded p-3 align-items-center mt-5" style="width: 500px;">
            <h5>Panduan</h5>
            <p class="text-justify">
                Ini merupakan Aplikasi pemantauan Rak Server Yang terintegrasi denga IoT Device.
                Pada IoT Device nya pun terdiri dari beberapa sensor, yaitu:<br />
                - Sensor Suhu<br />
                - Sensor Kelembaban<br />
                - Sensor Api<br />
                - Sensor Asap<br />
                Yang masing-masing nilai datanya di monitoring di Aplikasi.<br />
                Adapun fitur history di aplikasi ini, yang berfungsi untuk melihat data yang
                telah lama pada tanggal tertentu.
            </p>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>

</html>