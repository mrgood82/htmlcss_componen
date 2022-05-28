<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="cari" class="form-control" placeholder="cari disini....">
        <button type="submit" name="search" class="btn btn-primary">search</button>
    </form>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Deskripsi</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
			<?php
				include("koneksi.php");
				if((isset($_POST['search'])) and ($_POST['cari'] <> "")){
					$cari = $_POST['cari'];
					$query = mysql_query("select * from barang where nama_barang like '%$cari%'");
				}else {
					$query = mysql_query("select * from barang");
				}
				$no = 1;
				while($data = mysql_fetch_array($query)){
			?>
            <tr>
                <td><?php echo $no++?></td>
                <td><?php echo $data['nama_barang']?></td>
                <td><?php echo $data['deskripsi']?></td>
                <td><?php echo $data['harga']?></td>
            </tr>
			<?php }?>
        </tbody>
    </table>
</body>
</html>