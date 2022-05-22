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





//fungsi - fungsi
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");



require_once("../../inc/class/dompdf/dompdf_config.inc.php");



//nilai
$judul = "Disposisi Surat Masuk";
$judulz = $judul;
$sukd = nosql($_REQUEST['sukd']);



//query
$qx = mysqli_query($koneksi, "SELECT surat_masuk.*, ".
			"DATE_FORMAT(tgl_surat, '%d') AS surat_tgl, ".
			"DATE_FORMAT(tgl_surat, '%m') AS surat_bln, ".
			"DATE_FORMAT(tgl_surat, '%Y') AS surat_thn, ".
			"DATE_FORMAT(tgl_terima, '%d') AS terima_tgl, ".
			"DATE_FORMAT(tgl_terima, '%m') AS terima_bln, ".
			"DATE_FORMAT(tgl_terima, '%Y') AS terima_thn ".
			"FROM surat_masuk ".
			"WHERE kd = '$sukd'");
$rowx = mysqli_fetch_assoc($qx);
$x_no_urut = nosql($rowx['no_urut']);
$x_no_surat = balikin2($rowx['no_surat']);
$x_asal = balikin2($rowx['asal']);
$x_tujuan = balikin2($rowx['tujuan']);
$x_kd_sifat = nosql($rowx['kd_sifat']);
$x_kd_klasifikasi = nosql($rowx['kd_klasifikasi']);
$x_surat_tgl = nosql($rowx['surat_tgl']);
$x_surat_bln = nosql($rowx['surat_bln']);
$x_surat_thn = nosql($rowx['surat_thn']);
$x_perihal = balikin2($rowx['perihal']);
$x_terima_tgl = nosql($rowx['terima_tgl']);
$x_terima_bln = nosql($rowx['terima_bln']);
$x_terima_thn = nosql($rowx['terima_thn']);


//detail disposisi
$qx2 = mysqli_query($koneksi, "SELECT surat_masuk_disposisi.*, ".
			"DATE_FORMAT(tgl_selesai, '%d') AS selesai_tgl, ".
			"DATE_FORMAT(tgl_selesai, '%m') AS selesai_bln, ".
			"DATE_FORMAT(tgl_selesai, '%Y') AS selesai_thn, ".
			"DATE_FORMAT(tgl_kembali, '%d') AS kembali_tgl, ".
			"DATE_FORMAT(tgl_kembali, '%m') AS kembali_bln, ".
			"DATE_FORMAT(tgl_kembali, '%Y') AS kembali_thn ".
			"FROM surat_masuk_disposisi ".
			"WHERE kd_surat = '$sukd'");
$rowx2 = mysqli_fetch_assoc($qx2);
$x2_inxkd = nosql($rowx2['kd_indeks']);
$x2_selesai_tgl = nosql($rowx2['selesai_tgl']);
$x2_selesai_bln = nosql($rowx2['selesai_bln']);
$x2_selesai_thn = nosql($rowx2['selesai_thn']);
$x2_kembali_tgl = nosql($rowx2['kembali_tgl']);
$x2_kembali_bln = nosql($rowx2['kembali_bln']);
$x2_kembali_thn = nosql($rowx2['kembali_thn']);
$x2_isi = balikin($rowx2['isi']);
$x2_diteruskan = balikin($rowx2['diteruskan']);
$x2_kepada = balikin($rowx2['kepada']);
$x2_harap = balikin($rowx2['harap']);
$x2_catatan = balikin($rowx2['catatan']);


//terpilih
$qblsx = mysqli_query($koneksi, "SELECT * FROM surat_m_indeks ".
			"WHERE kd = '$x2_inxkd'");
$rblsx = mysqli_fetch_assoc($qblsx);
$blsx_indeks = balikin($rblsx['indeks']);



$qdtx = mysqli_query($koneksi, "SELECT * FROM surat_m_klasifikasi ".
			"WHERE kd = '$x_kd_klasifikasi'");
$rdtx = mysqli_fetch_assoc($qdtx);
$dtx_klasifikasi = balikin($rdtx['klasifikasi']);





//terpilih
$qdtx = mysqli_query($koneksi, "SELECT * FROM surat_m_sifat ".
			"WHERE kd = '$x_kd_sifat'");
$rdtx = mysqli_fetch_assoc($qdtx);
$dtx_sifat = balikin($rdtx['sifat']);



//jika null
if (($x2_selesai_tgl == "00") OR ($x2_selesai_bln == "00") OR ($x2_selesai_thn == "0000"))
	{
	$x2_selesai = "";
	}
else
	{
	$x2_selesai = "$x2_selesai_tgl $arrbln1[$x2_selesai_bln] $x2_selesai_thn";
	}







//bikin pdf ///////////////////////////////////////////////////////////////////////////////////////

//isi *START
ob_start();




echo '<table width="530" cellpadding="1" cellspacing="1" border="0">
<tr valign="top">
<td align="center" width="50">
	<img src="../../img/logo.png" width="50" height="50">
</td>
<td align="center">

	<font size="5">
	<b>'.$sek_nama.'</b>
	<br>

	<font size="4">
	'.$sek_alamat.'
	</font>
</td>

<td align="center" width="50">
	&nbsp;
</td>


</tr>
</table>



<hr>



<br>
<table width="530" cellpadding="1" cellspacing="1" border="0">
<tr valign="top">
<td align="center">
	
	<font size="4">
	<u><b>LEMBAR DISPOSISI SURAT MASUK</b></u>
	</font>
	
</td>
</tr>
</table>

<br>



<table width="530" cellpadding="1" cellspacing="1" border="0">
<tr valign="top">
<td align="left" width="10">
a.
</td>
<td align="left" width="150">
Surat dari
</td>
<td align="left" width="10">
:
</td>
<td align="left">
'.strtoupper($x_asal).'
</td>
</tr>


<tr valign="top">
<td align="left" width="10">
b.
</td>
<td align="left" width="150">
Nomor Surat
</td>
<td align="left" width="10">
:
</td>
<td align="left">
'.strtoupper($x_no_surat).'
</td>
</tr>

<tr valign="top">
<td align="left" width="10">
c.
</td>
<td align="left" width="150">
Tanggal Surat
</td>
<td align="left" width="10">
:
</td>
<td align="left">
'.$x_surat_tgl.' '.$arrbln1[$x_surat_bln].' '.$x_surat_thn.'
</td>
</tr>


<tr valign="top">
<td align="left" width="10">
d.
</td>
<td align="left" width="150">
Diterima Tanggal
</td>
<td align="left" width="10">
:
</td>
<td align="left">
'.$x_terima_tgl.' '.$arrbln1[$x_terima_bln].' '.$x_terima_thn.'
</td>
</tr>




<tr valign="top">
<td align="left" width="10">
e.
</td>
<td align="left" width="150">
Nomor Agenda
</td>
<td align="left" width="10">
:
</td>
<td align="left">
'.$x_no_urut.'
</td>
</tr>




<tr valign="top">
<td align="left" width="10">
f.
</td>
<td align="left" width="150">
Nomor Agenda
</td>
<td align="left" width="10">
:
</td>
<td align="left">
'.$dtx_sifat.'
</td>
</tr>




<tr valign="top">
<td align="left" width="10">
g.
</td>
<td align="left" width="150">
Perihal
</td>
<td align="left" width="10">
:
</td>
<td align="left">
'.$x_perihal.'
</td>
</tr>



<tr valign="top">
<td align="left" width="10">
h.
</td>
<td align="left" width="150">
Diteruskan kepada Sdr.
</td>
<td align="left" width="10">
:
</td>
<td align="left">
'.$x2_diteruskan.'
</td>
</tr>



<tr valign="top">
<td align="left" width="10">
h.
</td>
<td align="left" width="150">
Dengan hormat harap
</td>
<td align="left" width="10">
:
</td>
<td align="left">
'.$x2_harap.'
</td>
</tr>


</table>
<br>
<br>



<table width="530" cellpadding="1" cellspacing="1" border="0">
<tr valign="top">

<td align="center" width="250">
	<br>
	<br>
	Tanggal & Paraf
	<br>
	'.$tanggal.' '.$arrbln1[$bulan].' '.$tahun.'
</td>


<td align="center">

</td>


<td align="center" width="250">
	
	<br>
	<br>
	Tanggal Penyelesaian
	<br>
	'.$x2_selesai_tgl.' '.$arrbln1[$x2_selesai_bln].' '.$x2_selesai_thn.'
</td>


</tr>
</table>






<table width="530" cellpadding="1" cellspacing="1" border="0">
<tr valign="top">

<td align="center" width="250">
	<br>
	<br>
	Catatan
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>

</td>


<td align="center">

</td>


<td align="center" width="250">
	
	<br>
	<br>
	'.$tanggal.' '.$arrbln1[$bulan].' '.$tahun.'
	<br>
	<br>
	Pimpinan
	<br>
	<br>
	<br>
	<br>
	
	<u><b>......................................</b></u>
	
</td>


</tr>
</table>







<hr>

<i>[Postdate Cetak : '.$today.'].</i>';




//isi
$isix = ob_get_contents();
ob_end_clean();



	







$dompdf = new DOMPDF();
$dompdf->load_html($isix);

// Setting ukuran dan orientasi kertas
//$dompdf->setPaper('A4', 'potrait');

$dompdf->render();
$dompdf->stream("disposisi_surat_masuk-$x_no_surat.pdf");
?>