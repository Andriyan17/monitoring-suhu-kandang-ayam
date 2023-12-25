<?php
    include "koneksi.php";

// Ubah query untuk mengambil data terbaru berdasarkan ID tanpa pengurutan khusus
$sql = mysqli_query($conn, "SELECT * FROM logs WHERE id = (SELECT MAX(id) FROM logs)");

// Periksa apakah query berhasil dieksekusi
if ($sql) {
    // Ambil data terbaru
    $data = mysqli_fetch_array($sql);

    // Periksa apakah ada data
    if ($data) {
        $nilaiSuhu = $data['suhu'];
        $nilaiKelembapan = $data['kelembapan'];

        // Mengirim data dalam format JSON
        echo json_encode(array('suhu' => $nilaiSuhu, 'kelembapan' => $nilaiKelembapan));
    } else {
        // Mengirim pesan jika data tidak ditemukan
        echo json_encode(array('error' => 'Data tidak ditemukan'));
    }
} else {
    // Mengirim pesan jika ada kesalahan query
    echo json_encode(array('error' => 'Error: ' . mysqli_error($conn)));
}
?>
