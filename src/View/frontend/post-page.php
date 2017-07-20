<?php
$page_info = [
  'title' => $post->title,
  'section' => 'home',
  'canonical' => "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
  'image' => $post->image,
  'description' => $post->getSummary(),
  'show_header_image' => false
];

$breadcrumb = [
  ['Homepage', '/'],
  ['Blog', '/blog'],
  $post->title
];
?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <?php $this->view('head', $page_info); ?>
    <?php $this->view('frontend/head'); ?>
  </head>

  <body>
    <!-- Navbar -->
    <?php $this->view('frontend/navbar', $page_info); ?>
    <!-- Page header -->
    <header class="header-image" style="background-image: url('/<?= $post->image ?>'); background-size: cover;">
      <?php $this->view('frontend/header', $page_info); ?>
    </header>

    <div class="container background-white">
      <div class="row">
        <!-- Main content -->
        <?php $this->view('widgets/breadcrumb', ['pages' => $breadcrumb]); ?>
        <div class="col-md-8 col-lg-9">
          <h2><?= $post->title ?></h2>
          <div><?= $post->content ?></div>
          <p class="text-right">
            <small>Pubblicato il <time><?= date('d/m/Y, H:i', strtotime($post->created_at)) ?></time></small>
          </p>
        </div>

        <!-- Aside and various widgets -->
        <aside class="col-md-4 col-lg-3">
          <?php $this->view('frontend/aside', $_variables); ?>
        </aside>
      </div>
    </div>


    <!-- Footer -->
    <footer>
      <?php $this->view('frontend/footer'); ?>
    </footer>

    <?php $this->view('scripts'); ?>
  </body>
</html>
