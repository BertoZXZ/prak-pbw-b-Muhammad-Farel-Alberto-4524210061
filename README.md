Muhammad Farel Alberto/4524210061
PERTEMUAN 1 HASIL YG SUDAH DI MODIFIKASI
- KALKULATOR
 <img width="1587" height="729" alt="image" src="https://github.com/user-attachments/assets/fcf4573d-b0b5-43a6-bd75-964c3f596d17" />
 <img width="1600" height="572" alt="image" src="https://github.com/user-attachments/assets/84b30431-4f2e-47b3-820a-5c96dbf46899" />
- BIODATA
<img width="1600" height="589" alt="image" src="https://github.com/user-attachments/assets/db214660-ee94-44d4-9b0b-c63dbaf12e3e" />
<img width="1600" height="589" alt="image" src="https://github.com/user-attachments/assets/924cbb44-79c6-4f8b-bb72-9d512ce28a9e" />

Penjelasan 5 Bagian Kode Paling Penting:

1. `if ($_SERVER['REQUEST_METHOD'] == 'POST')`
Untuk cek apakah form sudah di-submit atau belum. Jadi perhitungan tidak jalan saat halaman pertama kali dibuka.
2. `$a = (float) $_POST['a']`
Untuk mengambil data dari input form HTML dan mengubahnya menjadi angka. Tanpa ini data tidak bisa dihitung.
3. `switch ($operator)`
Untuk menentukan operasi hitung sesuai pilihan user (+, -, *, /). Ini inti logika kalkulator.
4. `if ($b == 0)` pada bagian pembagian
Untuk mencegah error pembagian dengan nol. Jika user mengisi pembagi 0, program akan menampilkan pesan, bukan error.
5. `function statusKelulusan()` dan `foreach` di http://biodata.php
`function` dipakai untuk membuat logika status IPK agar bisa dipakai berulang. Sedangkan `array` dan `foreach` dipakai untuk menyimpan dan menampilkan data biodata secara otomatis

PERTEMUAN 2 HASIL YG SUDAH DI MODIFIKASI
- HITUNG
<img width="1600" height="589" alt="image" src="https://github.com/user-attachments/assets/2cb17ae9-e1e2-470e-aa2b-985ed0704031" />
<img width="1600" height="589" alt="image" src="https://github.com/user-attachments/assets/81b86b58-5886-491c-ba00-358b16f8e5b4" />
- IDENTITAS
<img width="1600" height="589" alt="image" src="https://github.com/user-attachments/assets/ae37270f-3226-4a93-8802-0fd39b5dc42d" />
<img width="1600" height="589" alt="image" src="https://github.com/user-attachments/assets/e1eeec68-2a47-4111-b6d8-597de56832b2" />

Penjelasan 5 Bagian Kode Paling Penting:

1. `interface BisaDihitung`
Berfungsi sebagai kontrak. Semua class produk wajib punya function `hargaAkhir()`. Ini konsep OOP biar kode lebih terstruktur.
2. `class Produk implements BisaDihitung`
Class utama untuk produk. Di dalamnya ada `__construct` untuk mengisi nama dan harga saat objek dibuat, dan `protected` agar data tidak bisa diubah sembarangan dari luar.
3. `class ProdukDiskon extends Produk`
Ini contoh pewarisan (inheritance). ProdukDiskon mengambil semua sifat dari Produk, tapi ditambah diskon. Jadi tidak perlu bikin kode dari awal lagi.
4. `public function hargaAkhir(): float` yang di-override
Di class Produk harganya langsung `return harga`, tapi di ProdukDiskon di-override menjadi `harga * (1 - diskon/100)`. Ini contoh polymorphism, function sama tapi hasil beda tergantung class nya.
5. `new Produk()` dan `foreach ($daftar as $produk)`
`new Produk` untuk membuat objek nyata dari class. Lalu `foreach` untuk menampilkan semua produk otomatis. Data dan logika terpisah, jadi kalau tambah produk baru tinggal tambah di array `$daftar`.


