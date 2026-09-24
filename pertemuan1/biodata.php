<?php
// biodata_modifikasi.php - Farel
function statusKelulusan(float $ipk): string
{
    if ($ipk >= 3.80) return 'Sangat Memuaskan (Cum Laude)'; // MODIFIKASI KONDISI
    if ($ipk >= 3.50) return 'Sangat Memuaskan';
    if ($ipk >= 3.00) return 'Memuaskan';
    return 'Perlu Peningkatan';
}

$mahasiswa = [
    'nim' => '2026001',
    'nama' => 'Andi Pratama',
    'prodi' => 'Teknik Informatika',
    'semester' => 1,
    'ipk' => 3.72,
    'email' => 'andi.pratama@email.com', // MODIFIKASI FIELD BARU
    'alamat' => 'Kota Batu, Jawa Barat', // MODIFIKASI FIELD BARU
    'tahun_masuk' => 2024
];
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Biodata Mahasiswa</title>
<style>
 body{font-family: Arial, sans-serif; background:#f0f2f5; padding:40px}
 .card{background:white; max-width:500px; margin:auto; padding:25px; border-radius:15px; box-shadow:0 5px 15px rgba(0,0,0,0.1)}
 h1{color:#1a73e8; border-bottom:2px solid #1a73e8; padding-bottom:10px}
 ul{list-style:none; padding:0}
 li{padding:8px 0; border-bottom:1px solid #eee}
 li span{font-weight:bold; display:inline-block; width:120px; text-transform:capitalize}
 .predikat{margin-top:20px; background:#e8f0fe; padding:12px; border-radius:8px; font-weight:bold}
</style>
</head>
<body>
<div class="card">
    <h1>Biodata Mahasiswa</h1>
    <ul>
        <?php foreach ($mahasiswa as $kunci => $nilai): ?>
            <li><span><?= ucfirst(str_replace('_', ' ', $kunci)) ?>:</span> <?= htmlspecialchars((string)$nilai) ?></li>
        <?php endforeach; ?>
    </ul>
    <div class="predikat">Predikat: <?= statusKelulusan($mahasiswa['ipk']) ?></div>
</div>
</body>
</html>