<?php
///////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////
/////// SISFOSURAT v1.0                                         ///////
/////// Sistem Informasi Surat - Menyurat                       ///////
///////////////////////////////////////////////////////////////////////
/////// Dibuat oleh :                                           ///////
/////// Agus Muhajir, S.Kom                                     ///////
/////// URL 	:                                               ///////
///////     * http://github.com/hajirodeon                      ///////
///////     * http://gitlab.com/hajirodeon                      ///////
/////// E-Mail	:                                               ///////
///////     * hajirodeon@yahoo.com                              ///////
///////     * hajirodeon@gmail.com                              ///////
/////// HP/SMS/WA : 081-829-88-54                               ///////
///////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////




session_start();


//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
require("inc/class/paging.php");
$tpl = LoadTpl("template/login.html");



nocache;

//nilai
$filenya = "index.php";
$filenya_ke = $sumber;
$judul = "Sistem Informasi Surat - Menyurat";
$s = nosql($_REQUEST['s']);
$judulku = $judul;






//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnOK'])
	{
	//ambil nilai
	$username = nosql($_POST["usernamex"]);
	$password = md5(nosql($_POST["passwordx"]));

	//cek null
	if ((empty($username)) OR (empty($password)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//query
		$q = mysqli_query($koneksi, "SELECT * FROM adminx ".
							"WHERE usernamex = '$username' ".
							"AND passwordx = '$password'");
		$row = mysqli_fetch_assoc($q);
		$total = mysqli_num_rows($q);

		//cek login
		if ($total != 0)
			{
			session_start();

			//bikin session
			$_SESSION['kd11_session'] = nosql($row['kd']);
			$_SESSION['username11_session'] = $username;
			$_SESSION['pass11_session'] = $password;
			$_SESSION['surat_session'] = "Petugas Pengarsip Surat";
			$_SESSION['hajirobe_session'] = $hajirobe;


			//diskonek
			xfree($q);
			xclose($koneksi);

			//re-direct
			$ke = "adm/index.php";
			xloc($ke);
			exit();
			}
		else
			{
			//diskonek
			xfree($q);
			xclose($koneksi);

			//re-direct
			$pesan = "Password Salah. Harap Diulangi...!!";
			pekem($pesan, $filenya);
			exit();
			}
		}

	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////








//isi *START
ob_start();



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







echo '<form action="'.$filenya.'" method="post" name="formx">
<p>
Username :
<br>
<input name="usernamex" type="text" size="15" class="btn btn-block btn-warning" required>
</p>


<p>
Password :
<br>
<input name="passwordx" type="password" size="15" class="btn btn-block btn-warning" required>
</p>


<p>
<input name="btnOK" type="submit" value="OK &gt;&gt;&gt;" class="btn btn-block btn-danger">
</p>


</form>';



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("inc/niltpl.php");


//diskonek
xclose($koneksi);
exit();
?>
