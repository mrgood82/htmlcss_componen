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
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
require("../inc/cek/admsurat.php");
require("../inc/class/paging.php");
$tpl = LoadTpl("../template/index.html");

nocache;

//nilai
$filenya = "index.php";
$judul = "Selamat Datang....";
$judulku = "$judul  [$surat_session : $nip11_session. $nm11_session]";













//jml masuk
$qyuk = mysqli_query($koneksi, "SELECT kd FROM surat_masuk");
$jml_masuk = mysqli_num_rows($qyuk);




//jml keluar
$qyuk = mysqli_query($koneksi, "SELECT kd FROM surat_keluar");
$jml_keluar = mysqli_num_rows($qyuk);




//jml masuk. sah
$qyuk = mysqli_query($koneksi, "SELECT kd FROM surat_masuk_disposisi ".
									"WHERE pengesahan = 'true'");
$jml_masuk_sah = mysqli_num_rows($qyuk);





//jml masuk. sah
$qyuk = mysqli_query($koneksi, "SELECT kd FROM surat_keluar_disposisi ".
									"WHERE pengesahan = 'true'");
$jml_keluar_sah = mysqli_num_rows($qyuk);












//postdate entri
$qyuk = mysqli_query($koneksi, "SELECT * FROM surat_masuk ".
									"ORDER BY postdate DESC");
$ryuk = mysqli_fetch_assoc($qyuk);
$yuk_masuk_terakhir = balikin($ryuk['postdate']);






//postdate entri
$qyuk = mysqli_query($koneksi, "SELECT * FROM surat_keluar ".
									"ORDER BY postdate DESC");
$ryuk = mysqli_fetch_assoc($qyuk);
$yuk_keluar_terakhir = balikin($ryuk['postdate']);














//isi *START
ob_start();

//tanggal sekarang
$m = date("m");
$de = date("d");
$y = date("Y");

//ambil 14hari terakhir
for($i=0; $i<=14; $i++)
	{
	$nilku = date('Ymd',mktime(0,0,0,$m,($de-$i),$y)); 

	echo "$nilku, ";
	}


//isi
$isi_data1 = ob_get_contents();
ob_end_clean();










//isi *START
ob_start();

//tanggal sekarang
$m = date("m");
$de = date("d");
$y = date("Y");

//ambil 14hari terakhir
for($i=0; $i<=14; $i++)
	{
	$nilku = date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); 


	//pecah
	$ipecah = explode("-", $nilku);
	$itahun = trim($ipecah[0]);  
	$ibln = trim($ipecah[1]);
	$itgl = trim($ipecah[2]);    


	//ketahui ordernya...
	$qyuk = mysqli_query($koneksi, "SELECT * FROM surat_masuk ".
							"WHERE round(DATE_FORMAT(tgl_diterima, '%d')) = '$itgl' ".
							"AND round(DATE_FORMAT(tgl_diterima, '%m')) = '$ibln' ".
							"AND round(DATE_FORMAT(tgl_diterima, '%Y')) = '$itahun'");
	$tyuk = mysqli_num_rows($qyuk);
	
	if (empty($tyuk))
		{
		$tyuk = "0";
		}
		
	echo "$tyuk, ";
	}


//isi
$isi_data2 = ob_get_contents();
ob_end_clean();










//isi *START
ob_start();

//tanggal sekarang
$m = date("m");
$de = date("d");
$y = date("Y");

//ambil 14hari terakhir
for($i=0; $i<=14; $i++)
	{
	$nilku = date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y)); 


	//pecah
	$ipecah = explode("-", $nilku);
	$itahun = trim($ipecah[0]);  
	$ibln = trim($ipecah[1]);
	$itgl = trim($ipecah[2]);    


	//ketahui 
	$qyuk = mysqli_query($koneksi, "SELECT * FROM surat_keluar ".
							"WHERE round(DATE_FORMAT(tgl_kirim, '%d')) = '$itgl' ".
							"AND round(DATE_FORMAT(tgl_kirim, '%m')) = '$ibln' ".
							"AND round(DATE_FORMAT(tgl_kirim, '%Y')) = '$itahun'");
	$tyuk = mysqli_num_rows($qyuk);
	
	if (empty($tyuk))
		{
		$tyuk = "0";
		}
		
	echo "$tyuk, ";
	}


//isi
$isi_data3 = ob_get_contents();
ob_end_clean();






























//isi *START
ob_start();



for ($k=1;$k<=12;$k++)
	{
	$nilku = $arrbln2[$k];
	echo "'$nilku', ";
	}


//isi
$isi_bln3 = ob_get_contents();
ob_end_clean();








//isi *START
ob_start();



for ($k=1;$k<=12;$k++)
	{
	$ubln2 = "$k";

	//detailnya
	$qyuk2 = mysqli_query($koneksi, "SELECT kd FROM surat_masuk_disposisi ".
									"WHERE pengesahan = 'true' ".
									"AND round(DATE_FORMAT(tgl_selesai, '%m')) = '$ubln2' ".
									"AND round(DATE_FORMAT(tgl_selesai, '%Y')) = '$tahun'");
	$tyuk2 = mysqli_num_rows($qyuk2);

	 
	echo "$tyuk2, ";
	}


//isi
$isi_masuksah = ob_get_contents();
ob_end_clean();







//isi *START
ob_start();



for ($k=1;$k<=12;$k++)
	{
	$ubln2 = "$k";

	//detailnya
	$qyuk2 = mysqli_query($koneksi, "SELECT kd FROM surat_keluar_disposisi ".
									"WHERE pengesahan = 'true' ".
									"AND round(DATE_FORMAT(tgl_selesai, '%m')) = '$ubln2' ".
									"AND round(DATE_FORMAT(tgl_selesai, '%Y')) = '$tahun'");
	$tyuk2 = mysqli_num_rows($qyuk2);


	echo "$tyuk2, ";
	}


//isi
$isi_keluarsah = ob_get_contents();
ob_end_clean();











//isi *START
ob_start();


?>





     
     
<div class="row">

<div class="col-md-12">
 
     
		<!-- Info boxes -->
      <div class="row">

        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-inbox"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">SURAT MASUK</span>
              <span class="info-box-number"><?php echo $jml_masuk;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->




        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-send"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">SURAT KELUAR</span>
              <span class="info-box-number"><?php echo $jml_keluar;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->






        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">SURAT MASUK TERAKHIR</span>
              <span class="info-box-number"><?php echo $yuk_masuk_terakhir;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        





        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-calendar-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">SURAT KELUAR TERAKHIR</span>
              <span class="info-box-number"><?php echo $yuk_keluar_terakhir;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->





        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-orange"><i class="fa fa-briefcase"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">DISPOSISI SURAT MASUK : SAH</span>
              <span class="info-box-number"><?php echo $jml_masuk_sah;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->




        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-orange"><i class="fa fa-briefcase"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">DISPOSISI SURAT KELUAR : SAH</span>
              <span class="info-box-number"><?php echo $jml_keluar_sah;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->




      </div>
      <!-- /.row -->

	</div>





</div>
 
     


      <div class="row">
        <div class="col-md-12">


			<script>
				$(function () {
				  'use strict'
				
				  var ticksStyle = {
				    fontColor: '#495057',
				    fontStyle: 'bold'
				  }
				
				  var mode      = 'index'
				  var intersect = true
				
				  var $salesChart = $('#sales-chart')
				  var salesChart  = new Chart($salesChart, {
				    type   : 'bar',
				    data   : {
				      labels  : [<?php echo $isi_bln3;?>],
				      datasets: [
				        {
				          backgroundColor: 'red',
				          borderColor    : 'red',
				          data           : [<?php echo $isi_masuksah;?>]
				        },
				        {
				          backgroundColor: 'green',
				          borderColor    : 'green',
				          data           : [<?php echo $isi_keluarsah;?>]
				        }
				      ]
				    },
				    options: {
				      maintainAspectRatio: false,
				      tooltips           : {
				        mode     : mode,
				        intersect: intersect
				      },
				      hover              : {
				        mode     : mode,
				        intersect: intersect
				      },
				      legend             : {
				        display: false
				      },
				      scales             : {
				        yAxes: [{
				          // display: false,
				          gridLines: {
				            display      : true,
				            lineWidth    : '4px',
				            color        : 'rgba(0, 0, 0, .2)',
				            zeroLineColor: 'transparent'
				          },
				          ticks    : $.extend({
				            beginAtZero: true,
				
				            // Include a dollar sign in the ticks
				            callback: function (value, index, values) {
				              if (value >= 1000) {
				                value /= 1000
				                value += 'k'
				              }
				              return '' + value
				            }
				          }, ticksStyle)
				        }],
				        xAxes: [{
				          display  : true,
				          gridLines: {
				            display: false
				          },
				          ticks    : ticksStyle
				        }]
				      }
				    }
				  })
				
				  var $visitorsChart = $('#visitors-chart')
				  var visitorsChart  = new Chart($visitorsChart, {
				    data   : {
				      labels  : [<?php echo $isi_data1;?>],
				      datasets: [{
				        type                : 'line',
				        data                : [<?php echo $isi_data2;?>],
				        backgroundColor     : 'transparent',
				        borderColor         : '#007bff',
				        pointBorderColor    : '#007bff',
				        pointBackgroundColor: '#007bff',
				        fill                : false
				        // pointHoverBackgroundColor: '#007bff',
				        // pointHoverBorderColor    : '#007bff'
				      },
				        {
				          type                : 'line',
				          data                : [<?php echo $isi_data3;?>],
				          backgroundColor     : 'tansparent',
				          borderColor         : '#ced4da',
				          pointBorderColor    : '#ced4da',
				          pointBackgroundColor: '#ced4da',
				          fill                : false
				          // pointHoverBackgroundColor: '#ced4da',
				          // pointHoverBorderColor    : '#ced4da'
				        }]
				    },
				    options: {
				      maintainAspectRatio: false,
				      tooltips           : {
				        mode     : mode,
				        intersect: intersect
				      },
				      hover              : {
				        mode     : mode,
				        intersect: intersect
				      },
				      legend             : {
				        display: false
				      },
				      scales             : {
				        yAxes: [{
				          // display: false,
				          gridLines: {
				            display      : true,
				            lineWidth    : '4px',
				            color        : 'rgba(0, 0, 0, .2)',
				            zeroLineColor: 'transparent'
				          },
				          ticks    : $.extend({
				            beginAtZero : true,
				            suggestedMax: 200
				          }, ticksStyle)
				        }],
				        xAxes: [{
				          display  : true,
				          gridLines: {
				            display: false
				          },
				          ticks    : ticksStyle
				        }]
				      }
				    }
				  })
				})

			</script>






		<div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">DISPOSISI SAH</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">



                <div class="position-relative mb-4">
                  <canvas id="visitors-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> SURAT MASUK
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> SURAT KELUAR
                  </span>
                </div>


                
                
              </div>
            </div>





			<div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">JUMLAH SURAT</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>

              <div class="card-body">

                <div class="position-relative mb-4">
                  <canvas id="sales-chart" height="200"></canvas>
                </div>

                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-red"></i> MASUK 
                  </span>

                  <span class="mr-2">
                    <i class="fas fa-square text-green"></i> KELUAR 
                  </span>
                </div>
              </div>
            </div>

			<br>




		<div class="row">
          <div class="col-lg-6">

			<?php
			$sqlcount = "SELECT * FROM surat_masuk ".
							"ORDER BY tgl_terima DESC";

			//query
			$p = new Pager();
			$start = $p->findStart($limit);
			
			$sqlresult = $sqlcount;
			
			$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
			$pages = $p->findPages($count, $limit);
			$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
			$pagelist = $p->pageList($_GET['page'], $pages, $target);
			$data = mysqli_fetch_array($result);
			?>
			
			
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">History SURAT MASUK</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>TANGGAL</th>
                      <th>NOMOR</th>
                      <th>KEPADA</th>
                    </tr>
                    </thead>
                    <tbody>
                    	
                    <?php
                    	do 
							{
							if ($warna_set ==0)
								{
								$warna = $warna01;
								$warna_set = 1;
								}
							else
								{
								$warna = $warna02;
								$warna_set = 0;
								}
					
							$nomer = $nomer + 1;
							$i_kd = nosql($data['kd']);
							$i_tgl_surat = balikin($data['tgl_surat']);
							$i_no_surat = balikin($data['no_surat']);
							$i_tujuan = balikin($data['tujuan']);

						
							echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
							echo '<td>'.$i_tgl_surat.'</td>
							<td>'.$i_no_surat.'</td>
							<td>'.$i_tujuan.'</td>
					        </tr>';
							}
						while ($data = mysqli_fetch_assoc($result));
						?>
						
						
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="<?php echo $sumber;?>/adm/surat/masuk.php" class="btn btn-sm btn-danger float-right">SELENGKAPNYA >></a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->


		</div>
		
		<div class="col-lg-6">

	



			<?php
			$sqlcount = "SELECT * FROM surat_keluar ".
							"ORDER BY tgl_kirim DESC";

			//query
			$p = new Pager();
			$start = $p->findStart($limit);
			
			$sqlresult = $sqlcount;
			
			$count = mysqli_num_rows(mysqli_query($koneksi, $sqlcount));
			$pages = $p->findPages($count, $limit);
			$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
			$pagelist = $p->pageList($_GET['page'], $pages, $target);
			$data = mysqli_fetch_array($result);
			?>
			
			
            <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">History SURAT KELUAR</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                      <th>TANGGAL</th>
                      <th>NOMOR</th>
                      <th>KEPADA</th>
                    </tr>
                    </thead>
                    <tbody>
                    	
                    <?php
                    	do 
							{
							if ($warna_set ==0)
								{
								$warna = $warna01;
								$warna_set = 1;
								}
							else
								{
								$warna = $warna02;
								$warna_set = 0;
								}
					
							$nomer = $nomer + 1;
							$i_kd = nosql($data['kd']);
							$i_tgl_surat = balikin($data['tgl_surat']);
							$i_no_surat = balikin($data['no_surat']);
							$i_tujuan = balikin($data['tujuan']);

						
							echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
							echo '<td>'.$i_tgl_surat.'</td>
							<td>'.$i_no_surat.'</td>
							<td>'.$i_tujuan.'</td>
					        </tr>';
							}
						while ($data = mysqli_fetch_assoc($result));
						?>
						
						
                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="<?php echo $sumber;?>/adm/surat/keluar.php" class="btn btn-sm btn-danger float-right">SELENGKAPNYA >></a>
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->







		</div>





      </div>
            







		<!-- OPTIONAL SCRIPTS -->
		<script src="../template/adminlte3/plugins/chart.js/Chart.min.js"></script>
		




	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
	
	$.noConflict();

	});
	
	</script>
	



<?php
//isi
$isi = ob_get_contents();
ob_end_clean();

require("../inc/niltpl.php");



//diskonek
xfree($qbw);
xclose($koneksi);
exit();
?>