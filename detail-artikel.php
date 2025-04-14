<?php
// Ambil ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Contoh data artikel
$artikel = [
    1 => ["judul" => "Perbaikan jalan Desa Pemayahan Kabupaten Indramayu", "konten" => "Pemayahan sedang melakukan perbaikan jalan...", "gambar" => "../img/jalann.jpg"],
    2 => ["judul" => "Rapat Koordinasi Pekerja Sosial", "konten" => "Rapat koordinasi sukses dilaksanakan...", "gambar" => "../img/rapat.jpeg"],
    3 => ["judul" => "Pelantikan petugas Pemilu", "konten" => "Melantik petugas Pemilu...", "gambar" => "../img/lantik.jpeg"],
];

if ($id && isset($artikel[$id])) {
    $judul = $artikel[$id]["judul"];
    $konten = $artikel[$id]["konten"];
    $gambar = $artikel[$id]["gambar"];
} else {
    $judul = "Artikel tidak ditemukan";
    $konten = "Maaf, artikel yang Anda cari tidak tersedia.";
    $gambar = "../img/notfound.jpg";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $judul; ?></title>
</head>
<body>
    <h2><?php echo $judul; ?></h2>
    <img src="<?php echo $gambar; ?>" alt="<?php echo $judul; ?>">
    <p><?php echo $konten; ?></p>
    <a href="index.php">Kembali ke Beranda</a>
</body>
</html>
