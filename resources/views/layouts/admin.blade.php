<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') – USAHAKU</title>

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Poppins','Segoe UI',sans-serif;
            background:#f5f6f8;
        }

        a{
            text-decoration:none;
        }

        /* =========================
           LAYOUT
        ========================== */

        .dashboard-app{
            display:flex;
            min-height:100vh;
            overflow:hidden;
        }

        /* =========================
           SIDEBAR
        ========================== */

        .sidebar{
            width:250px;
            background:#131d29;
            display:flex;
            flex-direction:column;
            flex-shrink:0;
        }

        .sidebar-description{
            font-size:10px;
            color:rgba(255,255,255,.35);
            text-transform:uppercase;
            letter-spacing:1px;
            padding:14px 20px;
            border-bottom:1px solid rgba(255,255,255,.06);
        }

        .sidebar-menu{
            flex:1;
            overflow-y:auto;
            padding:10px 0;
        }

        .menu-section{
            padding:12px 20px 6px;
            font-size:10px;
            color:rgba(255,255,255,.30);
            text-transform:uppercase;
            letter-spacing:1px;
        }

        .menu-item{
            display:flex;
            align-items:center;
            gap:12px;
            padding:12px 20px;
            color:rgba(255,255,255,.60);
            font-size:13px;
            transition:.2s ease;
            border-left:3px solid transparent;
        }

        .menu-item svg{
            width:17px;
            height:17px;
            flex-shrink:0;
            opacity:.7;
        }

        .menu-item:hover{
            background:rgba(255,255,255,.05);
            color:white;
        }

        .menu-item.active{
            background:#f97316;
            color:white;
            border-left-color:#fff;
            font-weight:600;
        }

        .menu-item.active svg{
            opacity:1;
        }

        /* =========================
           LOGOUT
        ========================== */

        .logout-form{
            padding:14px 16px;
            border-top:1px solid rgba(255,255,255,.06);
        }

        .logout-button{
            width:100%;
            border:none;
            background:rgba(255,255,255,.05);
            border:1px solid rgba(255,255,255,.08);
            color:rgba(255,255,255,.65);
            padding:10px;
            border-radius:10px;
            font-size:13px;
            cursor:pointer;

            display:flex;
            align-items:center;
            justify-content:center;
            gap:8px;

            transition:.2s ease;
        }

        .logout-button:hover{
            background:rgba(239,68,68,.14);
            border-color:rgba(239,68,68,.30);
            color:#f87171;
        }

        /* =========================
           SIDEBAR FOOTER
        ========================== */

        .sidebar-footer{
            padding:16px;
            border-top:1px solid rgba(255,255,255,.06);
            text-align:center;
        }

        .sidebar-footer-logo{
            margin-bottom:10px;
        }

        .sidebar-footer-logo img{
            height:28px;
            border-radius:8px;
        }

        .sidebar-footer-desc{
            font-size:10px;
            color:rgba(255,255,255,.35);
            line-height:1.5;
            margin-bottom:8px;
        }

        .sidebar-footer p{
            font-size:10px;
            color:rgba(255,255,255,.35);
        }

        /* =========================
           MAIN SECTION
        ========================== */

        .main-section{
            flex:1;
            display:flex;
            flex-direction:column;
            overflow:hidden;
        }

        /* =========================
           TOPBAR
        ========================== */

        .topbar-card{
            background:white;
            padding:18px 28px;
            border-bottom:1px solid #e5e7eb;

            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:20px;
            flex-wrap:wrap;
        }

        .topbar-label{
            font-size:11px;
            color:#f97316;
            font-weight:600;
            text-transform:uppercase;
            letter-spacing:.8px;
        }

        .topbar-heading{
            font-size:22px;
            color:#1f2937;
            font-weight:700;
            margin-top:2px;
        }

        .topbar-actions{
            display:flex;
            align-items:center;
            gap:14px;
        }

        /* SEARCH */

        .search-wrapper{
            display:flex;
            align-items:center;
            gap:8px;
            background:#f9fafb;
            border:1px solid #e5e7eb;
            border-radius:12px;
            padding:10px 14px;
        }

        .search-wrapper svg{
            width:14px;
            height:14px;
            fill:#9ca3af;
        }

        .search-wrapper input{
            border:none;
            outline:none;
            background:none;
            font-size:13px;
            width:180px;
            color:#374151;
        }

        .search-wrapper input::placeholder{
            color:#9ca3af;
        }

        /* USER */

        .user-badge{
            width:40px;
            height:40px;
            border-radius:50%;
            background:linear-gradient(135deg,#f97316,#ea580c);
            color:white;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:700;
            font-size:15px;
            flex-shrink:0;
        }

        /* =========================
           CONTENT
        ========================== */

        .content-area{
            flex:1;
            overflow-y:auto;
            padding:26px 28px;
            background:#f3f4f6;
        }

        /* =========================
           SCROLLBAR
        ========================== */

        ::-webkit-scrollbar{
            width:6px;
            height:6px;
        }

        ::-webkit-scrollbar-thumb{
            background:#d1d5db;
            border-radius:999px;
        }

        /* =========================
           RESPONSIVE
        ========================== */

        @media(max-width:992px){

            .sidebar{
                width:220px;
            }

            .topbar-heading{
                font-size:20px;
            }

        }

        @media(max-width:768px){

            .dashboard-app{
                flex-direction:column;
            }

            .sidebar{
                width:100%;
                height:auto;
            }

            .topbar-card{
                padding:16px 20px;
            }

            .content-area{
                padding:20px;
            }

            .search-wrapper input{
                width:120px;
            }

        }

    </style>

    @stack('styles')
</head>

<body>

<div class="dashboard-app">

    {{-- =========================
         SIDEBAR
    ========================== --}}
    <aside class="sidebar">

        <p class="sidebar-description">
            Panel Admin USAHAKU
        </p>

        <nav class="sidebar-menu">

            {{-- MENU UTAMA --}}
            <p class="menu-section">Utama</p>

            <a href="{{ route('admin.dashboard') }}"
               class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

                <svg viewBox="0 0 20 20" fill="currentColor">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                </svg>

                <span>Dashboard</span>
            </a>

            {{-- DATA --}}
            <p class="menu-section">Data</p>

            <a href="{{ route('admin.kelola-data') }}"
               class="menu-item {{ request()->routeIs('admin.kelola-data') ? 'active' : '' }}">

                <svg viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5z" clip-rule="evenodd"/>
                </svg>

                <span>Kelola Data</span>
            </a>

            {{-- DATASET --}}
            <a href="{{ route('admin.dashboard') }}"
               class="menu-item {{ request()->routeIs('admin.dataset') ? 'active' : '' }}">

                <svg viewBox="0 0 20 20" fill="currentColor">
                    <path d="M3 12v3c0 1.657 3.134 3 7 3s7-1.343 7-3v-3c0 1.657-3.134 3-7 3s-7-1.343-7-3z"/>
                    <path d="M3 7v3c0 1.657 3.134 3 7 3s7-1.343 7-3V7c0 1.657-3.134 3-7 3S3 8.657 3 7z"/>
                    <path d="M17 5c0 1.657-3.134 3-7 3S3 6.657 3 5s3.134-3 7-3 7 1.343 7 3z"/>
                </svg>

                <span>Dataset</span>
            </a>

            {{-- DATA USAHA --}}
            <a href="{{ route('admin.dashboard') }}"
               class="menu-item {{ request()->routeIs('admin.data-usaha') ? 'active' : '' }}">

                <svg viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4z" clip-rule="evenodd"/>
                </svg>

                <span>Data Usaha</span>
            </a>

            {{-- RIWAYAT --}}
            <p class="menu-section">Riwayat</p>

            <a href="{{ route('admin.dashboard') }}"
               class="menu-item {{ request()->routeIs('admin.history') ? 'active' : '' }}">

                <svg viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>

                <span>History</span>
            </a>

            <a href="{{ route('admin.dashboard') }}"
               class="menu-item {{ request()->routeIs('admin.riwayat-pengguna') ? 'active' : '' }}">

                <svg viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>

                <span>Riwayat Pengguna</span>
            </a>

        </nav>

        {{-- LOGOUT --}}
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf

            <button type="submit" class="logout-button">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </form>

        {{-- FOOTER --}}
        <div class="sidebar-footer">

            <div class="sidebar-footer-logo">
                <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
            </div>

            <p class="sidebar-footer-desc">
                Sistem rekomendasi usaha berbasis data untuk membantu UMKM berkembang.
            </p>

            <p>
                Copyright © {{ date('Y') }} USAHAKU
            </p>

        </div>

    </aside>

    {{-- =========================
         MAIN
    ========================== --}}
    <main class="main-section">

        {{-- TOPBAR --}}
        <div class="topbar-card">

            <div>
                <p class="topbar-label">
                    @yield('topbar-label', 'Admin')
                </p>

                <h1 class="topbar-heading">
                    @yield('topbar-heading', 'Selamat datang, ' . auth()->user()->name)
                </h1>
            </div>

            <div class="topbar-actions">

                {{-- SEARCH --}}
                <label class="search-wrapper">

                    <svg viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                    </svg>

                    <input type="search" placeholder="Cari data...">

                </label>

                {{-- USER --}}
                <div class="user-badge">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

            </div>

        </div>

        {{-- CONTENT --}}
        <section class="content-area">
            @yield('content')
        </section>

    </main>

</div>

@stack('modals')
@stack('scripts')

</body>
</html>