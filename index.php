<?php

include("./data/config.inc.php");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo htmlspecialchars( $title ) ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='//fonts.googleapis.com/css?family=Alegreya+Sans:100,300,400&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="screen.css">
</head>
<body>

<header>
	<h1>Wishlist</h1>

	<nav>
		<ul>
			<li><?php echo $names[0]['name'] ?></li><li><?php echo $names[1]['name'] ?></li>
		</ul>
	</nav>
</header>

<main>

<section id="home" class="page">
	<blockquote>
		<?php echo htmlspecialchars( $quote['text'] ) ?>
		<cite><?php echo htmlspecialchars( $quote['cite'] ) ?></cite>
	</blockquote>

	<p><?php echo htmlspecialchars( $intro['text'] ) ?></p>
	<p class="signature"><?php echo htmlspecialchars( $intro['signature'] ) ?></p>
</section>

<?php foreach ($wishlists as $wishlist => $items): ?>
<section id="wishlist-<?php echo $wishlist ?>" class="wishlist">
	<ul>
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
				<?php if (!isset($item['claimeable']) || $item['claimeable']): ?>
				<a href="#" class="claim">Claim It!</a>
				<?php endif; ?>
			</footer>
		</article></li><?php endforeach; // foreach ($items as $item) ?>
	</ul>
</section>
<?php endforeach; // foreach ($wishlists as $wishlist => $items) ?>

</main>

</body>
</html>