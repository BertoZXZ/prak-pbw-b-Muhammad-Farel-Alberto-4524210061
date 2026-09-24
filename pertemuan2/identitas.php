<?php
interface Identitas {
    public function ringkasan(): string;
    public function getPredikat(): string;
}

class Mahasiswa implements Identitas {
    private string $nim;
    private string $nama;
    private string $prodi; // MODIFIKASI 1: Field baru
    protected float $ipk;

    public function __construct(string $nim, string $nama, string $prodi, float $ipk) {
        $this->nim = $nim;
        $this->nama = $nama;
        $this->prodi = $prodi;
        $this->setIpk($ipk);
    }

    public function setIpk(float $ipk): void {
        if ($ipk < 0 || $ipk > 4) {
            throw new InvalidArgumentException('IPK harus antara 0 sampai 4.');
        }
        $this->ipk = $ipk;
    }

    public function getIpk(): float { return $this->ipk; }
    public function getNim(): string { return $this->nim; }
    public function getNama(): string { return $this->nama; }
    public function getProdi(): string { return $this->prodi; }

    // MODIFIKASI 2: Kondisi baru predikat lengkap
    public function getPredikat(): string {
        if ($this->ipk >= 3.80) return 'Cum Laude';
        if ($this->ipk >= 3.50) return 'Sangat Memuaskan';
        if ($this->ipk >= 3.00) return 'Memuaskan';
        if ($this->ipk >= 2.00) return 'Cukup';
        return 'Perlu Peningkatan';
    }

    public function ringkasan(): string {
        return "{$this->nim} - {$this->nama} ({$this->prodi}) - IPK: {$this->ipk} - {$this->getPredikat()}";
    }
}

// MODIFIKASI TAMBAHAN: Inheritance biar keren
class MahasiswaBaru extends Mahasiswa {
    private int $tahunMasuk;
    public function __construct(string $nim, string $nama, string $prodi, float $ipk, int $tahunMasuk) {
        parent::__construct($nim, $nama, $prodi, $ipk);
        $this->tahunMasuk = $tahunMasuk;
    }
    public function ringkasan(): string {
        return parent::ringkasan() . " - Angkatan {$this->tahunMasuk}";
    }
}

try {
    $mhs = new MahasiswaBaru('2026001', 'Andi Pratama', 'Teknik Informatika', 3.85, 2024);
    $error = null;
} catch (Exception $e) {
    $mhs = null;
    $error = $e->getMessage();
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Kartu Identitas Mahasiswa</title>
<style>
 body{font-family: 'Segoe UI', sans-serif; background: #eef2ff; display:flex; justify-content:center; align-items:center; min-height:100vh; margin:0}
 .card{background:white; width:380px; border-radius:20px; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.1)}
 .header{background: linear-gradient(135deg, #4f46e5, #06b6d4); color:white; padding:25px; text-align:center}
 .header h2{margin:0; font-size:22px}
 .body{padding:25px}
 .row{display:flex; justify-content:space-between; padding:10px 0; border-bottom:1px solid #f0f0f0}
 .row b{color:#555}
 .badge{display:inline-block; background:#dcfce7; color:#166534; padding:6px 12px; border-radius:20px; font-weight:bold; margin-top:15px}
 .error{background:#fee2e2; color:#991b1b; padding:15px; border-radius:10px}
 .footer{text-align:center; padding:15px; font-size:12px; color:#999}
</style>
</head>
<body>
<div class="card">
  <div class="header"><h2>KARTU MAHASISWA</h2><small>Identitas Digital</small></div>
  <div class="body">
    <?php if($error): ?>
      <div class="error">Error: <?= htmlspecialchars($error) ?></div>
    <?php else: ?>
      <div class="row"><b>NIM</b> <span><?= htmlspecialchars($mhs->getNim()) ?></span></div>
      <div class="row"><b>Nama</b> <span><?= htmlspecialchars($mhs->getNama()) ?></span></div>
      <div class="row"><b>Prodi</b> <span><?= htmlspecialchars($mhs->getProdi()) ?></span></div>
      <div class="row"><b>IPK</b> <span><?= htmlspecialchars((string)$mhs->getIpk()) ?></span></div>
      <div style="text-align:center"><span class="badge"><?= $mhs->getPredikat() ?></span></div>
      <p style="margin-top:15px; font-size:13px; color:#666; text-align:center"><?= htmlspecialchars($mhs->ringkasan()) ?></p>
    <?php endif; ?>
  </div>
  <div class="footer">Tugas 2 - Pemrograman Web OOP</div>
</div>
</body>
</html>