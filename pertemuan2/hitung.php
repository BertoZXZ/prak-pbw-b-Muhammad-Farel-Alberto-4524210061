<?php
interface BisaDihitung {
    public function hargaAkhir(): float;
    public function getInfo(): string;
}

class Produk implements BisaDihitung {
    public function __construct(
        protected string $nama, 
        protected float $harga,
        protected int $stok = 10, // MODIFIKASI 1: Field baru stok
        protected string $kategori = 'Umum'
    ) {}

    public function hargaAkhir(): float { return $this->harga; }
    public function getNama(): string { return $this->nama; }
    public function getHargaAsli(): float { return $this->harga; }
    public function getStok(): int { return $this->stok; }
    public function getInfo(): string { return "Kategori: {$this->kategori} | Stok: {$this->stok}"; }
}

class ProdukDiskon extends Produk {
    public function __construct(string $nama, float $harga, private float $diskon, int $stok = 10, string $kategori = 'Diskon') {
        // MODIFIKASI 2: Validasi bermakna
        if ($diskon < 0 || $diskon > 90) {
            throw new InvalidArgumentException("Diskon $nama harus 0-90%, kamu isi $diskon%");
        }
        if ($stok <= 0) {
            throw new InvalidArgumentException("Stok $nama harus lebih dari 0");
        }
        parent::__construct($nama, $harga, $stok, $kategori);
    }
    public function hargaAkhir(): float {
        return $this->harga * (1 - $this->diskon / 100);
    }
    public function getDiskon(): float { return $this->diskon; }
    public function getInfo(): string { return "Kategori: {$this->kategori} | Diskon {$this->diskon}% | Stok: {$this->stok}"; }
}

// MODIFIKASI 3: Kondisi baru class Pajak (Styling beda)
class ProdukPajak extends Produk {
    public function __construct(string $nama, float $harga, int $stok = 10) {
        parent::__construct($nama, $harga, $stok, 'Elektronik + PPN 11%');
    }
    public function hargaAkhir(): float { return $this->harga * 1.11; }
}

try {
    $daftar = [
        new Produk('Keyboard Mechanical', 250000, 15, 'Aksesoris'),
        new ProdukDiskon('Mouse Gaming', 150000, 10, 8),
        new ProdukDiskon('Headset RGB', 300000, 25, 5),
        new ProdukPajak('Laptop Stand', 200000, 12),
    ];
    $error = null;
} catch (Exception $e) {
    $daftar = [];
    $error = $e->getMessage();
}
?>
<!doctype html>
<html lang="id"><head><meta charset="utf-8"><title>TUGAS 2 - Farel</title>
<style>
 body{font-family:'Segoe UI',sans-serif; background:#f1f5f9; padding:20px}
 .grid{display:grid; grid-template-columns:repeat(auto-fit,minmax(250px,1fr)); gap:16px; max-width:900px; margin:20px auto}
 .card{background:white; border-radius:14px; padding:18px; box-shadow:0 2px 8px rgba(0,0,0,0.06)}
 .nama{font-weight:700}
 .harga{color:#16a34a; font-weight:800; font-size:18px; margin:8px 0}
 .coret{text-decoration:line-through; color:#999; font-size:13px}
 .badge{background:#dcfce7; color:#166534; padding:3px 8px; border-radius:6px; font-size:12px}
 .badge-pajak{background:#dbeafe; color:#1e40af}
 button{width:100%; padding:10px; background:#0f172a; color:white; border:none; border-radius:8px; cursor:pointer; margin-top:10px}
 button:hover{background:#334155}
 .error{background:#fee2e2; color:#991b1b; padding:15px; border-radius:10px; max-width:900px; margin:auto}
</style>
</head><body>
<h2 style="text-align:center">🛒 TUGAS 2 - Katalog Produk</h2>
<?php if($error): ?><div class="error">Error: <?= htmlspecialchars($error) ?></div>
<?php else: ?>
<div class="grid">
<?php foreach($daftar as $p): ?>
<div class="card">
  <div class="nama"><?= htmlspecialchars($p->getNama()) ?></div>
  <div class="coret">Rp <?= number_format($p->getHargaAsli(),0,',','.') ?></div>
  <div class="harga">Rp <?= number_format($p->hargaAkhir(),0,',','.') ?> 
    <?php if($p instanceof ProdukDiskon): ?><span class="badge">-<?= $p->getDiskon() ?>%</span>
    <?php elseif($p instanceof ProdukPajak): ?><span class="badge badge-pajak">+PPN 11%</span>
    <?php endif; ?>
  </div>
  <small style="color:#64748b"><?= $p->getInfo() ?></small>
  <button onclick="alert('Beli <?= $p->getNama() ?> berhasil!')">Beli</button>
</div>
<?php endforeach; ?>
</div>
<?php endif; ?>
</body></html>