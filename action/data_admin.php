<?php 
$query = mysqli_query($mysqli, "SELECT judul, deskripsi FROM tb_rapat");
$data = [];

while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

echo json_encode($data);
?>