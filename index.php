<?php
	$page = "home";
	if (isset($_GET["p"])) {
		//se for passar só o nome
		$page = trim($_GET["p"]);

		//se for mais de 1 variavel separado por /
		/*
		$page = trim($_GET["p"]);
		$page = explode('/',$page);
		//produto/123/x-bacon-com-ovo
		// 0 - pagina (produto) / 1 - codigo (123)
		// 3 - nome do produto (x-bacon-com-ovo)
		$codigo = $page[1];
		$produto = $page[2];
		$page = $page[0];

		*/
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dang Car House</title>
	<meta charset="utf-8">
	<meta name="description" content="Revenda de carros, novos e usados de alta qualidade">
	<meta name="keywords" content="carros,novos,usados,importados,ivate">
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<!-- Open Graph -->
	<meta property="og:locale" content="pt_BR">
	<meta property="og:title" content="Car Sale - Especialista em Carros Antigos e Relíquias">
	<meta property="og:description" content="Revenda de carros, novos e usados de alta qualidade">
	<meta property="og:image" content="http://pos.professorburnes.com.br/carsale/img/carsale.jpg">
	<meta property="og:image:type" content="image/jpeg">
	<meta property="og:image:width" content="800">
	<meta property="og:image:height" content="315">
	<meta property="og:type" content="website">

	<!-- Twitter Card -->
	<meta name="twitter:card" content="summary">
	<meta name="twitter:url" content="@professorburnes">
	<meta name="twitter:image" content="http://pos.professorburnes.com.br/carsale/img/carsale.jpg">
	<meta name="twitter:title" content="Car Sale - Especialista em Carros Antigos e Relíquias">

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="icon" type="image/png" href="imgs/icone.png">

	<!-- JavaScript -->
	<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrap-inputmask.min.js"></script>
	<script type="text/javascript" src="js/jqBootstrapValidation.js"></script>

	<script>
  		$(function () { 
  			$("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); 
  		});
	</script>


</head>
<body>

	<nav class="navbar navbar-default">
		<div class="container-fluid container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu"
				area-expanded="false">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" 
			id="menu">
				<ul class="nav navbar-nav">
					<li>
						<a href="index.php">Home</a>
					</li>
					<li>
						<a href="about.html">About Us</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						Vehicles <i class="caret"></i>
						</a>

						<ul class="dropdown-menu">
							<li>
								<a href="nacionais">
								National
								</a>
							</li>
							<li>
								<a href="importados">
								Imported
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="index.html">Contact</a>
					</li>
				</ul>

				<form name="form1" method="post" action="buscar" class="navbar-form navbar-right">
					<div class="input-group input-group-lg">
						<input type="text" name="busca"
						placeholder="search..."
						class="form-control">
						<span class="input-group-btn">
							<button type="submit"
							class="btn btn-default">
								<i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</form>
			</div>
		</div>
	</nav>

	<main>
	<?php
		//validar o loop
		if ($page == "index") $page = "home";
		
		// home -> home.php
		$page = "$page.php";
		//verificar se o arquivo existe
		if (file_exists($page))
			include $page;
		else
			include "erro.php";

	?>
	</main>

	<div class="clearfix"></div>

<footer id="Footer" itemscope itemtype="http://schema.org/WPFooter">
<section class="footer-bg hidden-xs">
<div class="container">
<div class="row f-btm-row f-btm-row-paddingB">
<div style="overflow:hidden" class="col-md-12">
<div class="divide-footer">

<div class="divide-footer-Heading"> Follow Us </div>
<span rel="nofollow noopener noreferrer" onclick="goToUrl('https://www.facebook.com/zigwheels','_blank');"><span class="sprite zw-head-f-social mr-10 cursorPointer"></span><span>
<span rel="nofollow noopener noreferrer" onclick="goToUrl('https://twitter.com/intent/follow?screen_name=zigwheels','_blank');"><span class="sprite zw-head-t-social mr-10 cursorPointer"></span></span>
<span rel="nofollow noopener noreferrer" onclick="goToUrl('https://plus.google.com/+zigwheels','_blank');"><span class="sprite zw-head-g-social mr-10 cursorPointer"></span></span>
<span rel="nofollow noopener noreferrer" onclick="goToUrl('http://www.youtube.com/user/zigwheels','_blank');"><span class="sprite zw-head-y-social mr-10 cursorPointer"></span></span>
</div>
</div>

<div class="f-b-txt pull-right">Copyright &copy; 2008-2018 Powered By <span onclick="goToUrl('http://girnarsoft.com/','_blank');">Girnar Software Pvt. Ltd.</span> All Rights Reserved.</div>
</div>
</div>
</footer>
</body>
</html>









