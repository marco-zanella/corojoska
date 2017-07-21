<?php
$page_info = [
  'title' => "Blog",
  'section' => 'home',
  'canonical' => "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
  'image' => null,
  'description' => "Blog del Coro della Joska, con gli articoli e gli interventi dei coristi.",
  'show_header_image' => true
];

$breadcrumb = [
  ['Homepage', '/'],
  'Blog'
];

$previous_disabled = ($page <= 1) ? ' class="disabled"' : '';
$next_disabled = ($page >=  $pages) ? ' class="disabled"' : '';
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
      <?php $this->view('frontend/header', $page_info); ?>
    </header>

    <main class="container">
      <div class="row">
        <!-- Main content -->
        <?php $this->view('widgets/breadcrumb', ['pages' => $breadcrumb]); ?>
        <div class="col-md-8 col-lg-9">
          <section>
            <h2>Blog - pagina <?= $page ?></h2>

            <!-- Pager -->
            <nav aria-label="Page navigation" class="text-center">
              <ul class="pagination">
                <li<?= $previous_disabled?>>
                  <a href="/blog?page=<?= $previous_page ?>&page_size=<?= $page_size ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <?php for ($i = 1; $i <= $pages; ++$i): ?>
                <li<?= ($i == $page ? ' class="active"' : '') ?>>
                  <a href="/blog?page=<?= $i ?>&page_size=<?= $page_size ?>"><?= $i ?></a>
                </li>
                <?php endfor; ?>
                <li<?= $next_disabled ?>>
                  <a href="/blog?page=<?= $next_page ?>&page_size=<?= $page_size ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>

            <!-- Blog posts -->
            <?php foreach ($posts as $post): ?>
            <div class="well well-sm">
              <?php $this->view('widgets/post-list-item', ['post' => $post]); ?>
            </div>
            <?php endforeach; ?>

            <!-- Pager -->
            <nav aria-label="Page navigation" class="text-center">
              <ul class="pagination">
                <li<?= $previous_disabled?>>
                  <a href="/blog?page=<?= $previous_page ?>&page_size=<?= $page_size ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <?php for ($i = 1; $i <= $pages; ++$i): ?>
                <li<?= ($i == $page ? ' class="active"' : '') ?>>
                  <a href="/blog?page=<?= $i ?>&page_size=<?= $page_size ?>"><?= $i ?></a>
                </li>
                <?php endfor; ?>
                <li<?= $next_disabled ?>>
                  <a href="/blog?page=<?= $next_page ?>&page_size=<?= $page_size ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>
          </section>
        </div>

        <!-- Aside and various widgets -->
        <aside class="col-md-4 col-lg-3">
          <?php $this->view('frontend/aside', $_variables); ?>
        </aside>
      </div>
    </main>


    <!-- Footer -->
    <footer>
      <?php $this->view('frontend/footer'); ?>
    </footer>

    <?php $this->view('scripts'); ?>
  </body>
</html>
