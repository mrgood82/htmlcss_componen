CREATE DATABASE project_ec;
CREATE TABLE tbl_customer(id_customer int(11) NOT null PRIMARY KEY AUTO_INCREMENT, kd_customer varchar(12) NOT null, nama_customer varchar(25) NOT null, alamat text NOT null,
kd_kota int(11) NOT null, telp varchar(20) NOT null, email varchar(45) NOT null, join_regis date NOT null, gender varchar(15) not null);
CREATE TABLE tbl_user(id int(11) NOT null PRIMARY KEY AUTO_INCREMENT, username varchar(12) NOT null, password varchar(12) NOT null, nama varchar(25) NOT null);
CREATE TABLE tbl_kota(id_kota int(5) NOT null PRIMARY KEY AUTO_INCREMENT, kd_kota int(5) NOT null, kota varchar(25) NOT null);
CREATE TABLE tbl_supplier(id_supplier int(5) NOT null PRIMARY KEY AUTO_INCREMENT, kd_supplier int(5) NOT null, nama_supplier varchar(25) NOT null, telp varchar(20) NOT null, alamat text NOT null);
CREATE TABLE tbl_kategori(id_kategori int(5) NOT null PRIMARY KEY AUTO_INCREMENT, kd_kategori int(5) NOT null, kategori varchar(25) NOT null);
CREATE TABLE tbl_produk(id_produk int(11) NOT null PRIMARY KEY AUTO_INCREMENT, kd_produk int(11) NOT null, nama varchar(25) NOT null, deskripsi text NOT null, kd_kategori int(5) NOT null, kd_supplier int(5) NOT null,
tgl_beli date NOT null, stok int(5) NOT null, harga_beli int(11) NOT null, harga_jual int(11) NOT null, foto varchar(35) NOT null);
CREATE TABLE tbl_jasakirim(id_jasa int(5) NOT null PRIMARY KEY AUTO_INCREMENT, kd_jasa int(5) NOT null, nama_jasa varchar(25) NOT null, durasi varchar(15) NOT null, ongkir int(11) NOT null);
CREATE TABLE tbl_cart(id_cart int(11) NOT null PRIMARY KEY AUTO_INCREMENT, kd_produk int(11) NOT null, kd_customer varchar(12) NOT null, jumlah int(11) NOT null, harga_jual int(11) NOT null, tgl_pesan date NOT null);
CREATE TABLE tbl_pembelian(id_beli int(11) NOT null PRIMARY KEY AUTO_INCREMENT, kd_produk int(11) NOT null, kd_customer varchar(12) NOT null, jumlah int(11) NOT null, total_bayar int(11) NOT null, kd_invoice varchar(25)NOT null,
status_beli varchar(15) NOT null);
CREATE TABLE tbl_transaksi(id_transaksi int(11) NOT null PRIMARY KEY AUTO_INCREMENT, tgl_bayar date NOT null, jumlah int(11) NOT null, total_beli int(11) NOT null, fee_kirim int(11) NOT null, total_bayar int(11) NOT null,
bukti_bayar varchar(35) NOT null, status_bayar varchar(11) NOT null, kd_invoice varchar(25)NOT null);
CREATE TABLE tbl_kirim(id_kirim int(11) NOT null PRIMARY KEY AUTO_INCREMENT, kd_customer varchar(12) NOT null, kd_invoice varchar(25)NOT null, peyedia_jasa varchar(25) NOT null, status_kirim varchar(15) NOT null,
estimasi_waktu varchar(15) NOT null, bukti_kirim varchar(35) NOT null, tgl_kirim date NOT null);