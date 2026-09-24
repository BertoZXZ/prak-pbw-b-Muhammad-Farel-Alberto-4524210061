<?php
$hasil = null;
$pesan = '';
$riwayat = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = (float) ($_POST['a'] ?? 0);
    $b = (float) ($_POST['b'] ?? 0);
    $operator = $_POST['operator'] ?? '+';

    switch ($operator) {
        case '+': $hasil = $a + $b; break;
        case '-': $hasil = $a - $b; break;
        case '*': $hasil = $a * $b; break;
        case '/':
            if ($b == 0) {
                $pesan = 'Error: Pembagian dengan nol tidak diperbolehkan!';
            } else {
                $hasil = $a / $b;
            }
            break;
        case '%': // MODIFIKASI BARU
            if ($b == 0) {
                $pesan = 'Error: Modulus dengan nol tidak boleh!';
            } else {
                $hasil = $a % $b;
            }
            break;
        default: $pesan = 'Operator tidak valid.';
    }
    if($hasil !== null) $riwayat = "$a $operator $b = $hasil";
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<title>Kalkulator Modifikasi - Farel</title>
<style>
 body{font-family: sans-serif; background:#f4f4f4; display:flex; justify-content:center; padding-top:50px}
 .card{background:white; padding:25px; border-radius:12px; box-shadow:0 4px 10px rgba(0,0,0,0.1); width:320px}
 input, select, button{width:100%; padding:10px; margin:6px 0; border-radius:6px; border:1px solid #ccc}
 button{background:#007bff; color:white; border:none; cursor:pointer}
 button:hover{background:#0056b3}
 .hasil{margin-top:15px; background:#e8f5e9; padding:10px; border-radius:6px}
 .error{background:#ffebee; color:red; padding:10px; border-radius:6px}
</style>
</head>
<body>
<div class="card">
<h2>Kalkulator v2</h2>
<form method="post">
    <input type="number" step="any" name="a" placeholder="Angka pertama" required>
    <select name="operator">
        <option value="+">+ Tambah</option>
        <option value="-">- Kurang</option>
        <option value="*">* Kali</option>
        <option value="/">/ Bagi</option>
        <option value="%">% Sisa Bagi (Baru)</option>
    </select>
    <input type="number" step="any" name="b" placeholder="Angka kedua" required>
    <button type="submit">Hitung</button>
</form>
<?php if ($pesan): ?>
    <div class="error"><?= htmlspecialchars($pesan) ?></div>
<?php elseif ($hasil !== null): ?>
    <div class="hasil">Hasil: <b><?= htmlspecialchars((string)$hasil) ?></b><br><small><?= $riwayat ?></small></div>
<?php endif; ?>
</div>
</body>
</html>