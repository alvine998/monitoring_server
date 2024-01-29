<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
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
                <p id="dashboard" style="text-decoration: underline;"><a href="/dashboard" class="text-dark">Home</a></p>
                <p id="history" class="ml-2"><a href="/history" class="text-dark">History</a></p>
                <p id="guide" class="ml-2"><a href="/guide" class="text-dark">Panduan</a></p>
                <p id="logout" class="ml-2"><a href="/" class="text-danger">Logout</a></p>
            </div>
        </div>
    </div>
    <div class="container d-flex flex-column align-items-center justify-content-center h-100">
        <div class="m-5 float-left">
            <button class="btn btn-secondary" type="button" id="toggleButton">
                Offline
            </button>
            <input type="hidden" name="toggle">
            <script>
                function toggleOn(button) {
                    button.addEventListener('click', function() {
                        toggle = !toggle;
                        if (toggle) {
                            button.textContent = 'Online';
                            button.classList.remove('btn-secondary')
                            button.classList.add('btn-success')
                            database.on('value', (snapshot) => {
                                const data = snapshot.val();
                                document.getElementById("kelembaban").innerHTML = data.kelembaban;
                                document.getElementById("status_api").innerHTML = data.status_api == 0 ? "Ada Api" : "Tidak Ada Api";
                                document.getElementById("status_asap").innerHTML = data.status_asap > 120 ? "Ada Asap" : "Tidak Ada Asap";
                                document.getElementById("suhu").innerHTML = data.suhu;
                            })
                        } else {
                            button.textContent = 'Offline';
                            button.classList.remove('btn-success')
                            button.classList.add('btn-secondary')
                            document.getElementById("kelembaban").innerHTML = "-";
                            document.getElementById("status_api").innerHTML = "-";
                            document.getElementById("status_asap").innerHTML = "-";
                            document.getElementById("suhu").innerHTML = "-";
                        }
                    })
                }

                const toggleButton = document.getElementById('toggleButton');
                toggleOn(toggleButton);
            </script>
        </div>
        <div class="w-full d-flex">
            <div class="card border-0 shadow rounded p-2 align-items-center" style="width: 200px;">
                <h2 style="color: #A643DF;">Suhu</h2>
                <h2 id="suhu" style="color: #A643DF;">-</h2>
            </div>
            <div class="card border-0 ml-2 shadow rounded p-2 align-items-center" style="width: 200px;">
                <h2 style="color: #A643DF;">Kelembaban</h2>
                <h2 id="kelembaban" style="color: #A643DF;">-</h2>
            </div>
        </div>
        <div class="w-full d-flex mt-2">
            <div class="card border-0 shadow rounded p-2 align-items-center" style="width: 200px;">
                <h2 style="color: #A643DF;">Api</h2>
                <h4 id="status_api" style="color: #A643DF; text-align: center;">-</h4>
            </div>
            <div class="card border-0 ml-2 shadow rounded p-2 align-items-center" style="width: 200px;">
                <h2 style="color: #A643DF;">Asap</h2>
                <h4 id="status_asap" style="color: #A643DF; text-align: center">-</h4>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>

</html>