<!DOCTYPE html>
<html lang="es">
	<head>
		<!-- META -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
		<meta name="mobile-web-app-capable" content="yes">
		<meta name="msapplication-TileColor" content="#00ba8b">
		<meta name="msapplication-TileImage" content="<?= base_url('assets/icons/ms-icon-144x144.png') ?>">
		<meta name="theme-color" content="#00ba8b">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		
		<!-- LINK -->
		<link rel="apple-touch-icon" sizes="57x57" href="<?= base_url('assets/icons/apple-icon-57x57.png') ?>">
		<link rel="apple-touch-icon" sizes="60x60" href="<?= base_url('assets/icons/apple-icon-60x60.png') ?>">
		<link rel="apple-touch-icon" sizes="72x72" href="<?= base_url('assets/icons/apple-icon-72x72.png') ?>">
		<link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/icons/apple-icon-76x76.png') ?>">
		<link rel="apple-touch-icon" sizes="114x114" href="<?= base_url('assets/icons/apple-icon-114x114.png') ?>">
		<link rel="apple-touch-icon" sizes="120x120" href="<?= base_url('assets/icons/apple-icon-120x120.png') ?>">
		<link rel="apple-touch-icon" sizes="144x144" href="<?= base_url('assets/icons/apple-icon-144x144.png') ?>">
		<link rel="apple-touch-icon" sizes="152x152" href="<?= base_url('assets/icons/apple-icon-152x152.png') ?>">
		<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/icons/apple-icon-180x180.png') ?>">
		<link rel="icon" type="image/png" sizes="192x192"  href="<?= base_url('assets/icons/android-icon-192x192.png') ?>">
		<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/icons/favicon-32x32.png') ?>">
		<link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('assets/icons/favicon-96x96.png') ?>">
		<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/icons/favicon-16x16.png') ?>">
		<link rel="manifest" href="<?= base_url('assets/icons/manifest.json') ?>">
		
		<title>Sanatorio Las Lomas</title>
	
		<link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
		<link href="<?=base_url('assets/css/bootstrap-responsive.min.css')?>" rel="stylesheet">
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
		<link href="<?=base_url('assets/css/font-awesome.css')?>" rel="stylesheet">
		<link href="<?=base_url('assets/css/fullcalendar.css')?>" rel="stylesheet">
		<link href="<?=base_url('assets/css/pages/dashboard.css')?>" rel="stylesheet">	
		<link href="<?php if ($page == 'login') { echo base_url('assets/css/pages/signin.css'); } ?>" rel="stylesheet">
		<link href="<?=base_url('assets/css/style.css')?>" rel="stylesheet">
		
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
<body>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="/_hcdigital_visor/">Historia Cl&iacute;nica Digital </a>
			
					<!--<div class="nav-collapse">
						<ul class="nav pull-right">						
							<li class=""><a href="register" class="">No tiene cuenta?</a></li>
							<li class=""><a href="/" class=""><i class="icon-chevron-left"></i>Volver a Pagina de Inicio</a></li>
						</ul>				
					</div>--><!--/.nav-collapse -->	
					
				<?php if ($this->session->userdata('login') != null) : ?>
					<div class="nav-collapse">
						<ul class="nav pull-right">
							<!--<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i> Cuenta <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="javascript:;">Configuracion</a></li>
									<li><a href="javascript:;">Ayuda</a></li>
								</ul>
							</li>-->						
							<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> Dr. <?=$this->session->userdata('username') ?> <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="#">Perfil</a></li>
									<li><a href="user/logout">Salir</a></li>
								</ul>
							</li>
						</ul>
						<!--<form class="navbar-search pull-right">
							<input type="text" class="search-query" placeholder="Buscar Paciente">
						</form>-->
					</div>
				<?php endif; ?>
				<!--/.nav-collapse --> 
			</div>
			<!-- /container --> 
		</div>
		<!-- /navbar-inner --> 
	</div>
	<!-- /navbar -->
	
	