<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <style>
        a {
            text-decoration: none;
        }

        .guide-icon {
            color: gray;
            margin-top: 10px;
            padding: 5px;
            transition: all;
            transition-duration: 0.2s;
        }

        .guide-icon:hover {
            background-color: gray;
            padding: 5px;
            color: white;
            text-decoration: none;
            transition: all;
            transition-duration: 0.2s;
        }

        .logout {
            color: red;
            margin-top: 10px;
            padding: 5px;
            transition: all;
            transition-duration: 0.2s;
        }

        .logout:hover {
            background-color: red;
            padding: 5px;
            color: white;
            text-decoration: none;
            transition: all;
            transition-duration: 0.2s;
        }

        .active {
            background-color: gray;
            padding: 5px;
            color: white;
            text-decoration: none;
            margin-top: 10px;
        }

        .active:hover {
            text-decoration: none;
            color: white;
        }

        .brand:hover {
            text-decoration: none;
            color: white;
        }
    </style>
</head>

<body>
    <div style="background: lightgray; height: 100vh;" class="d-flex flex-row">
        <div style="width: 250px; background-color: #1F3B46; padding-top: 20px;">
            <div class="d-flex flex-column justify-content-center w-100">
                <h5><a href="" class="text-white mx-auto pl-4 brand">Monitoring Server</a></h5>
                <div class="d-flex flex-column mt-2">
                    <a href="/dashboard" class="guide-icon"><i class="fa fa-home"></i> Home</a>
                    <a href="/history" class="guide-icon"><i class="fa fa-history"></i> History</a>
                    <a href="/guide" class="active"><i class="fa fa-circle-info"></i> Panduan</a>
                    <a href="/" class="logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </div>
            </div>
        </div>
        <div class="bg-white h-100 w-100">
            <div class="breadcrumb">
                <h2>Panduan</h2>
            </div>
            <div class="d-flex justify-content-center align-items-center">
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

        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>

</html>