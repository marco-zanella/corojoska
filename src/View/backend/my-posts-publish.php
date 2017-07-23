<?php
$page_info = [
  'title' => "I miei Articoli",
  'canonical' => "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
  'image' => null,
  'description' => "Coro giovanile di ispirazione popolare della città di Rovigo che trae il proprio nome dal canto \"Joska, la Rossa!\"."
];
?>
<!DOCTYPE html>
<html>
  <head>
    <?php $this->view('head', $page_info); ?>
  </head>

  <body>
    <div class="container">
      <div class="page-header">
        <h1><?= $page_info['title'] ?></h1>
      </div>

      <div class="row">
        <aside class="col-sm-3">
          <?php $this->view('backend/menu', $_variables); ?>
        </aside>

        <div class="col-sm-9">
          <section>
            <h2>Vuoi pubblicare l'articolo sulla pagina Facebook?</h2>
            <p>Il tuo articolo è stato pubblicato sul sito. Desideri pubblicarlo anche sulla pagina Facebook?</p>
            
            <div class="btn-group" role="group">
              <a href="#" class="btn btn-primary" title="Pubblica anche sulla pagina Facebook" id="publishFacebook">Pubblica sulla pagina Facebook</a>
              <a href="/my-posts" class="btn btn-default" title="Non pubblicare">Non pubblicare</a>
            </div>

            <div id="published" class="hidden">
              <?php $this->view('widgets/alert', ['class' => 'success', 'content' => 'Il tuo articolo è stato pubblicato sulla pagina Facebook. Puoi tornare ai <a href="/my-posts">tuoi articoli</a>.']); ?>
            </div>
          </section>
        </div>
      </div>
    </div>

  <?php $this->view('scripts'); ?>
  <?php $this->view('backend/facebook-javascript-sdk'); ?>
  <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
  <script>
    // Publish on facebook
    function requireLogin(callback) {
      FB.getLoginStatus(function (response) {
        if (response.status === 'connected') {
          callback();
        } else {
          FB.login(callback);
        }
      });
    }

    function publishPost(content) {
      requireLogin(function () {
        FB.api('/corojoska', 'get', { fields: 'access_token' }, function (response) {
          var page_access_token = response.access_token;
          content.access_token = page_access_token;
          FB.api('/corojoska/feed', 'post', content);
        });
      });
    }

    $(function () {
      $('#publishFacebook').click(function (event) {
        var params = {
          message: "<?= str_replace(["\n", "\r\n", "\r"], " ", strip_tags($post->content)) ?>",
          link: "<?= "http://{$_SERVER['HTTP_HOST']}/blog/" . $post->id ?>"
        };
        publishPost(params);
        $(this).attr('disabled', 'disabled');
        $(this).click(function (e) { e.preventDefault(); });
        $('#published').removeClass('hidden');
      });
    });
  </script>
  </body>
</html>
