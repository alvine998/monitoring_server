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
        var database = firebase.database().ref('data');
        let toggle = false
    </script>
    <style>
        boxx {
            background-color: white;
        }

        boxx:hover {
            background-color: gray;
        }
    </style>
</head>

<body style="background: lightgray">
    <div class="bg-white p-2 w-100">
        <div class="d-flex align-items-center justify-content-center w-100">
            <h5><a href="/" class="text-dark">Monitoring Server</a></h5>
            <div class="d-flex align-items-center ml-5 mt-2">
                <p id="dashboard"><a href="/dashboard" class="text-dark">Home</a></p>
                <p id="history" style="text-decoration: underline;" class="ml-2"><a href="/history" class="text-dark">History</a></p>
                <p id="guide" class="ml-2"><a href="/guide" class="text-dark">Panduan</a></p>
                <p id="logout" class="ml-2"><a href="/" class="text-danger">Logout</a></p>
            </div>
        </div>
    </div>
    <div class="container d-flex flex-column align-items-center justify-content-center w-100" style="margin-top: 10px;">
        <input type="date" name="date" id="date" class="form-control" style="width: 500px;" />
        <div class="w-full mt-2" style="height: 80vh; overflow-y: auto; ">
            <div id="dataContainer" class="card border-0 shadow rounded p-2 align-items-center" style="width: 600px;">
            </div>
            <script>
                const container = document.getElementById("dataContainer");
                let date = "";
                container.innerHTML = '';
                let datas = [];
                const datess = document.getElementById("date").addEventListener('input', function() {
                    date = this.value;
                });
                database.on('value', (snapshot) => {
                    const data = snapshot.val();
                    datas = Object.entries(data).map(([key, value]) => ({
                        date: key,
                        ...value
                    }))
                    datas.filter(val => val?.date?.substring(0,9) === "2024-1-12").forEach(value => {
                        console.log(value?.date?.substring(0,9) === "2024-1-12");
                        const listItem = document.createElement('div');
                        listItem.classList.add = "w-100"
                        listItem.innerHTML = `
                            <div class="d-flex flex-row boxx" style="margin-left:-30px;">
                                <img src="https://static.vecteezy.com/system/resources/thumbnails/022/418/264/small/3d-isometric-web-hosting-server-transparent-background-free-png.png" alt="server-img" />
                                <div>
                                    <p>${value?.date}</p>
                                    <p style="color:#A643DF;">Suhu : <strong class="text-dark">${value?.result?.split("|")[0]}</strong></p>
                                    <p style="color:#A643DF;">Kelembaban <strong class="text-dark">${value?.result?.split("|")[1]}</strong></p>
                                    <p style="color:#A643DF;">Status Api <strong class="text-dark">${value?.result?.split("|")[2] == 0 ? "Ada Api" : "Tidak Ada Api"}</strong> </p>
                                    <p style="color:#A643DF;">Status Asap <strong class="text-dark">${value?.result?.split("|")[3] > 120 ? "Ada Asap" : "Tidak Ada Asap"}</strong> </p>
                                    <hr style="width:100%;" />
                                </div>
                            </div>
                        `
                        container.appendChild(listItem)
                    })
                })
            </script>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>

</html>