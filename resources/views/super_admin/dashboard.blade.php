<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js -->
    <style>
        /* Styling untuk top-bar */
        .top-bar {
            background-color: #ffffff;
            padding: 10px 20px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .top-bar img.logo {
            max-width: 50px;
            height: auto;
            margin-right: 10px;
            margin-left: 10px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-left: 10px;
        }

        .search-bar {
            position: relative;
            width: 30%;
        }

        .search-bar input {
            width: 100%;
            padding: 10px 40px 10px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .search-bar .search-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #6c757d;
        }

        /* Styling untuk sidebar dan konten utama */
        .sidebar-and-content {
            display: flex;
            margin-top: 60px;
        }

        .sidebar {
            width: 250px;
            background-color: #fff;
            padding: 20px;
            position: fixed;
            top: 60px;
            left: 0;
            height: calc(100vh - 60px);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: #333;
            text-decoration: none;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color: #007bff;
            color: #fff;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
            background-color: #ffffff;
            margin-left: 250px;
        }

        /* Styling untuk dashboard overview */
        .dashboard-overview {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
}

.dashboard-card {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    background-color: #17a2b8; /* Warna background (ubah sesuai keinginan) */
    color: white; /* Warna teks putih */
    border-radius: 10px; /* Membuat sudut melengkung */
    width: 500px;
    height: 150px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Efek bayangan */
    cursor: pointer; /* Memberikan efek klik */
    text-align: center;
    transition: transform 0.3s ease, background-color 0.3s ease;
}

.dashboard-card:hover {
    transform: scale(1.05); /* Memberikan efek zoom saat hover */
    background-color: #138496; /* Warna background saat hover */
}
 
.dashboard-card .display-5 {
    font-size: 2.5rem;
    font-weight: bold;
    margin: 0;
}

.dashboard-card h5 {
    font-size: 1.2rem;
    margin: 10px 0 0;
}

        .dashboard-card:nth-child(1) {
            background-color: #939185;
        }

        .dashboard-card:nth-child(2) {
            background-color: #cf1345;
        }

        .modal-dialog.modal-lg {
            max-width: 80%;
        }
        .list-group-item {
    list-style: none; /* Menghapus default */
    padding-left: 20px; /* Tambah jarak agar gambar tidak terlalu mepet teks */
    background-image: url('path-to-your-icon.png'); /* Masukkan URL gambar */
    background-repeat: no-repeat;
    background-position: left center;
}



    </style>
</head>

<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="d-flex align-items-center">
            <i class="fas fa-bars menu-icon" onclick="toggleSidebar()"></i>
            <img src="{{ asset('img/lapas.png') }}" alt="Logo" class="logo">
            <span class="title">JurnalLasgar</span>
        </div>
        <div class="search-bar">
            <input type="text" class="form-control" id="searchInput" placeholder="Search">
            <i class="fas fa-search search-icon"></i>
        </div>
    </div>

    <!-- Sidebar dan Konten -->
    <div class="sidebar-and-content">
        <div class="sidebar" id="sidebar">
            <a href="{{ route('super_admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="{{route('super_admin.users')}}"><i class="fas fa-users"></i> Users</a>
            <div class="dropdown">
                            <a href="#" id="formsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-folder-open"></i> Forms
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="formsDropdown">
                                <li><a href="{{ route('agenda.index') }}"><i class="fas fa-calendar-alt"></i> Agenda</a></li>
                                <li><a href="{{ route('atensi.index') }}"><i class="fas fa-list"></i> Atensi</a></li>
                                <li><a href="{{ route('documents.index') }}"><i class="fas fa-list"></i> Surat</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a href="#"><i class="fas fa-plus"></i> Another Form</a></li>
                            </ul>
                        </div>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="container">
                <!-- Dashboard Overview -->
                <div class="dashboard-overview">
                    <div class="dashboard-card" data-bs-toggle="modal" data-bs-target="#agendaModal">
                        <div>
                            <span class="display-5">{{ $agendas->count() }}</span>
                            <h5>Total Agendas</h5>
                        </div>
                    </div>
                    <div class="dashboard-card" data-bs-toggle="modal" data-bs-target="#atensiModal">
                        <div>
                            <span class="display-5">{{ $atensi->count() }}</span>
                            <h5>Total Atensi</h5>
                        </div>
                    </div>
                </div>

                <!-- Grafik Per Bulan -->
                <div class="row">
                    <div class="col-md-6">
                        <canvas id="agendaChart"></canvas>
                    </div>
                    <div class="col-md-6">
                        <canvas id="atensiChart"></canvas>
                    </div>
                </div>

            </div>
        </div>
    </div>

   <!-- Modal for Agendas -->
<div class="modal fade" id="agendaModal" tabindex="-1" aria-labelledby="agendaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agendaModalLabel">Agendas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    @foreach($agendas as $agenda)
                        <li class="list-group-item">
                            <a href="{{ route('super_admin.show', ['id' => $agenda->id, 'type' => 'agenda']) }}">
                                {{ $agenda->acara_kegiatan }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>


   <!-- Modal for Atensi -->
<div class="modal fade" id="atensiModal" tabindex="-1" aria-labelledby="atensiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="atensiModalLabel">Atensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    @foreach($atensi as $item)
                        <li class="list-group-item">
                            <a href="{{ route('super_admin.show', ['id' => $item->id, 'type' => 'atensi']) }}">
                                {{ $item->kegiatan }}
                            </a>
                        </li>
                        
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>


    <script>
        const agendaChart = new Chart(document.getElementById('agendaChart'), {
            type: 'line',
            data: {
                labels: @json($agendaMonths),
                datasets: [{
                    label: 'Agendas per Month',
                    data: @json($agendaCounts),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' }
                }
            }
        });

        const atensiChart = new Chart(document.getElementById('atensiChart'), {
            type: 'line',
            data: {
                labels: @json($atensiMonths),
                datasets: [{
                    label: 'Atensi per Month',
                    data: @json($atensiCounts),
                    borderColor: 'rgba(255, 99, 132, 1)',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>
