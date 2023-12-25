<?php
    include "koneksi.php";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }

    // Get current date and time
    date_default_timezone_set('Asia/Jakarta'); 
    $seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
    $hari = date("w");
    $hari_ini = $seminggu[$hari];
    $tgl_sekarang = date("ymd");
    $jam_sekarang = date("H:i:s");

    if (!empty($_POST['status1']) && !empty($_POST['status2'])) {
        $status1 = $_POST['status1'];
        $status2 = $_POST['status2'];

        $sql = "INSERT INTO logs (tanggal, hari, waktu, suhu, kelembapan)
                VALUES ('".$tgl_sekarang."', '".$hari_ini."', now(), '".$status1."', '".$status2."')";

        if ($conn->query($sql) === TRUE) {
            echo "OK";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
?>
