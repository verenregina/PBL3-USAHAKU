<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - USAHAKU</title>

    <!-- FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: 'Segoe UI', sans-serif; background: #f5f0f1; }

.dashboard-app {
  display: flex;
  height: 100vh;
  overflow: hidden;

  background: #f5f6f8; /* lebih gelap biar kontras sama sidebar */
}

  /* ========== SIDEBAR ========== */
.sidebar {
  width: 240px;
  background: #1f2d3d;
  display: flex;
  flex-direction: column;
  flex-shrink: 0;
}

.logo-icon img {
  width: 110%;
  height: 50%;
  object-fit: cover;
}

.sidebar-description {
  font-size: 10px;
  color: rgba(255, 255, 255, 0.3);
  text-transform: uppercase;
  letter-spacing: 1px;
  padding: 10px 20px 16px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.07);
}
  .sidebar-menu {
    flex: 1;
    padding: 12px 0;
    overflow-y: auto;
  }

  .menu-section {
    font-size: 9px;
    color: rgba(255,255,255,0.3);
    text-transform: uppercase;
    letter-spacing: 1.2px;
    padding: 10px 20px 4px;
  }

  .menu-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 20px;
    color: rgba(255,255,255,0.55);
    font-size: 13px;
    cursor: pointer;
    transition: all 0.15s;
    border-left: 3px solid transparent;
    text-decoration: none;
    background: none;
    width: 100%;
    border-right: none;
    border-top: none;
    border-bottom: none;
    text-align: left;
  }

  .menu-item:hover {
    background: rgba(164, 6, 6, 0.06);
    color: white;
  }

  .menu-item.active {
    background: rgba(245, 244, 243, 0.15);
    color: #e1e1e1;
    border-left-color: #e6e4e2;
    font-weight: 600;
  }

  .menu-item svg {
    width: 16px;
    height: 16px;
    flex-shrink: 0;
    opacity: 0.7;
  }

  .menu-item.active svg {
    opacity: 1;
  }

  .logout-form {
    padding: 12px 16px;
    border-top: 1px solid rgba(255,255,255,0.07);
  }

  .logout-button {
    width: 100%;
    padding: 9px;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    color: rgba(255,255,255,0.5);
    border-radius: 8px;
    font-size: 12px;
    cursor: pointer;
    transition: all 0.15s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
  }

  .logout-button:hover {
    background: rgba(239,68,68,0.15);
    border-color: rgba(239,68,68,0.3);
    color: #f87171;
  }

  .sidebar-footer {
    padding: 14px 16px;
    border-top: 1px solid rgba(255,255,255,0.07);
    text-align: center;
    font-size: 10px;
    color: rgba(255,255,255,0.35);
  }

  .sidebar-footer p {
    margin: 0;
    font-size: 9px;
    line-height: 1.4;
  }

  .sidebar-footer-logo {
    margin-bottom: 8px;
  }

  .sidebar-footer-logo img {
    height: 24px;
    border-radius: 6px;
    object-fit: cover;
  }

  .sidebar-footer-desc {
    font-size: 9px;
    color: rgba(255,255,255,0.3);
    margin: 6px 0;
    line-height: 1.3;
  }

  /* ========== MAIN SECTION ========== */
  .main-section {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
  }

  /* ========== TOPBAR ========== */
  .topbar-card {
    background: white;
    padding: 16px 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid #e5e7eb;
    flex-shrink: 0;
  }

  .topbar-label {
    font-size: 11px;
    color: #f97316;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.8px;
  }

  .topbar-heading {
    font-size: 18px;
    font-weight: 700;
    color: #1f2d3d;
    margin-top: 2px;
  }

  .topbar-actions {
    display: flex;
    align-items: center;
    gap: 14px;
  }

  .search-wrapper {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #f3f4f6;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 8px 14px;
    cursor: text;
  }

  .search-wrapper svg {
    width: 14px;
    height: 14px;
    fill: #9ca3af;
    flex-shrink: 0;
  }

  .search-wrapper input {
    background: none;
    border: none;
    outline: none;
    font-size: 13px;
    color: #374151;
    width: 160px;
  }

  .search-wrapper input::placeholder {
    color: #9ca3af;
  }

  .user-badge {
    width: 36px;
    height: 36px;
    background: linear-gradient(135deg, #f97316, #ea580c);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: 700;
    color: white;
    cursor: pointer;
  }

  /* ========== CONTENT AREA ========== */
  .content-area {
    flex: 1;
    padding: 24px 28px;
    overflow-y: auto;
    background: #f0f2f5;
  }

  .section-header {
    margin-bottom: 20px;
  }

  .section-label {
    font-size: 11px;
    color: #f97316;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.8px;
  }

  .section-title {
    font-size: 20px;
    font-weight: 700;
    color: #1f2d3d;
    margin-top: 2px;
  }

  /* ========== STATS GRID ========== */
  .stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 20px;
  }

  .stat-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 16px;
    border: 1px solid #e5e7eb;
    transition: box-shadow 0.2s;
  }

  .stat-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  }

  .stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .stat-icon.orange { background: rgba(249,115,22,0.12); }
  .stat-icon.blue   { background: rgba(59,130,246,0.12); }
  .stat-icon.green  { background: rgba(34,197,94,0.12);  }

  .stat-icon svg { width: 22px; height: 22px; }
  .icon-orange { fill: #f97316; }
  .icon-blue   { fill: #3b82f6; }
  .icon-green  { fill: #22c55e; }

  .stat-info { flex: 1; }

  .stat-value {
    font-size: 28px;
    font-weight: 800;
    color: #1f2d3d;
    line-height: 1;
  }

  .stat-label {
    font-size: 12px;
    color: #6b7280;
    margin-top: 4px;
  }

  .stat-badge {
    font-size: 11px;
    font-weight: 600;
    color: #16a34a;
    background: rgba(34,197,94,0.1);
    padding: 3px 8px;
    border-radius: 20px;
    align-self: flex-start;
  }

  /* ========== CHART CARD ========== */
  .chart-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    border: 1px solid #e5e7eb;
  }

  .chart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 18px;
  }

  .chart-header h3 {
    font-size: 15px;
    font-weight: 700;
    color: #1f2d3d;
  }

  .chart-filter {
    display: flex;
    gap: 6px;
  }

  .filter-btn {
    font-size: 11px;
    padding: 5px 12px;
    border-radius: 20px;
    cursor: pointer;
    font-weight: 500;
    border: none;
    transition: all 0.15s;
  }

  .filter-btn.active {
    background: #f97316;
    color: white;
  }

  .filter-btn.inactive {
    background: #f3f4f6;
    color: #6b7280;
  }

  .filter-btn.inactive:hover {
    background: #e5e7eb;
  }

  .chart-placeholder {
    width: 100%;
    height: 180px;
    background: #f9fafb;
    border-radius: 8px;
    border: 1px dashed #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #9ca3af;
    font-size: 13px;
  }

  /* Jika menggunakan Chart.js, ganti .chart-placeholder dengan: */
  /* <canvas id="usageChart" height="180"></canvas> */
</style>

<div class="dashboard-app">

  {{-- ===== SIDEBAR ===== --}}
  <aside class="sidebar">
    <div class="sidebar-logo">
        <div>
      <div class="logo-icon">
  <img src="{{ asset('assets/images/logo.png') }}" alt="Logo">
</div>
      </div>
    </div>
    <p class="sidebar-description">Panel admin USAHAKU</p>

    <nav class="sidebar-menu">
      <p class="menu-section">Utama</p>
      <a href="{{ route('admin') }}" class="menu-item active">
        <svg viewBox="0 0 20 20" fill="currentColor"><path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/></svg>
        <span>Dashboard</span>
      </a>

      <p class="menu-section">Data</p>
      <a href="{{ route('admin.kelola-data') }}" class="menu-item">
        <svg viewBox="0 0 20 20" fill="currentColor"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/></svg>
        <span>Kelola Data</span>
      </a>
      <a href="#" class="menu-item">
        <svg viewBox="0 0 20 20" fill="currentColor"><path d="M3 12v3c0 1.657 3.134 3 7 3s7-1.343 7-3v-3c0 1.657-3.134 3-7 3s-7-1.343-7-3z"/><path d="M3 7v3c0 1.657 3.134 3 7 3s7-1.343 7-3V7c0 1.657-3.134 3-7 3S3 8.657 3 7z"/><path d="M17 5c0 1.657-3.134 3-7 3S3 6.657 3 5s3.134-3 7-3 7 1.343 7 3z"/></svg>
        <span>Dataset</span>
      </a>
      <a href="#" class="menu-item">
        <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/></svg>
        <span>Data Usaha</span>
      </a>

      <p class="menu-section">Riwayat</p>
      <a href="#" class="menu-item">
        <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
        <span>History</span>
      </a>
      <a href="#" class="menu-item">
        <svg viewBox="0 0 20 20" fill="currentColor"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/></svg>
        <span>Riwayat Pengguna</span>
      </a>
    </nav>

    <form action="{{ route('logout') }}" method="POST" class="logout-form">
      @csrf
      <button type="submit" class="logout-button">Logout</button>
    </form>

    <div class="sidebar-footer">
      <div class="sidebar-footer-logo">
        <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
      </div>
      <p class="sidebar-footer-desc">Sistem rekomendasi usaha berbasis data untuk membantu UMKM berkembang.</p>
      <p>{{ 'Copyright ©' . date('Y') }} USAHAKU</p>
    </div>
  </aside>

  {{-- ===== MAIN ===== --}}
  <main class="main-section">

    {{-- TOPBAR --}}
    <div class="topbar-card">
      <div>
        <p class="topbar-label">Dashboard</p>
        <h1 class="topbar-heading">Selamat datang, {{ auth()->user()->name }}</h1>
      </div>
      <div class="topbar-actions">
        <label class="search-wrapper">
          <svg viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/></svg>
          <input type="search" placeholder="Cari data..." />
        </label>
        <div class="user-badge">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
      </div>
    </div>

    {{-- CONTENT --}}
    <section class="content-area">
      <div class="section-header">
        <p class="section-label">Overview</p>
        <h2 class="section-title">Dashboard</h2>
      </div>

      {{-- STATS --}}
      <div class="stats-grid">
        <article class="stat-card">
          <div class="stat-icon orange">
            <svg viewBox="0 0 20 20" class="icon-orange"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/></svg>
          </div>
          <div class="stat-info">
            <p class="stat-value">500</p>
            <p class="stat-label">Total Usaha</p>
          </div>
          <span class="stat-badge">+12%</span>
        </article>

        <article class="stat-card">
          <div class="stat-icon blue">
            <svg viewBox="0 0 20 20" class="icon-blue"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/></svg>
          </div>
          <div class="stat-info">
            <p class="stat-value">6</p>
            <p class="stat-label">Total Kategori Usaha</p>
          </div>
        </article>

        <article class="stat-card">
          <div class="stat-icon green">
            <svg viewBox="0 0 20 20" class="icon-green"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/></svg>
          </div>
          <div class="stat-info">
            <p class="stat-value">100</p>
            <p class="stat-label">Total User</p>
          </div>
          <span class="stat-badge">+8%</span>
        </article>
      </div>

      {{-- CHART --}}
      <div class="chart-card">
        <div class="chart-header">
          <h3>Grafik Penggunaan Sistem</h3>
          <div class="chart-filter">
            <button class="filter-btn active" onclick="setFilter(this)">Mingguan</button>
            <button class="filter-btn inactive" onclick="setFilter(this)">Bulanan</button>
            <button class="filter-btn inactive" onclick="setFilter(this)">Tahunan</button>
          </div>
        </div>
        {{-- Ganti dengan <canvas id="usageChart"></canvas> jika pakai Chart.js --}}
        <div class="chart-placeholder">Placeholder grafik</div>
      </div>
    </section>

  </main>
</div>

<script>
  function setFilter(btn) {
    document.querySelectorAll('.filter-btn').forEach(b => {
      b.classList.remove('active');
      b.classList.add('inactive');
    });
    btn.classList.remove('inactive');
    btn.classList.add('active');
  }
</script>

</body>
</html>