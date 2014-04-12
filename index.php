<?php

include("./list.inc.php");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>M&amp;M Wishlist</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='//fonts.googleapis.com/css?family=Alegreya+Sans:100,300,400&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="screen.css">
</head>
<body>

<header>
	<h1>Wishlist</h1>

	<nav>
		<ul>
			<li>Milena</li><li>Michał</li>
		</ul>
	</nav>
</header>

<main>

<?php foreach ($wishlists as $wishlist => $items): ?>
	<ul id="wishlist-<?php echo $wishlist ?>">
<?php foreach ($items as $item): ?><li><article>
			<img src="<?php echo $item['image'] ?>" alt="<?php echo $item['name'] ?>">
			<h2><?php echo $item['name'] ?></h2>
			
			<ul>
			<?php foreach ($item['features'] as $feature): ?>
				<li><?php echo $feature ?></li>
			<?php endforeach; // foreach ($item['features'] as $feature) ?>
			</ul>

			<footer>
				<a href="<?php echo $item['link'] ?>" class="check-out">Check It Out!</a>
				<a href="#" class="claim">Claim It!</a>
			</footer>
		</article></li><?php endforeach; // foreach ($items as $item) ?>
	</ul>
<?php endforeach; // foreach ($wishlists as $wishlist => $items) ?>

</main>

</body>
</html>