<style>
  .card{
    margin-top: 20px;
  }
  .card img{
    height: 150px;
    width: 130px;
  }
</style>


<?php
  global $db; 
  global $crud;

  $db->query = "SELECT * from posts 
  inner join alumnis 
  ON  alumnis.post = posts.unique_id 
  inner join `sessions` on alumnis.session = `sessions`.unique_id 
  order by posts.id desc
  ";

  $alums = $db->fetchAll();
?>


<div class="container-fluid">
  <div class="row">

    <?php 
      foreach($alums as $alum) : 
        $db->data = array(
          ':ses'  =>  $alum->session,
          ':post' =>  $alum->post
        );

        $db->query = "SELECT * from speech 
        where `session` = :ses and post = :post
        ";

        $speechExists = $db->rowCount();
        $speech = $db->fetch();
    ?>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <strong class="card-title"><?=$alum->post_name?></strong>
        </div>
        <div class="card-body">
          <div class="text-center">
            <img src="uploads/<?=$alum->photo?>" alt="<?=$alum->nname?>'s photo"/>
          </div>
          <table class="table">
            <tr>
              <th>Full Name: </th>
              <td><?=$alum->name?></td>
            </tr>
            <tr>
              <th>P.K.A: </th>
              <td><?=$alum->nname?></td>
            </tr>
            <tr>
              <th>Session: </th>
              <td><?=$alum->session_name?></td>
            </tr>
            <?php if($speechExists) : ?>
              <tr>
                <th>Speech: </th>
                <td>
                  <a 
                    href="speech/<?=$speech->session?>/<?=$speech->post?>" 
                    role="button"
                    class="btn btn-outline-primary btn-sm"
                  >
                    <i class="fa fa-eye"></i> View Speech
                  </a> 
                </td>
              </tr>
            <?php endif; ?>

          </table>
        </div>
        <div class="card-footer">
          <h5>
            <a href="tel:<?=$alum->phone?>">
              <i class="fa fa-phone"></i>
            </a>
            <span class="float-right">
              <a href="mailto:<?=$alum->email?>">
                <i class="fa fa-envelope"></i>
              </a>
            </span>
          </h5>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
    


  </div>
</div>