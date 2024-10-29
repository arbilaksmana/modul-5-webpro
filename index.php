<?php
// Array untuk menyimpan data barang
$barang = [
    ["id" => 1, "nama" => "Buku", "kategori" => "Alat Tulis", "harga" => 20000],
    ["id" => 2, "nama" => "Pulpen", "kategori" => "Alat Tulis", "harga" => 5000],
    ["id" => 2, "nama" => "Spidol", "kategori" => "Alat Tulis", "harga" => 4000],
];

// Fungsi untuk menambah barang baru ke array
if (isset($_POST['tambah'])) {
    $id = count($barang) + 1;
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    
    // Menambah barang ke dalam array
    $barang[] = ["id" => $id, "nama" => $nama, "kategori" => $kategori, "harga" => $harga];
}

// Fungsi untuk mengedit data barang
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    foreach ($barang as &$item) {
        if ($item['id'] == $id) {
            $item['nama'] = $_POST['nama'];
            $item['kategori'] = $_POST['kategori'];
            $item['harga'] = $_POST['harga'];
            break;
        }
    }
}

// Fungsi untuk menghapus data barang
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    foreach ($barang as $key => $item) {
        if ($item['id'] == $id) {
            unset($barang[$key]);
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        section {
            margin-bottom: 30px;
        }
        form {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

<!-- Section untuk menambah barang baru -->
<section id="form-tambah">
    <h2>Tambah Barang</h2>
    <form method="POST">
        <label>Nama Barang:</label><br>
        <input type="text" name="nama" required><br>
        <label>Kategori Barang:</label><br>
        <input type="text" name="kategori" required><br>
        <label>Harga Barang:</label><br>
        <input type="number" name="harga" required><br>
        <button type="submit" name="tambah">Tambah Barang</button>
    </form>
</section>

<!-- Section untuk daftar barang -->
<section id="daftar-barang">
    <h2>Daftar Barang</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($barang as $item) : ?>
        <tr>
            <td><?= $item['id']; ?></td>
            <td><?= $item['nama']; ?></td>
            <td><?= $item['kategori']; ?></td>
            <td><?= $item['harga']; ?></td>
            <td>
                <!-- Tombol Edit -->
                <a href="#form-edit-<?= $item['id']; ?>">Edit</a>
                <!-- Tombol Hapus -->
                <a href="?hapus=<?= $item['id']; ?>" onclick="return confirm                <a href="?hapus=<?= $item['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</section>

<!-- Section untuk mengedit barang -->
<section id="form-edit">
    <?php foreach ($barang as $item) : ?>
    <h2>Edit Barang ID <?= $item['id']; ?></h2>
    <form id="form-edit-<?= $item['id']; ?>" method="POST">
        <input type="hidden" name="id" value="<?= $item['id']; ?>">
        <label>Nama Barang:</label><br>
        <input type="text" name="nama" value="<?= $item['nama']; ?>" required><br>
        <label>Kategori Barang:</label><br>
        <input type="text" name="kategori" value="<?= $item['kategori']; ?>" required><br>
        <label>Harga Barang:</label><br>
        <input type="number" name="harga" value="<?= $item['harga']; ?>" required><br>
        <button type="submit" name="edit">Simpan Perubahan</button>
    </form>
    <?php endforeach; ?>
</section>

</body>
</html>
