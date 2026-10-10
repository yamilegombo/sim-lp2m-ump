# SI Hibah LP2M UM Papua - CRUD PHP + MySQL

## Modul
- Proposal: Create, Read, Update, Delete + upload PDF.
- Pengguna: CRUD akun dan role.
- Skema Hibah: CRUD.
- Periode Hibah: CRUD.
- Login: PHP Session + password_hash/password_verify.
- CSRF token untuk form POST.
- PDO prepared statements.

## Instalasi
1. Ekstrak ke `C:\xampp\htdocs\si-hibah-lp2m-crud`
2. Start Apache dan MySQL.
3. phpMyAdmin -> Import -> `database.sql`.
4. Buka `http://localhost/si-hibah-lp2m-crud/`.

## Akun demo
Admin: admin@lp2m.umpapua.ac.id / admin123
Kepala: kepala@lp2m.umpapua.ac.id / kepala123
Sekretaris: sekretaris@lp2m.umpapua.ac.id / sekretaris123
Reviewer: reviewer@umpapua.ac.id / reviewer123
Dosen: dosen@umpapua.ac.id / dosen123
Kaprodi: kaprodi@umpapua.ac.id / kaprodi123

## Alur skripsi
Dosen -> Create Proposal -> Read -> Update -> Submit/Verifikasi -> Review -> Penetapan -> Monitoring -> Laporan.

Catatan: status verifikasi/penilaian/penetapan berikutnya dapat dikembangkan menjadi modul transaksi tersendiri setelah CRUD master selesai.
