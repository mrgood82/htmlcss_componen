<?php
include("../koneksi.php");
if(isset($_POST['add'])){
    $kd_kategori = $_POST['kd_kategori'];
    $kategori = $_POST['kategori'];
    $query_add = mysql_query("insert into tbl_kategori(kd_kategori, kategori)
    values ('$kd_kategori','$kategori')");
    if($query_add){
        header('Location: kelola_kategori.php');
    }else{
        mysql_error();
    }
}
?>