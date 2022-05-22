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

nocache;


//re-direct
$pesan = "Waktu Sesi Login Telah Habis. Silahkan Login Kembali...!!";
pekem($pesan,$sumber);
exit();
?>