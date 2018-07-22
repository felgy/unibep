<!doctype html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="../../styles/common.css">
</head>
<body>
<header>
    <div class="brand center">
        <a href="/"><h1 class="brand-name">Unibep</h1></a>
        <span class="brand-title">Būvniecības firma</span>
    </div>
    <div class="nav center">
        <ul>
            <li><a href="/employee">Personāls</a></li>
            <li><a href="/objects">Objekti</a></li>
            <li><a href="/materials">Materiāli</a></li>
            <li><a href="/tech">Tehnika</a></li>
            <li><a href="/instruments">Instrumenti</a></li>
            <li><a href="/reports">Atskaites</a></li>
            <li><a href="/contacts">Kontakti</a></li>
        </ul>
    </div>
</header>
<main class="center">
    <?php echo $content; ?>
</main>
<footer>

</footer>
</body>
</html>