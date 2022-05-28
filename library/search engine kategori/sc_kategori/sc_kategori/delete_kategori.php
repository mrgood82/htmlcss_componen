<?php
include("../koneksi.php");
$query_delete = mysql_query("delete from tbl_kategori where id_kategori = '".$_GET['id']."'");
if($query_delete){
    /*echo"
    <script type='text/javascript'>
    alert('Data Sudah Berhasil Di Hapus');document.location='kelola_kategori.php';
    </script>
    ";*/
    header('location: kelola_kategori.php');
}else{
    mysql_error();
}
?>