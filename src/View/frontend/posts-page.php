<?php
$page_info = [
  'title' => "Blog",
  'section' => 'home',
  'canonical' => "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
  'image' => null,
  'description' => "Blog del Coro della Joska, con gli articoli e gli interventi dei coristi."
];

$breadcrumb = [
  ['Homepage', '/'],
  'Blog'
];

$previous_url = ($page > 1) ? '/blog?page=' . ($page - 1) : '/blog?page=' . $page;
$next_url = (count($posts) == $page_size) ? '/blog?page=' . ($page + 1) : '/blog?page=' . $page;

$previous_disabled = ($page <= 1) ? ' disabled' : '';
$next_disabled = (count($posts) < $page_size) ? ' disabled' : '';
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
    <header class="header-image">
      <?php $this->view('frontend/header'); ?>
    </header>

    <div class="container background-white">
      <div class="row">
        <!-- Main content -->
        <?php $this->view('widgets/breadcrumb', ['pages' => $breadcrumb]); ?>
        <div class="col-md-8 col-lg-9">
          <section>
            <h2>Blog - pagina <?= $page ?></h2>

            <!-- Pager -->
            <nav aria-label="...">
              <ul class="pager">
                <li class="previous<?= $previous_disabled ?>"><a href="<?= $previous_url ?>">&larr; Più recenti</a></li>
                <li class="next<?= $next_disabled ?>"><a href="<?= $next_url ?>">Meno recenti &rarr;</a></li>
              </ul>
            </nav>

            <?php foreach ($posts as $post): ?>
            <div class="well well-sm">
              <?php $this->view('widgets/post-list-item', ['post' => $post]); ?>
            </div>
            <?php endforeach; ?>

            <!-- Pager -->
            <nav aria-label="...">
              <ul class="pager">
                <li class="previous<?= $previous_disabled ?>"><a href="<?= $previous_url ?>">&larr; Più recenti</a></li>
                <li class="next<?= $next_disabled ?>"><a href="<?= $next_url ?>">Meno recenti &rarr;</a></li>
              </ul>
            </nav>

          </section>
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
