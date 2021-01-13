<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
    <?php
        $menu = Helper::getMenu();
        foreach($menu as $item)  :
    ?>
        <li>
            <?php echo Helper::simpleLink($item['path'], $item['name']); ?>
        </li>
    <?php endforeach; ?>
    </ul>
  </div>
</nav>
