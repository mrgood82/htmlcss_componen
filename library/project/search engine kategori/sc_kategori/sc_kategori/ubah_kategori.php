<?php
include("../koneksi.php");
if(isset($_POST['update'])){
    $kd_kategori = $_POST['kd_kategori'];
    $kategori = $_POST['kategori'];
    $query_update = mysql_query("update tbl_kategori set kd_kategori = '$kd_kategori', kategori = '$kategori'
    where id_kategori = '".$_GET['id']."'");
    if($query_update){
        header('Location: kelola_kategori.php');
    }else{
        mysql_error();
    }
}
?>