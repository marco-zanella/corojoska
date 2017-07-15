<ul class="breadcrumb">
  <?php
  for ($i = 0; $i < count($pages); ++$i):
    $page = $pages[$i];
    echo "<li" . ($i == count($pages) - 1 ? ' class="active"' : '') . ">";

    if (is_string($page)):
      echo $page;
    elseif (is_array($page) && count($page) >= 2):
      echo '<a href="' . $page[1] . '" title="' . $page[0] .'">' . $page[0] .'</a>';
    endif;
    echo "</li>";
  endfor;
  ?>
</ul>
