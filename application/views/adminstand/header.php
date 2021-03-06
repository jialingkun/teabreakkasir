<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kasir TeaBreak</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" href=<?php echo base_url("apple-icon.png")?>>
    <link rel="shortcut icon" href=<?php echo base_url("assets/logo.ico")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/normalize.css")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/navbar.css")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/bootstrap.css")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/font-awesome.min.css")?>>

    <link rel="stylesheet" href=<?php echo base_url("assets/css/themify-icons.css")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/flag-icon.min.css")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/cs-skin-elastic.css")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/datatable/datatables.css") ?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/calculator.css") ?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/easy-autocomplete.min.css")?>>
    <link rel="stylesheet" href=<?php echo base_url("assets/css/easy-autocomplete.themes.css")?>>
    <!-- <link rel="stylesheet" href=<echo base_url("assets/css/bootstrap-select.less")?>> -->
    <link rel="stylesheet" href=<?php echo base_url("assets/scss/style.css")?>>
    <link href=<?php echo base_url("assets/css/lib/vector-map/jqvmap.min.css")?> rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link rel="stylesheet" href=<?php echo base_url("assets/vendors/bootstrap-daterangepicker/daterangepicker.css")?> >

    <!-- bootstrap-datetimepicker -->
    <link rel="stylesheet" href=<?php echo base_url("assets/vendors/Date-Time-Picker-Bootstrap-4/build/css/bootstrap-datetimepicker.min.css")?>>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src=<echo base_url("https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js")?>></script> -->

</head>
<style type="text/css">
    .error{
    border: 2px solid red!important;
}
.easy-autocomplete{
    width: auto!important;
}
.red{
    color: red !important;
}
</style>
<script type="text/javascript">

    var shiftt = "<?php echo $this->session->userdata('shift');?>";

    function shiftcheck() {
        $('#buttonshift').removeClass('btn-warning');
        $('#buttonshift').removeClass('btn-secondary');
        $('#buttonshift').removeClass('btn-success');
        if (shiftt == 'pagi') {
            $('#buttonshift').html('<i class="fa fa-sun-o"></i><span> Shift Pagi</span>');
            $('#buttonshift').addClass('btn-warning');
            $('#buttonshift').val('pagi');
        }else{
            $('#buttonshift').html('<i class="fa fa-moon-o"></i><span> Shift Malam</span>');
            $('#buttonshift').addClass('btn-secondary');
            $('#buttonshift').val('malam');
        }
    }
    function sinkronnota() {
        alert('sinkron');
        $('#sinkronnota').addClass('fa-spin');
        $('#labelsinkron').removeClass('red');
        $('#labelsinkron').removeClass('green');

        $('#labelsinkron').html('LOADING...');
        $('#labelsinkron').addClass('orange');
        $.ajax({
              type:"post",
              url: "<?php echo base_url('adminstand/sinkronnota')?>/",
              dataType:"text",
              success:function(response)
              {
                $('#labelsinkron').removeClass('orange');
                if (response == 'CANTCONNECT') {
                    $('#labelsinkron').html('KONEKSI ERROR!');
                    $('#labelsinkron').addClass('red');
                }else if (response == 'SUCCESSSAVE') {
                    $('#labelsinkron').html('SINKRONISASI NOTA SUKSES!');
                    $('#labelsinkron').addClass('green');
                }else{
                    $('#labelsinkron').html('PENYIMPANAN GAGAL!');
                    $('#labelsinkron').addClass('red');
                }
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                alert(errorThrown);
              },
              complete: function(){
                $('#sinkronnota').removeClass('fa-spin');
              }
          }
    );
    }

    function sinkronstok() {
        alert('sinkron');
        $('#sinkronstok').addClass('fa-spin');
        $('#labelsinkron').removeClass('red');
        $('#labelsinkron').removeClass('green');

        $('#labelsinkron').html('LOADING...');
        $('#labelsinkron').addClass('orange');
        $.ajax({
              type:"post",
              url: "<?php echo base_url('adminstand/sinkronstokbahan')?>/",
              data:{ sst:"sinkron"},
              dataType:"text",
              success:function(response)
              {
                $('#labelsinkron').removeClass('orange');
                if (response == 'CANTCONNECT') {
                    $('#labelsinkron').html('KONEKSI ERROR!');
                    $('#labelsinkron').addClass('red');
                }else if (response == 'SUCCESSSAVE') {
                    $('#labelsinkron').html('SINKRONISASI STOK SUKSES!');
                    $('#labelsinkron').addClass('green');
                }else{
                    $('#labelsinkron').html('PENYIMPANAN GAGAL!');
                    $('#labelsinkron').addClass('red');
                }
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                alert(errorThrown);
              },
              complete: function(){
                $('#sinkronstok').removeClass('fa-spin');
              }
          }
    );
    }

    function changeshift() {
        if ($('#buttonshift').val() == 'pagi') {
            var send = 'malam';
        }else{
            var send = 'pagi';
        }

        $.ajax({
              type:"post",
              url: "<?php echo base_url('adminstand/setshift')?>/",
              data:{ sst:"sinkron",shift:send},
              dataType:"text",
              success:function(response)
              {
                if (response == 'SUCCESS') {
                    // $('#buttonshift').removeClass('btn-warning');
                    // $('#buttonshift').removeClass('btn-secondary');
                    // if ($('#buttonshift').val() != 'pagi') {
                    //     $('#buttonshift').html('<i class="fa fa-sun-o"></i><span> Shift Pagi</span>');
                    //     $('#buttonshift').addClass('btn-warning');
                    //     $('#buttonshift').val('pagi');
                    // }else{
                    //     $('#buttonshift').html('<i class="fa fa-moon-o"></i><span> Shift Malam</span>');
                    //     $('#buttonshift').addClass('btn-secondary');
                    //     $('#buttonshift').val('malam');
                    // }
                    $('#buttonshift').removeClass('btn-success');
                    location.reload();
                }else{
                    alert('GAGAL UBAH MODE SHIFT');
                }
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                alert(errorThrown);
              },
              complete: function(){
              }
          }
        );
        
    }

    
</script>
<style type="text/css">
.red{
    color: red !important;
}
.green{
    color: green !important;
}
.orange{
    color: orange !important;
}
.center {
    margin: auto;
    padding: 10px;
}
</style>
<body onload="shiftcheck()">
    <div class="header" id="header">
        <div class="col-md-6 col-sm-12">
            <div class="header-left" >
                <img class="navbar-brand" align="left" src=<?php echo base_url("images/logo.png")?>>
                <!-- <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">KASIR <i class="fa fa-caret-down"></i></a>
                    <div class="dropdown-menu">
                        <a class="nav-link" href=<?php echo base_url("kasir")?>>Kasir</a>
                        <a class="nav-link" href=<?php echo base_url("voidnota")?>>Void Nota</a>
                    </div>
                </div> -->
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">STOK <i class="fa fa-caret-down"></i></a>
                    <div class="dropdown-menu">
                        <a class="nav-link" href=<?php echo base_url("stokperhari")?>>Stok Hari Ini</a>
                        <a class="nav-link" href=<?php echo base_url("historistok")?>>Histori Stok</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">KAS <i class="fa fa-caret-down"></i></a>
                    <div class="dropdown-menu">
                        <!-- <a class="nav-link" href=<?php echo base_url("kasawal")?>>Kas Awal</a> -->
                        <a class="nav-link" href=<?php echo base_url("pengeluaranlain")?>>Pengeluaran Lain</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ORDER <i class="fa fa-caret-down"></i></a>
                    <div class="dropdown-menu">
                        <a class="nav-link" href=<?php echo base_url("order")?>>Buat Order Baru</a>
                        <a class="nav-link" href=<?php echo base_url("listorder")?>>List Order</a>
                    </div>
                </div>
                <!-- <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">REKAP <i class="fa fa-caret-down"></i></a>
                    <div class="dropdown-menu">
                        <a class="nav-link" href=<?php echo base_url("rekapdata")?>>Rekap Keuangan Hari ini</a>
                        <a class="nav-link" href=<?php echo base_url("rekapproduk")?>>Rekap Penjualan Produk</a>
                    </div>
                </div> -->
                
                
            </div>
        </div>
        <div class="col-md-6">
            <div class="header-right">

                <div class="dropdown float-right">
                    <a class="" href="logout"><i class="fa fa-power-off"></i> Logout</a>
                    <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Rio Christian</i></a>
                    <div class="dropdown-menu">
                        <a class="nav-link" href="#"><i class="fa fa-cog"></i> Ganti Password</a>
                        <a class="nav-link" href="logout"><i class="fa fa-power-off"></i> Logout</a>
                    </div> -->
                </div>
                <div class="dropdown float-right">
                    <a class="" href="presensi"><i class="fa fa-address-card"></i> Presensi</a>
                </div>
                <!-- <div style="margin: auto !important;">
                    <button  onclick="sinkronnota()" class=" dropdown float-right btn btn-md btn-success">
                        <a style="color: white;"><i class="fa fa-refresh" id="sinkronnota"></i> SYNC NOTA</a>
                    </button>
                </div> -->
                
                <div style="margin: auto !important;">
                    <button  onclick="sinkronstok()" class=" dropdown float-right btn btn-md btn-success">
                        <a style="color: white;"><i class="fa fa-refresh" id="sinkronstok"></i> SYNC STOK</a>
                    </button>
                </div>

                <div style="margin: auto !important;">
                    <button id="buttonshift" onclick="changeshift()"  class=" dropdown float-right  btn btn-md btn-success" value="pagi">
                        <i class="fa fa-question"></i>
                        <span>Shift ....</span>
                    </button>
                </div>
                

                <!-- <button onclick="sinkronpresensi()" class="dropdown float-right active btn btn-lg">
                    <a style="color: white;"><i class="fa fa-refresh" id="sinkronpresensi"></i> SINKRON PRESENSI</a>
                </button> -->
                <p class="center float-right" id="labelsinkron"></p>
            </div>
        </div>
    </div>