<style>
    div.overflow-auto{
        max-height: 400px!important;
    }
</style>

<?php
    global $db;
    global $uri; 
    global $uri2;

    $db->data = array(
        ':ses'  =>  $uri,
        ':post' =>  $uri2
    );


    $db->query = "
    SELECT * from speech 

    inner join alumnis 
    on alumnis.session = speech.session and 
    alumnis.post = speech.post 

    inner join posts 
    on posts.unique_id = speech.post 

    inner join sessions 
    on sessions.unique_id = speech.session 

    where speech.`session` = :ses 
    and speech.`post` = :post 
    ";

    $speech = $db->fetch();
?>
<div class="container-fluid">

    <div class="row">
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title"><?=$speech->post_name?></strong>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img src="uploads/<?=$speech->photo?>" alt="<?=$speech->nname?>'s photo"/>
                    </div>
                    <table class="table">
                        <tr>
                            <th>Full Name: </th>
                            <td><?=$speech->name?></td>
                        </tr>
                        <tr>
                            <th>P.K.A: </th>
                            <td><?=$speech->nname?></td>
                        </tr>
                        <tr>
                            <th>Session: </th>
                            <td><?=$speech->session_name?></td>
                        </tr>
        
                    </table>
                </div>
            </div>
        </div>
    
    
    
    
        <div class="col-md-8">
            <div class="h5 text-uppercase">
                Speech
            </div>
            <div class="table-responsive overflow-auto p-3 bg-default text-justify">
                <?=$speech->text?>
            </div>
        </div>
    </div>
</div>