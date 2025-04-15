<div class="komentar">
    <h2>Komentar</h2>
    <form action="proses_komentar.php" method="POST">
        <input type="text" name="nama" placeholder="Nama" required />
        <textarea name="komentar" placeholder="Komentar" required></textarea>
        <button type="submit">Kirim</button>
    </form>
    <div class="komentar-list">
        <?php
        // Ambil komentar dari database
        $komentar_query = "SELECT * FROM komentar ORDER BY tanggal DESC";
        $komentar_result = $conn->query($komentar_query);
        
        while ($komentar_row = $komentar_result->fetch_assoc()):
            $nama = $komentar_row['nama'];
            $isi_komentar = $komentar_row['isi_komentar'];
            $tanggal = $komentar_row['tanggal'];
        ?>
        <div class="komentar-item">
            <strong><?= htmlspecialchars($nama) ?></strong> (<?= date('d F Y', strtotime($tanggal)) ?>):
            <p><?= htmlspecialchars($isi_komentar) ?></p>
        </div>
        <?php endwhile; ?>
    </div>
  </div>