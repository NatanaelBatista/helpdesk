<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>HelpDesk - <?php echo $title; ?></title>

  <!-- ícone -->
  <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url(); ?>assets/icone/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url(); ?>assets/icone/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>assets/icone/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url(); ?>assets/icone/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>assets/icone/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url(); ?>assets/icone/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url(); ?>assets/icone/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url(); ?>assets/icone/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url(); ?>assets/icone/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url(); ?>assets/icone/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url(); ?>assets/icone/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url(); ?>assets/icone/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/icone/favicon-16x16.png">
  <link rel="manifest" href="<?php echo base_url(); ?>assets/icone/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="<?php echo base_url(); ?>assets/icone/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <!-- Bootstrap core CSS-->
  <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="<?php echo base_url(); ?>assets/css/sb-admin.css" rel="stylesheet">

  <style type="text/css">
    <?php 

      if($_SESSION['usuario_acesso'] != 2)
      {
        echo '.gerencial
        {
          display: none;
        }';
      }

     ?>
    @media (max-width: 768px) {
      .incident_search
      {
        display: none;
      }
    }

    .conteudo{
      font-size: 11pt;
    }

    ul.download{
      list-style: none;
      margin: 0;
      padding: 0;
    }
    ul.download li{
      list-style: none;
      margin: 0;
      padding: 0;
    }
    ul.download img{
      padding-right: 20px;
      height: 100px;
    }
    .paginacao li{
      padding: 0;
    }
    .paginacao li a{
      display: block;
      padding: 8px;
    }
    .paginacao li a:hover{
      text-decoration: none;
    }
  </style>
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">