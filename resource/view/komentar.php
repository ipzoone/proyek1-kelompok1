<?php

if (! function_exists('tampilkan_komentar')) {
    function tampilkan_komentar($conn, $artikel_id, $parent_id = 0, $indent = 0) {
        $stmt = $conn->prepare("
            SELECT k.id, k.komentar, k.dibuat_pada, m.nama
            FROM komentar k
            JOIN masyarakat m ON k.user_id = m.id
            WHERE k.artikel_id = ? AND k.parent_id = ?
            ORDER BY k.dibuat_pada ASC
        ");
        $stmt->bind_param("ii", $artikel_id, $parent_id);
        $stmt->execute();
        $res = $stmt->get_result();
        echo "<pre>";


        while ($r = $res->fetch_assoc()) {
            echo "<div class='border rounded p-2 mb-2' style='margin-left: {$indent}px'>";
            echo "<strong>" . htmlspecialchars($r['nama']) . "</strong><br>";
            echo nl2br(htmlspecialchars($r['komentar'])) . "<br>";
            echo "<small class='text-muted'>" . $r['dibuat_pada'] . "</small>";

            // Form balas jika user sudah login
            if (! empty($_SESSION['is_logged_in'])) {
                echo "
                  <form method='POST' action='proses_komentar.php' class='mt-2'>
                    <input type='hidden' name='artikel_id' value='{$artikel_id}'>
                    <input type='hidden' name='parent_id' value='{$r['id']}'>
                    <textarea name='komentar' rows='2' class='form-control mb-2'
                              placeholder='Balas komentar...' required></textarea>
                    <button class='btn btn-sm btn-primary'>Balas</button>
                  </form>
                ";
            }

            echo "</div>";

            // Tampilkan balasan secara rekursif
            tampilkan_komentar($conn, $artikel_id, $r['id'], $indent + 30);
        }
    }
}
