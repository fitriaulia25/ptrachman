<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   
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

        .sidebar img.logo,
.img-thumbnail {
    object-fit: cover;
    width: 50px; /* Lebar foto */
    height: 50px; /* Tinggi foto */
    display: block;
    margin: auto; /* Memusatkan gambar secara horizontal */
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
        background-color: #007bff; /* Warna background biru */
        color: white; /* Warna teks putih */
        border-radius: 10px; /* Membuat sudut kotak melengkung */
        width: 1000px;
        height: 150px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        text-align: center;
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
    background-color: #B6C7AA; /* Hijau pastel */
}

.dashboard-card:nth-child(2) {
    background-color: #F05A7E; /* Merah terang */
}

.dashboard-card:nth-child(3) {
    background-color: #B6C7AA; /* Hijau pastel */
}

.dashboard-card:nth-child(4) {
    background-color: #F05A7E; /* Merah terang */
}

        /* Styling tabel users */
        .user-table-section {
            margin-top: 20px;
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
    <a href="#" class="dropdown-toggle" id="formsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-folder-open"></i> Forms
    </a>
    <ul class="dropdown-menu" aria-labelledby="formsDropdown">
        <li><a class="dropdown-item" href="{{ route('agenda.index') }}"><i class="fas fa-calendar-alt"></i> Agenda</a></li>
        <li><a class="dropdown-item" href="{{ route('atensi.index') }}"><i class="fas fa-list"></i> Atensi</a></li>
        <li><a class="dropdown-item" href="{{ route('documents.index') }}"><i class="fas fa-list"></i> Surat</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#"><i class="fas fa-plus"></i> Another Form</a></li>
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
                @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
                <div class="dashboard-overview">

                    <div class="dashboard-card">
                        <div>
                            <span class="display-5">{{ $users->count() }}</span>
                            <h5>Total Users</h5>
                        </div>
                    </div>
                </div>

                <!-- Users Table -->
                <div class="user-table-section">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>Users</h4>
                        <button class="btn btn-primary" onclick="window.location='{{ route('register') }}'">Create User</button>

                    </div>
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Access</th>                    
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody">
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
    <div>
        @if($user->photo)
            <img src="{{ asset('storage/' . $user->photo) }}" 
                 alt="Profile Photo" 
                 class="img-thumbnail">
        @else
        <svg xmlns="http://www.w3.org/2000/svg" 
                     width="50" 
                     height="50" 
                     fill="currentColor" 
                     class="bi bi-person-fill img-thumbnail" 
                     viewBox="0 0 16 16" 
                     style="display: block; margin: auto;">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                </svg>
        @endif
    </div>
</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
            <td>
                <form action="{{ route('update.access', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-check form-switch">
                        <input 
                            class="form-check-input" 
                            type="checkbox" 
                            id="accessSwitch{{ $user->id }}" 
                            name="has_access" 
                            onchange="this.form.submit()"
                            {{ $user->has_access ? 'checked' : '' }}>
                        <label class="form-check-label" for="accessSwitch{{ $user->id }}">
                            {{ $user->has_access ? 'Enabled' : 'Disabled' }}
                        </label>
                    </div>
                </form>
            </td>

                                <td>
                                <a href="{{ route('superadmin.profile.edit', $user->id) }}" ><i class="fas fa-edit"></i></a>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();">
    <i class="fas fa-trash"></i>
</a>

<form id="delete-form-{{ $user->id }}" action="{{ route('superadmin.profile.delete', $user->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>