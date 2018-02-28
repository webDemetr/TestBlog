<!DOCTYPE HTML>
<!--
  Landed by HTML5 UP
  html5up.net | @ajlkn
  Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
  <head>
    <title>Blog WebDemetr</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="templates/assets/css/main.css" />
    <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
  </head>
  <body>
    <div id="page-wrapper">

      <!-- Header -->
        <header id="header">
          <h1 id="logo"><a href="index.php">WebDemetr</a></h1>
          <nav id="nav">
            <ul>
              <li><a href="index.php">Home</a></li>
    <?php if (IS_ADMIN): ?>
    <li><a href="?act=logout" class="button special">Admin (logout)</a></li>
    <?php else: ?>
    <li><a href="?act=login" class="button special">Логін</a></li>
    <?php endif ?>
               </ul>
              </nav>
            </header>
          <!-- Main -->
            <div id="main" class="wrapper style1">
              <div class="container">
                <header class="major">
                  <h2>Blog</h2>
                  <p>  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor </p>
                </header>