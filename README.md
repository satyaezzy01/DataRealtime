# Sistem Data Realtime dengan AJAX & PHP

Proyek ini adalah sistem data real-time yang menggunakan **JavaScript (AJAX) & PHP** untuk mengambil dan menampilkan data dari database **tanpa reload halaman**.  
Data akan diperbarui secara otomatis setiap 3 detik.  

## 📌 Fitur
- **Menampilkan data dari database secara real-time**.
- **Menggunakan AJAX untuk mengambil data tanpa reload halaman**.
- **Memperbarui data otomatis setiap 3 detik**.

---


---

## 📦 Instalasi Database
Jalankan perintah berikut di **phpMyAdmin** atau **terminal MySQL** untuk membuat database dan tabel:

```sql
CREATE DATABASE db_realtime;

USE db_realtime;

CREATE TABLE data_realtime (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255),
    nilai INT
);

INSERT INTO data_realtime (nama, nilai) VALUES
('Sensor 1', 45),
('Sensor 2', 67),
('Sensor 3', 89);

---

```html
<?php
$host = "localhost";
$user = "root"; 
$pass = ""; 
$db = "db_realtime";

$conn = new mysqli($host, $user, $pass, $db);

$sql = "SELECT * FROM data_realtime";
$result = $conn->query($sql);

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>


---
```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Realtime</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <h2>Data Realtime</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody id="data-container">
            <!-- Data akan muncul di sini -->
        </tbody>
    </table>

    <script>
        function loadData() {
            $.ajax({
                url: 'get_data.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    let dataHTML = '';
                    response.forEach(function(item) {
                        dataHTML += `<tr>
                                        <td>${item.id}</td>
                                        <td>${item.nama}</td>
                                        <td>${item.nilai}</td>
                                     </tr>`;
                    });
                    $('#data-container').html(dataHTML);
                }
            });
        }

        setInterval(loadData, 3000); // Update data setiap 3 detik

        $(document).ready(function() {
            loadData();
        });
    </script>

</body>
</html>
