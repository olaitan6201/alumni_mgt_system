<?php 
  if($page == 'user'): 
    $sess = $sessions->fetch_sessions();
?>
<nav class="navbar fixed-top navbar-expand-lg navbar-<?=HEADER_COLOR?> bg-<?=HEADER_BG?>">
  <div class="container-fluid">
    <a class="navbar-brand" href="./"><?=APP_TITLE?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a 
            class="nav-link dropdown-toggle 
                <?=(empty($pg) || $pg == 'alumni')?'active':'';?>
            "
            href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Alumnis
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
              foreach($sess as $ses) :
                if(isset($pg2) && $pg2 == $ses->unique_id) :
            ?>
              <a class="dropdown-item active" href="./alumni/<?=$ses->unique_id?>"><?=$ses->session_name?></a>
            <?php else : ?>
              <a class="dropdown-item" href="./alumni/<?=$ses->unique_id?>"><?=$ses->session_name?></a>
            <?php
                endif;
              endforeach;
            ?>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled <?=$pg == 'speech'?'active':'';?>" href="./speech">Speech</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $pg == 'events'?'active':'';?>" href="./events">Events</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<br><br><br>
<?php endif; ?>