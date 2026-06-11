<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan PDF</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .box {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        .title {
            font-weight: bold;
        }
    </style>
</head>

<body>

<h2>LAPORAN HASIL ANALISIS</h2>

<div class="box">
    <span class="title">Nama Usaha:</span>
    {{ $history->analisisUsaha->nama_usaha ?? '-' }}
</div>

<div class="box">
    <span class="title">User:</span>
    {{ $history->analisisUsaha->user->name ?? '-' }}
</div>

<table>
    <tr>
        <th>ROA</th>
        <td>{{ $history->roa }}%</td>
    </tr>
    <tr>
        <th>Margin Laba</th>
        <td>{{ $history->margin_laba }}%</td>
    </tr>
    <tr>
        <th>Utilisasi Produksi</th>
        <td>{{ $history->utilisasi_produksi }}%</td>
    </tr>
    <tr>
        <th>Nilai SAW</th>
        <td>{{ $history->nilai_saw }}</td>
    </tr>
    <tr>
        <th>Kategori</th>
        <td>{{ $history->kategori_potensi }}</td>
    </tr>
</table>

</body>
</html>