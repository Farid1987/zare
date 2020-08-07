<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zare</title>

  <link rel="shortcut icon" href="<?= base_url()?>/assets/img/logo-zare.png" />
  <?php 
  if (isset($css_to_load)) {
    foreach ($css_to_load as $link) { 
  ?>
      <link rel="stylesheet" href="<?= $link?>">
  <?php 
    } 
  }
  ?>
  <link rel="stylesheet" href="<?= base_url()?>/assets/css/main.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
  <header class="header header-fixed <?= (isset($header_class) ? $header_class:'')?>">
    <div class="container flex items-center justify-between">
      <div class="header-left">
        <a href="" class="header-logo">
          <img src="<?= base_url()?>/assets/img/logo-zare.png" alt="">
        </a>
      </div>
      <div class="header-right flex items-center">
        <ul class="header-menu flex items-center">
          <li class="header-menu__item active"><a href="">HOME</a></li>
          <li class="header-menu__item"><a href="">ABOUT US</a></li>
          <li class="header-menu__item"><a href="<?= site_url('frontPage/products')?>">PRODUCT</a></li>
          <li class="header-menu__item"><a href="">EVENT</a></li>
          <li class="header-menu__item"><a href="">BLOG</a></li>
          <li class="header-menu__item"><a href="">CONTACT US</a></li>
        </ul>
        <a href="" class="btn btn-primary btn-rounded">MASUK</a>
        <div class="toggle-menu show-mobile">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
  </header>

  <?php echo $contents; ?>

  <footer class="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-md col-6">
            <a href="" class="footer-logo">
              <img src="<?= base_url()?>/assets/img/logo-zare.png" alt="">
            </a>
            <span class="footer-logo__caption">We Grow The Nation</span>
          </div>
          <div class="col-md-auto col-6">
            <div class="footer-menu__wrapper">
              <div class="footer-menu__title">MENU</div>
              <ul class="footer-menu">
                <li><a href="">Home</a></li>
                <li><a href="<?= site_url('frontPage/products')?>">Product</a></li>
                <li><a href="">About Us</a></li>
                <li><a href="">Contact Us</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-auto col-6">
            <div class="footer-menu__wrapper">
              <div class="footer-menu__title">BLOG</div>
              <ul class="footer-menu">
                <li><a href="">Lorem ipsum dolor sit</a></li>
                <li><a href="">Lorem ipsum dolor sit</a></li>
                <li><a href="">Lorem ipsum dolor sit</a></li>
                <li><a href="">Lorem ipsum dolor sit</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-auto col-6">
            <div class="footer-menu__wrapper">
              <div class="footer-menu__title">Social Media</div>
              <ul class="footer-menu">
                <li><a href="" target="__blank">Facebook</a></li>
                <li><a href="" target="__blank">Instagram</a></li>
                <li><a href="" target="__blank">Youtube</a></li>
                <li><a href="">Blog</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <div class="copyright">
          CopyRight © 2019 Zare Indonesia. Made with ton of loves
          <img src="<?= base_url()?>/assets/img/footer-love.svg" alt="">
        </div>
      </div>
    </div>
  </footer>

  <?php 
  if (isset($js_to_load)) {
    foreach ($js_to_load as $link) { 
  ?>
      <script src="<?= $link?>"></script>
  <?php 
    } 
  }
  ?>
  <script src="<?= base_url()?>/assets/js/main.min.js"></script>  
</body>
</html>