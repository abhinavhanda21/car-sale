<?php
	$page = "home";
	if (isset($_GET["p"])) {
		//se for passar só o nome
		$page = trim($_GET["p"]);

		//Include GP config file && User class
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

	<footer>
		<div class="container">
			<span class="pull-left">
				<img src="imgs/logo.png" alt="Car Sale">
				Dang Car House
			</span>
			<span class="pull-right">
				This is an open source project
			</span>
		</div>
	</footer>
</body>
</html>


<?
include_once 'gpConfig.php';
include_once 'User.php';

if(isset($_GET['code'])){
    $gClient->authenticate($_GET['code']);
    $_SESSION['token'] = $gClient->getAccessToken();
    header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
    $gClient->setAccessToken($_SESSION['token']);
}

if ($gClient->getAccessToken()) {
    //Get user profile data from google
    $gpUserProfile = $google_oauthV2->userinfo->get();
    
    //Initialize User class
    $user = new User();
    
    //Insert or update user data to the database
    $gpUserData = array(
        'oauth_provider'=> 'google',
        'oauth_uid'     => $gpUserProfile['id'],
        'first_name'    => $gpUserProfile['given_name'],
        'last_name'     => $gpUserProfile['family_name'],
        'email'         => $gpUserProfile['email'],
        'gender'        => $gpUserProfile['gender'],
        'locale'        => $gpUserProfile['locale'],
        'picture'       => $gpUserProfile['picture'],
        'link'          => $gpUserProfile['link']
    );
    $userData = $user->checkUser($gpUserData);
    
    //Storing user data into session
    $_SESSION['userData'] = $userData;
    
    //Render facebook profile data
    if(!empty($userData)){
        $output = '<h1>Google+ Profile Details </h1>';
        $output .= '<img src="'.$userData['picture'].'" width="300" height="220">';
        $output .= '<br/>Google ID : ' . $userData['oauth_uid'];
        $output .= '<br/>Name : ' . $userData['first_name'].' '.$userData['last_name'];
        $output .= '<br/>Email : ' . $userData['email'];
        $output .= '<br/>Gender : ' . $userData['gender'];
        $output .= '<br/>Locale : ' . $userData['locale'];
        $output .= '<br/>Logged in with : Google';
        $output .= '<br/><a href="'.$userData['link'].'" target="_blank">Click to Visit Google+ Page</a>';
        $output .= '<br/>Logout from <a href="logout.php">Google</a>'; 
    }else{
        $output = '<h3 style="color:red">Some problem occurred, please try again.</h3>';
    }
} else {
    $authUrl = $gClient->createAuthUrl();
    $output = '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'"><img src="images/glogin.png" alt=""/></a>';
}
?>

<div><?php echo $output; ?></div>
