<?php

include("./data/config.inc.php");

?>
<!DOCTYPE html>
<html lang="<?php echo $language ?>">
<head>
	<meta charset="utf-8">
	<title><?php echo htmlspecialchars( $title ) ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex, nofollow, noarchive, noimageindex">

	<link href='//fonts.googleapis.com/css?family=Alegreya+Sans:100,300,400&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="screen.css">

	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script src="lib.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			wishlist.Main.init();
		});
	</script>
</head>
<body>

<header>
	<h1>Wishlist</h1>

	<nav>
		<ul id="wishlist-selection">
			<li data-id="<?php echo $names[0]['id'] ?>"><?php echo $names[0]['name'] ?></li><li data-id="<?php echo $names[1]['id'] ?>"><?php echo $names[1]['name'] ?></li>
		</ul>
	</nav>
</header>

<main>

<section id="home" class="page">
	<blockquote>
		<?php echo htmlspecialchars( $quote['text'] ) ?>
		<cite><?php echo htmlspecialchars( $quote['cite'] ) ?></cite>
	</blockquote>

	<p><?php echo $intro['text'] ?></p>
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

<footer id="page-footer">
	Made in Warsaw, by <a href="http://michal.paluchowski.com/about/">Michał Paluchowski</a>. <a href="https://github.com/mpaluchowski/wishlist-couple">Source code</a> is under a <a href="http://creativecommons.org/licenses/by/4.0/" rel="license">Creative Commons Attribution 4.0 International License</a>. Make something cool.
</footer>

</body>
</html>