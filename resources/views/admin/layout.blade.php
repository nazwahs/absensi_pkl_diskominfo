<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Siprala Admin - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <style>
        :root {
            --yankees-blue: #0F1A2B;
            --teal-blue: #52677D;      
            --pewter-blue: #1C2E4A;   
            --pastel-blue: #BDC4D4; 
            --columbia-blue: #D1CFC9;  
            --text-dark: #1C2E4A;     
            --white: #ffffff;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--yankees-blue);
            overflow-x: hidden;
        }
        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background: var(--teal-blue);
            z-index: 1000;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }
        
        .sidebar-header {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .logo-container {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(255, 255, 255, 0.15);
        }
        
        .logo-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        
        .sidebar-header h3 {
            color: var(--pastel-blue);
            font-weight: 700;
            font-size: 1.3rem;
            margin: 0;
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 12px 20px;
            margin: 5px 10px;
            border-radius: 8px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }
        
        .nav-link:hover, .nav-link.active {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.18);
            text-decoration: none;
        }
        
        .nav-link i {
            width: 25px;
            font-size: 1.2rem;
            margin-right: 10px;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s;
        }
        
        .navbar-top {
            background-color: var(--columbia-blue);
            border-left: 5px solid var(--teal-blue);
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .page-title h2 {
            color: var(--text-dark);
            font-weight: 600;
            margin: 0;
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            border: 2px solid var(--teal-blue);
        }
        
        .stats-card {
            background-color: var(--columbia-blue);
            border-radius: 10px;        
            padding: 6px;          
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s;
            border-top: 3px solid;    
            margin-bottom: 6px;         
        }

        
        .stats-card:hover {
            transform: translateY(-5px);
        }
        
        .stats-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin-bottom: 15px;
        }
        
        .card-hadir { border-top-color: #3a6e3c; }
        .card-izin { border-top-color: #a7810f; }
        .card-sakit { border-top-color: #a05314; }
        .card-total { border-top-color: var(--teal-blue); }
        
        .icon-hadir { background-color: rgba(40, 167, 69, 0.1); color: #2e773f; }
        .icon-izin { background-color: rgba(255, 193, 7, 0.1); color: #c4950a; }
        .icon-sakit { background-color: rgba(253, 126, 20, 0.1); color: #ae5c18; }
        .icon-total { background-color: rgba(0, 123, 255, 0.1); color: var(--teal-blue); }
        
        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--teks-dark);
        }
        
        .stats-label {
            color: #5f6c7a;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .card {
            background-color: var(--columbia-blue);
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 6px rgba(255, 255, 255, 0.8);
        }
        
        .card-header {
            background-color: var(--pastel-blue);
            color: var(--teks-dark);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 15px 20px;
            border-radius: 12px 12px 0 0 !important;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card-header h5 {
            margin: 0;
            font-weight: 600;
            color: var(--text-dark);
        }
        
        .dataTables_wrapper {
            padding: 0;
        }
        
        .dataTables_length,
        .dataTables_filter {
            display: none !important;
        }
        
        .dataTables_paginate {
            margin-top: 15px !important;
            float: none !important;
            text-align: center !important;
        }
        
        .table th {
            border-top: none;
            font-weight: 600;
            color: var(--text-dark);
            background-color: var(--pastel-blue);
        }
        
        .badge-status {
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.8rem;
        }
        
        .badge-hadir { background-color: #d4edda; color: #155724; }
        .badge-izin { background-color: #fff3cd; color: #856404; }
        .badge-sakit { background-color: #ffe5d0; color: #fd7e14; }
        .badge-telat { background-color: #f8d7da; color: #721c24; }
        
        .foto-thumbnail {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #eaeaea;
        }
        
        .filter-section {
            background-color: var(--pastel-blue);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .table tbody tr:hover {
            background-color: rgba(28, 46, 74, 0.05);
        }
        
        @media (max-width: 768px) {
            .main-content {
                padding: 12px;
            }

            .stats-card {
                padding: 10px;
                border-radius: 10px;
            }

            .stats-icon {
                width: 42px;
                height: 42px;
                font-size: 1.2rem;
                margin-bottom: 8px;
                border-radius: 8px;
            }

            .stats-number {
                font-size: 1.4rem;
                margin-bottom: 2px;
            }

            .stats-label {
                font-size: 0.7rem;
                letter-spacing: 0.5px;
            }

            .row > .col-md-3 {
                flex: 0 0 50%;
                max-width: 50%;
            }

            .navbar-top {
                padding: 10px 14px;
                border-radius: 8px;
            }

            .page-title h2 {
                font-size: 1.1rem;
            }

            .user-info img {
                width: 32px;
                height: 32px;
            }

            .user-info h6 {
                font-size: 0.85rem;
            }

            .user-info small {
                font-size: 0.7rem;
            }
        }
      
        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
            }
            
            .sidebar-header h3 {
                font-size: 0;
            }
            
            .sidebar-header h3:after {
                font-size: 1.5rem;
                color: var(--text-dark);
            }
            
            .nav-link span {
                display: none;
            }
            
            .nav-link i {
                margin-right: 0;
            }
            
            .main-content {
                margin-left: 70px;
            }
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .stats-card {
                margin-bottom: 15px;
            }
        }      
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="logo-container">
                <img src="{{ asset('image/logo.png') }}" alt="Logo">
            </div>
            <h3>Siprala Admin</h3>
        </div>       
        <div class="sidebar-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.permohonan-izin') ? 'active' : '' }}" href="{{ route('admin.permohonan-izin') }}">
                        <i class="fas fa-file-contract"></i>
                        <span>Permohonan Izin</span>
                        <span class="badge bg-danger rounded-pill ms-auto" id="izin-notif">
                            {{ $permohonanPending ?? 0 }}
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.riwayat') ? 'active' : '' }}" href="{{ route('admin.riwayat') }}">
                        <i class="fas fa-history"></i>
                        <span>Riwayat Absensi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}" href="{{ route('admin.users') }}">
                        <i class="fas fa-users"></i>
                        <span>Karyawan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.pengaturan') ? 'active' : '' }}" href="{{ route('admin.pengaturan') }}">
                        <i class="fas fa-cog"></i>
                        <span>Pengaturan</span>
                    </a>
                </li>
                <li class="nav-item mt-4">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>   
    <div class="main-content">
        <nav class="navbar-top">
            <div class="page-title">
                <h2>@yield('page-title', 'Dashboard Admin')</h2>
            </div>           
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name=Admin&background=3E6985&color=fff" alt="Admin">
                <div>
                    <h6 class="mb-0">Administrator</h6>
                    <small class="text-muted">Siprala Admin</small>
                </div>
            </div>
        </nav>        
        @if (request()->routeIs('admin.dashboard'))
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="stats-card card-hadir">
                        <div class="stats-icon icon-hadir">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <h3 class="stats-number" id="count-hadir">0</h3>
                        <p class="stats-label">Hadir Hari Ini</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card card-izin">
                        <div class="stats-icon icon-izin">
                            <i class="fas fa-user-clock"></i>
                        </div>
                        <h3 class="stats-number" id="count-izin">0</h3>
                        <p class="stats-label">Izin Hari Ini</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card card-sakit">
                        <div class="stats-icon icon-sakit">
                            <i class="fas fa-user-injured"></i>
                        </div>
                        <h3 class="stats-number" id="count-sakit">0</h3>
                        <p class="stats-label">Sakit Hari Ini</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card card-total">
                        <div class="stats-icon icon-total">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="stats-number" id="count-total">0</h3>
                        <p class="stats-label">Total Karyawan</p>
                    </div>
                </div>
            </div>
        @endif        
        @yield('content')
    </div>    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>    
    <script>
        $(document).ready(function() {
            if ($('#absensiTable').length) {
                $('#absensiTable').DataTable({
                    language: { 
                        url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
                        paginate: {
                            next: '›',
                            previous: '‹'
                        }
                    },
                    pageLength: 10,
                    responsive: true,
                    dom: 'rtp',
                    lengthChange: false,
                    searching: false
                });
            }
            
            if ($('#izinTable').length) {
                $('#izinTable').DataTable({
                    language: { 
                        url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
                        paginate: {
                            next: '›',
                            previous: '‹'
                        }
                    },
                    pageLength: 10,
                    responsive: true,
                    dom: 'rtp',
                    lengthChange: false,
                    searching: false
                });
            }
            
            if ($('#riwayatTable').length) {
                $('#riwayatTable').DataTable({
                    language: { 
                        url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
                        paginate: {
                            next: '›',
                            previous: '‹'
                        }
                    },
                    pageLength: 10,
                    responsive: true,
                    order: [[0, 'desc']],
                    dom: 'rtp',
                    lengthChange: false,
                    searching: false
                });
            }
            
            if ($('#karyawanTable').length) {
                $('#karyawanTable').DataTable({
                    language: { 
                        url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json',
                        paginate: {
                            next: '›',
                            previous: '‹'
                        }
                    },
                    pageLength: 10,
                    responsive: true,
                    dom: 'rtp',
                    lengthChange: false,
                    searching: false
                });
            }
            
            $('#count-hadir').text('{{ $hadirToday ?? 0 }}');
            $('#count-izin').text('{{ $izinToday ?? 0 }}');
            $('#count-sakit').text('{{ $sakitToday ?? 0 }}');
            $('#count-total').text('{{ $totalUsers ?? 0 }}');
            
            $('#izin-notif').text(parseInt('{{ $izinToday ?? 0 }}') + parseInt('{{ $sakitToday ?? 0 }}'));
            
            if ($('#filter-bidang').length) {
                $('#filter-bidang').change(function() {
                    const bidang = $(this).val();
                    const table = $('#absensiTable').DataTable();
                    
                    if (bidang === 'semua') {
                        table.column(2).search('').draw();
                    } else {
                        table.column(2).search(bidang).draw();
                    }
                });
            }
            
            if ($('#search-nama').length) {
                $('#search-nama').on('keyup', function() {
                    const table = $('#absensiTable').DataTable();
                    table.search(this.value).draw();
                });
            }
        });
        
        function showFoto(imageUrl) {
            $('#fotoModal .modal-body').html(`<img src="${imageUrl}" class="img-fluid" alt="Foto Absensi">`);
            $('#fotoModal').modal('show');
        }
        
        function konfirmasi(status, id) {
            if (confirm(`Apakah Anda yakin ingin mengkonfirmasi permohonan ini sebagai ${status}?`)) {
                fetch(`/admin/permohonan-izin/konfirmasi/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ status: status })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Permohonan berhasil dikonfirmasi.');
                        location.reload();
                    } else {
                        alert('Gagal mengkonfirmasi permohonan.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan.');
                });
            }
        }
    </script>
    @yield('scripts')
</body>
</html>