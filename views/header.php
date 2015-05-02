<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>Dino-Build</title>
<link rel="stylesheet" type="text/css" media="all"
	href="views/css/page.css" />

<link rel='stylesheet' href='http://s.codepen.io/assets/reset/reset.css'>

<link rel='stylesheet prefetch'
	href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css'>
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="sweet-alert.min.js"></script>

</head>
<body>
<!-- HEADER -->

<div id="header">
	<div id="bar_nav" class="max">
		<div id="logo"></div>
	</div>

	<div id="boutons_haut">
		<div class="block">
			<a class="nav-boutons" id="sur_bouton" href="#nav"> <span
				style="font-size: 16px; text-align: center"></span>
			</a>
		</div>
	</div>

	<nav id="nav" role="navigation">
		<div class="block">
			<ul class="nav">
				<li id="nav-1" class="nav-menu"><a class="nav-menu-a"
					onclick="to=2;" href="index.php">ACCUEIL</a></li>
				<li id="nav-3" class="nav-menu"><a class="nav-menu-a"
					onclick="to=3;" href="index.php?action=helper">PLAN D'UP</a></li>
				<li id="nav-8" class="nav-menu"><a class="nav-menu-a"
					onclick="to=8;" href="index.php?action=contact">CONTACTS</a></li>
				<li id="nav-9" class="nav-menu"><a class="nav-menu-a"
					onclick="to=9;" href="index.php?action=info">A PROPOS</a></li>
			</ul>
		</div>
	</nav>
</div>

<!-- TITRES -->

<div id="titres_principaux">
    <div id="specs">
        <div id="titres" class="max">
            <div id="logo_moi">
                </div>
            <div id="titres_hauts">
                <h1 class="specs"></h1>
                <img src="views/images/back.png" alt="Dino-Build" />
            </div>           
        </div>
    </div>
</div>

<!-- CONTENU -->