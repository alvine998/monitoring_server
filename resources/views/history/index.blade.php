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
        var database = firebase.database().ref('data');
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
    <div style="background: lightgray; height: 100vh; overflow-y: hidden;" class="d-flex flex-row">
        <div style="width: 250px; background-color: #1F3B46; padding-top: 20px;">
            <div class="d-flex flex-column justify-content-center w-100">
                <h5><a href="" class="text-white mx-auto pl-4 brand">Monitoring Server</a></h5>
                <div class="d-flex flex-column mt-2">
                    <a href="/dashboard" class="guide-icon"><i class="fa fa-home"></i> Home</a>
                    <a href="/history?status=0" class="active"><i class="fa fa-history"></i> History</a>
                    <a href="/guide" class="guide-icon"><i class="fa fa-circle-info"></i> Panduan</a>
                    <a href="/" class="logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                </div>
            </div>
        </div>
        <div class="bg-white h-100 w-100">
            <div class="breadcrumb">
                <h2>History</h2>
            </div>
            <div style="padding: 10px 100px 10px 100px;">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" id="all" href="?status=0">Semua Status</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="fire" href="?status=1">Ada Asap / Api</a>
                    </li>
                </ul>
                <div class="mt-3">
                    <div class="d-flex flex-row" style="gap: 10px;">
                        <input type="date" name="date" id="date" class="form-control w-full" onchange="handleDate(this)" />
                        <select id="filter" class="form-control" onchange="handleFilter(this)">
                            <option value="">Semua Status</option>
                            <option value="fire">Ada Api</option>
                            <option value="smoke">Ada Asap</option>
                        </select>
                    </div>
                    <p class="fw-bold" id="total_data"></p>
                    <div style="height: 400px; overflow-y: auto;">
                        <table class="table stripped responsive mt-2">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Suhu</th>
                                    <th>Kelembaban</th>
                                    <th>Status Api</th>
                                    <th>Status Asap</th>
                                </tr>
                            </thead>
                            <tbody id="dataContainer">

                            </tbody>
                        </table>
                    </div>
                </div>

                <script>
                    const container = document.getElementById("dataContainer");
                    container.innerHTML = '';
                    let datas = [];
                    let date = "";
                    let filter = "";
                    const tabs = document.getElementById("all")
                    const tabs2 = document.getElementById("fire")
                    const queryString = window.location.search;
                    const params = new URLSearchParams(queryString);
                    const paramValue = params.get('status');

                    if (paramValue == 0) {
                        tabs.classList.add('active')
                        document.getElementById('filter').classList.add('d-none')
                        document.getElementById('date').classList.remove('w-full')
                        document.getElementById('date').classList.add('w-auto')
                    } else {
                        tabs2.classList.add('active')
                    }

                    function handleDate() {
                        container.innerHTML = '';
                        date = $('#date').val();
                        filter = $('#filter').val();
                        database.on('value', (snapshot) => {
                            const data = snapshot.val();
                            datas = Object.entries(data).map(([key, value]) => ({
                                date: key,
                                ...value
                            }))
                            if (paramValue == 0) {
                                if (date !== "") {
                                    const totaldata = document.getElementById("total_data")
                                    totaldata.innerText = "Total Data : " + datas.filter(val => moment(val?.date).format("YYYY-MM-DD") == moment(date).format("YYYY-MM-DD")).length
                                    totaldata.classList.add("m-2")
                                    datas.filter(val => moment(val?.date).format("YYYY-MM-DD") == moment(date).format("YYYY-MM-DD"))?.forEach(value => {
                                        const listItem = document.createElement('tr');
                                        listItem.innerHTML = `
                                            <td>${value?.date}</td>
                                            <td>${value?.result?.split("|")[0]} °C</td>
                                            <td>${value?.result?.split("|")[1]}</td>
                                            <td>${value?.result?.split("|")[2] == 0 ? "Ada Api" : "Tidak Ada Api"}</td>
                                            <td>${value?.result?.split("|")[3] > 120 ? "Ada Asap" : "Tidak Ada Asap"}</td>
                                        `
                                        container.appendChild(listItem)
                                    })
                                } else {
                                    const totaldata = document.getElementById("total_data")
                                    totaldata.innerText = "Total Data : " + datas.length
                                    totaldata.classList.add("m-2")
                                    datas?.forEach(value => {
                                        const listItem = document.createElement('tr');
                                        listItem.innerHTML = `
                                            <td>${value?.date}</td>
                                            <td>${value?.result?.split("|")[0]} °C</td>
                                            <td>${value?.result?.split("|")[1]}</td>
                                            <td>${value?.result?.split("|")[2] == 0 ? "Ada Api" : "Tidak Ada Api"}</td>
                                            <td>${value?.result?.split("|")[3] > 120 ? "Ada Asap" : "Tidak Ada Asap"}</td>
                                        `
                                        container.appendChild(listItem)
                                    })
                                }
                            }

                            if (paramValue == 1) {
                                // handleFilter()
                                if (date !== "") {
                                    const totaldata = document.getElementById("total_data")
                                    totaldata.innerText = "Total Data : " + datas.filter(val => (val.result?.split("|")[3] > 120) || (val.result?.split("|")[2] == 0)).filter(val => moment(val?.date).format("YYYY-MM-DD") == moment(date).format("YYYY-MM-DD")).length
                                    totaldata.classList.add("m-2")

                                    datas.filter(val => filter == "fire" ? (val.result?.split("|")[2] == 0) : filter == "smoke" ? (val.result?.split("|")[3] > 120) : ((val.result?.split("|")[3] > 120) || (val.result?.split("|")[2] == 0))).filter(val => moment(val?.date).format("YYYY-MM-DD") == moment(date).format("YYYY-MM-DD"))?.forEach(value => {
                                        const listItem = document.createElement('tr');
                                        listItem.innerHTML = `
                                            <td>${value?.date}</td>
                                            <td>${value?.result?.split("|")[0]} °C</td>
                                            <td>${value?.result?.split("|")[1]}</td>
                                            <td>${value?.result?.split("|")[2] == 0 ? "Ada Api" : "Tidak Ada Api"}</td>
                                            <td>${value?.result?.split("|")[3] > 120 ? "Ada Asap" : "Tidak Ada Asap"}</td>
                                        `
                                        container.appendChild(listItem)
                                    })
                                } else {
                                    const totaldata = document.getElementById("total_data")
                                    totaldata.innerText = "Total Data : " + datas.filter(val => (val.result?.split("|")[3] > 120) || (val.result?.split("|")[2] == 0)).length
                                    totaldata.classList.add("m-2")

                                    datas.filter(val => filter == "fire" ? (val.result?.split("|")[2] == 0) : filter == "smoke" ? (val.result?.split("|")[3] > 120) : ((val.result?.split("|")[3] > 120) || (val.result?.split("|")[2] == 0)))?.forEach(value => {
                                        const listItem = document.createElement('tr');
                                        listItem.innerHTML = `
                                            <td>${value?.date}</td>
                                            <td>${value?.result?.split("|")[0]} °C</td>
                                            <td>${value?.result?.split("|")[1]}</td>
                                            <td>${value?.result?.split("|")[2] == 0 ? "Ada Api" : "Tidak Ada Api"}</td>
                                            <td>${value?.result?.split("|")[3] > 120 ? "Ada Asap" : "Tidak Ada Asap"}</td>
                                        `
                                        container.appendChild(listItem)
                                    })
                                }
                            }

                        })
                    }


                    function handleFilter() {
                        container.innerHTML = '';
                        filter = $('#filter').val()
                        date = $('#date').val();
                        if (filter !== "" && date !== "") {
                            const totaldata = document.getElementById("total_data")
                            totaldata.innerText = "Total Data : " + datas.filter(val => (val.result?.split("|")[3] > 120) || (val.result?.split("|")[2] == 0)).filter(val => moment(val?.date).format("YYYY-MM-DD") == moment(date).format("YYYY-MM-DD")).length
                            totaldata.classList.add("m-2")

                            console.log(datas.filter(val => filter == "fire" ? (val.result?.split("|")[2] == 0) : filter == "smoke" ? (val.result?.split("|")[3] > 120) : ((val.result?.split("|")[3] > 120) || (val.result?.split("|")[2] == 0))), 'ssss');

                            datas.filter(val => filter == "fire" ? (val.result?.split("|")[2] == 0) : filter == "smoke" ? (val.result?.split("|")[3] > 120) : ((val.result?.split("|")[3] > 120) || (val.result?.split("|")[2] == 0))).filter(val => moment(val?.date).format("YYYY-MM-DD") == moment(date).format("YYYY-MM-DD"))?.forEach(value => {
                                const listItem = document.createElement('tr');
                                listItem.innerHTML = `
                                            <td>${value?.date}</td>
                                            <td>${value?.result?.split("|")[0]} °C</td>
                                            <td>${value?.result?.split("|")[1]}</td>
                                            <td>${value?.result?.split("|")[2] == 0 ? "Ada Api" : "Tidak Ada Api"}</td>
                                            <td>${value?.result?.split("|")[3] > 120 ? "Ada Asap" : "Tidak Ada Asap"}</td>
                                        `
                                container.appendChild(listItem)
                            })
                        } else if (filter !== "") {
                            const totaldata = document.getElementById("total_data")
                            totaldata.innerText = "Total Data : " + datas.filter(val => filter == "fire" ? (val.result?.split("|")[2] == 0) : filter == "smoke" ? (val.result?.split("|")[3] > 120) : ((val.result?.split("|")[3] > 120) || (val.result?.split("|")[2] == 0))).length
                            totaldata.classList.add("m-2")

                            console.log(datas.filter(val => filter == "fire" ? (val.result?.split("|")[2] == 0) : filter == "smoke" ? (val.result?.split("|")[3] > 120) : ((val.result?.split("|")[3] > 120) || (val.result?.split("|")[2] == 0))), 'cdcd');

                            datas.filter(val => filter == "fire" ? (val.result?.split("|")[2] == 0) : filter == "smoke" ? (val.result?.split("|")[3] > 120) : ((val.result?.split("|")[3] > 120) || (val.result?.split("|")[2] == 0))).forEach(value => {
                                const listItem = document.createElement('tr');
                                console.log(value, 'sll');
                                listItem.innerHTML = `
                                            <td>${value?.date}</td>
                                            <td>${value?.result?.split("|")[0]} °C</td>
                                            <td>${value?.result?.split("|")[1]}</td>
                                            <td>${value?.result?.split("|")[2] == 0 ? "Ada Api" : "Tidak Ada Api"}</td>
                                            <td>${value?.result?.split("|")[3] > 120 ? "Ada Asap" : "Tidak Ada Asap"}</td>
                                        `
                                container.appendChild(listItem)
                            })
                        } else {
                            const totaldata = document.getElementById("total_data")
                            totaldata.innerText = "Total Data : " + datas.filter(val => (val.result?.split("|")[3] > 120) || (val.result?.split("|")[2] == 0)).length
                            totaldata.classList.add("m-2")

                            datas.filter(val => filter == "fire" ? (val.result?.split("|")[2] == 0) : filter == "smoke" ? (val.result?.split("|")[3] > 120) : ((val.result?.split("|")[3] > 120) || (val.result?.split("|")[2] == 0)))?.forEach(value => {
                                const listItem = document.createElement('tr');
                                listItem.innerHTML = `
                                            <td>${value?.date}</td>
                                            <td>${value?.result?.split("|")[0]} °C</td>
                                            <td>${value?.result?.split("|")[1]}</td>
                                            <td>${value?.result?.split("|")[2] == 0 ? "Ada Api" : "Tidak Ada Api"}</td>
                                            <td>${value?.result?.split("|")[3] > 120 ? "Ada Asap" : "Tidak Ada Asap"}</td>
                                        `
                                container.appendChild(listItem)
                            })
                        }
                    }

                    if (date == "" && paramValue == 0) {
                        database.on('value', (snapshot) => {
                            const data = snapshot.val();
                            datas = Object.entries(data).map(([key, value]) => ({
                                date: key,
                                ...value
                            }))
                            const totaldata = document.getElementById("total_data")
                            totaldata.innerText = "Total Data : " + datas.length
                            totaldata.classList.add("m-2")

                            datas.forEach(value => {
                                const listItem = document.createElement('tr');
                                listItem.innerHTML = `
                            <td>${value?.date}</td>
                            <td>${value?.result?.split("|")[0]} °C</td>
                            <td>${value?.result?.split("|")[1]}</td>
                            <td>${value?.result?.split("|")[2] == 0 ? "Ada Api" : "Tidak Ada Api"}</td>
                            <td>${value?.result?.split("|")[3] > 120 ? "Ada Asap" : "Tidak Ada Asap"}</td>
                        `
                                container.appendChild(listItem)
                            })
                        })
                    }

                    if (date == "" && filter == "" && paramValue == 1) {
                        database.on('value', (snapshot) => {
                            const data = snapshot.val();
                            datas = Object.entries(data).map(([key, value]) => ({
                                date: key,
                                ...value
                            }))
                            const totaldata = document.getElementById("total_data")
                            totaldata.innerText = "Total Data : " + datas.filter(val => (val.result?.split("|")[3] > 120) || (val.result?.split("|")[2] == 0)).length
                            totaldata.classList.add("m-2")
                            datas.filter(val => (val.result?.split("|")[3] > 120) || (val.result?.split("|")[2] == 0)).forEach(value => {
                                const listItem = document.createElement('tr');
                                listItem.innerHTML = `
                            <td>${value?.date}</td>
                            <td>${value?.result?.split("|")[0]} °C</td>
                            <td>${value?.result?.split("|")[1]}</td>
                            <td>${value?.result?.split("|")[2] == 0 ? "Ada Api" : "Tidak Ada Api"}</td>
                            <td>${value?.result?.split("|")[3] > 120 ? "Ada Asap" : "Tidak Ada Asap"}</td>
                        `
                                container.appendChild(listItem)
                            })
                        })
                    }
                </script>
            </div>

        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://momentjs.com/downloads/moment.js"></script>
</body>

</html>