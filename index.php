<?php

spl_autoload_register(function($class) { require_once str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php'; });

$config = new \lib\Configuration();

?>
<!DOCTYPE html>
<html lang="<?php echo $config->getLanguage() ?>">
<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars( $config->getTitle() ) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow, noarchive, noimageindex">

    <link href='https://fonts.googleapis.com/css?family=Alegreya+Sans:100,300,400&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="screen.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="lib.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            wishlist.Main.init();
        });
    </script>

    <?php if ( null !== $config->getAnalytics() ): ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $config->getAnalytics()["id"] ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '<?php echo $config->getAnalytics()["id"] ?>');
    </script>
    <?php endif; // if ( null !== $config->getAnalytics() ) ?>
</head>
<body>

<header>
    <h1>Wishlist</h1>

    <nav>
        <ul id="wishlist-selection">
            <li data-id="<?php echo $config->getName(0)['id'] ?>"><?php echo $config->getName(0)['name'] ?></li><li data-id="<?php echo $config->getName(1)['id'] ?>"><?php echo $config->getName(1)['name'] ?></li>
        </ul>
    </nav>
</header>

<main>

<section id="home" class="page">
    <blockquote>
        <?php echo htmlspecialchars( $config->getQuote()['text'] ) ?>
        <cite><?php echo htmlspecialchars( $config->getQuote()['cite'] ) ?></cite>
    </blockquote>

    <?php if ( is_array( $config->getIntro()['text'] ) ):
          foreach ( $config->getIntro()['text'] as $paragraph ): ?>
    <p><?php echo $paragraph ?></p>
    <?php endforeach;
          else: ?>
    <p><?php echo $config->getIntro()['text'] ?></p>
    <?php endif; ?>
    <p class="signature"><?php echo htmlspecialchars( $config->getIntro()['signature'] ) ?></p>
</section>

<?php foreach ( $config->getWishlists() as $wishlist => $items ): ?>
<section id="wishlist-<?php echo $wishlist ?>" class="wishlist">
    <ul>
<?php foreach ( $items as $item ): if ( !$item['claimed'] ): ?><li><article id="item-<?php echo $item['id'] ?>">
            <img src="<?php echo $item['image'] ?>" alt="<?php echo $item['name'] ?>">
            <h2><?php echo $item['name'] ?></h2>

            <?php if ( isset( $item['features'] ) ): ?>
            <ul>
            <?php foreach ( $item['features'] as $feature ): ?>
                <li><?php echo $feature ?></li>
            <?php endforeach; // foreach ($item['features'] as $feature) ?>
            </ul>
            <?php endif; ?>

            <footer>
                <?php if ( null !== $item['link'] ): ?>
                <a href="<?php echo $item['link'] ?>" class="check-out">Check It Out!</a>
                <?php endif; ?>
                <?php if ( !isset($item['claimable'] ) || $item['claimable']): ?>
                <a href="/actions.php?action=claim&amp;id=<?php echo $item['id'] ?>" class="claim" data-tooltip="Claiming will remove it from the list, so that nobody else can choose it.">Claim It!</a>
                <?php endif; ?>
            </footer>
        </article></li><?php endif; endforeach; // foreach ($items as $item) ?>
    </ul>
</section>
<?php endforeach; // foreach ($wishlists as $wishlist => $items) ?>

</main>

<footer id="page-footer">
    Made in Warsaw, by <a href="http://michal.paluchowski.com/about/">Michał Paluchowski</a>. <a href="https://github.com/mpaluchowski/wishlist-couple">Source code</a> is under a <a href="http://creativecommons.org/licenses/by/4.0/" rel="license">Creative Commons Attribution 4.0 International License</a>. Make something cool.
</footer>

</body>
</html>
