<?php
$page_info = [
  'title' => "Biografia",
  'section' => 'biografia',
  'canonical' => "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
  'image' => "http://{$_SERVER['HTTP_HOST']}/public/style/logo.png",
  'description' => "Biografia e note storiche del Coro della Joska del Liceo Scientifico Statale P. Paleocapa di Rovigo.",
  'show_header_image' => true
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
    <header class="header-image">
      <?php $this->view('frontend/header', $page_info); ?>
    </header>

    <main class="container">
      <div class="row">
        <!-- Main content -->
        <div class="col-md-8 col-lg-9">
          <section>
            <h2>Biografia</h2>
            <p>Il Coro della Joska nasce nella primavera del 1994 a seguito di un&rsquo;esibizione fuori programma alla Rotonda, durante un concerto di allievi del Liceo Scientifico P. Paleocapa iscritti al Conservatorio. Dato il grande successo riscontrato da questa prima esibizione ne susseguirono altre in occasione di eventi legati alla comunit&agrave; rodigina, festivit&agrave; o, pi&ugrave; frequentemente, di avvenimenti legati al Liceo, al quale il Coro appartiene da sempre poich&eacute; il primo a dirigerlo fu Claudio Garbato, ex professore di Lettere dell&rsquo;Istituto.</p>
            <p>
              <img src="/public/content/biografia.jpg" alt="Il coro nel 2008" title="Il coro a Viernheim nel 2008" class="img-responsive center-block">
              <small class="text-center center-block">Il coro a Viernheim nel 2008</small>
            </p>

            <p>Il professor Garbato diresse il Coro dalla sua nascita sino al 2003 quando Davide Dainese, ex alunno e corista appassionato al gruppo, lo sostitu&igrave; e ne &egrave; tuttora il direttore.</p>

            <p>Il nome del Coro nasce da una canzone, <em>Joska la Rossa</em> (1968, dall&rsquo;album <em>Voci della Montagna</em>, Vol. 1) di Giuseppe de Marzi, detto &ldquo;Bepi&rdquo; (musicista, compositore e direttore del coro italiano <em>I Crodaioli</em>). La canzone si schiera contro la guerra e le parole sono ispirate ad alcune testimonianze vere e alle storie inventate dai sopravvissuti alle campagne di Grecia e di Russia durante la Seconda Guerra Mondiale.</p>

            <p>Joska &egrave; una ragazza russa che ha compassione di questi uomini lontani dalle loro case, dalle loro donne: mogli, madri, figlie, sorelle, fidanzate. Allora si sostituisce a tutte queste figure femminili per alleviare la malinconia degli alpini. E alla fine sar&agrave; ancora una volta Joska a dare ai poveri uomini una pietosa sepoltura nella fredda terra russa.</p>

            <p>Il Coro &egrave; composto da alunni e da ex alunni del Liceo rimasti affezionati al gruppo.</p>

            <p>Il repertorio si basa principalmente su canti d&rsquo;autore (De Marzi, Malatesta), alpini, popolari, polesani e religiosi. Il Coro si esibisce annualmente al Liceo per il concerto di Natale, a dicembre, e per il concerto di fine anno, a maggio o giugno. Esibizioni extra possono avvenire per la partecipazione a concorsi o per occasioni alle quali viene richiesta la presenza del Coro.</p>

            <p>Il Coro della Joska si avvale di una propria divisa, contrassegnata da uno stemma.</p>

            <p>Il gruppo si ritrova ogni sabato durante il periodo scolastico nell&rsquo;auditorium del Liceo Scientifico P. Paleocapa (Via Alcide de Gasperi 19) dalle 13:30 alle 14:30.</p>

            <h3>La Sede</h3>
            <div class="row">
              <div class="col-lg-7">
                <p>Dall'anno 2006 il coro ha la sua sede presso l'auditorium del Liceo Scientifico Statale P. Paleocapa, presso il quale spesso si esibisce in occasione di incontri o convegni promossi dall'istituto.</p>
                <p>Il coro prova ogni sabato dalle 13.30 alle 14.30 nell'auditorium del Liceo Scientifico Statale P. Paleocapa di Rovigo (via Alcide de Gasperi 19) durante il periodo scolastico, da ottobre a giugno.</p>
                <p>Le prove settimanali sono aperte a chiunque sia interessato ad ascoltare o partecipare attivamente alle attività corali.</p>
              </div>
              <div class="col-lg-5">
                <img src="/public/content/sede.jpg" alt="Auditorium del Liceo Scientifico P. Paleocapa di Rovigo" title="Auditorium del Liceo Scientifico P. Paleocapa di Rovigo" class="img-responsive">
                <div class="text-center"><small>Zanella, Marco. "La sede del coro" 2012. JPEG file.</small></div>
              </div>
            </div>
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
