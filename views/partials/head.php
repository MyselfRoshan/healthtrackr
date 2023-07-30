<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <title>Health Trackr</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png" />
    <link rel="manifest" href="/site.webmanifest" />
    <!-- End of Favicon -->

    <!-- Css -->
    <link rel="stylesheet" href="/resources/css/main.css" />
    <!-- End of Css -->

    <!-- Scripts -->
    <?php if (isset($scripts) && count($scripts) > 0) : ?>
        <?php foreach ($scripts as $scriptBody) : ?>
            <script defer <?= $scriptBody ?>"></script>
        <?php endforeach ?>
    <?php endif ?>

    <?php
    /*  if (isset($scripts) && count($scripts) > 0)
                foreach ($scripts as $script) {
                    echo  $script;
                }  */
    ?>
    <!-- End of Scripts -->
</head>