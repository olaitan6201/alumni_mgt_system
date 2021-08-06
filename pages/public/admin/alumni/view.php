<?php
    $page_link1='Alumni';
    $page_link2='View All';
    
    global $alumnis;
    global $sessions;
    global $posts;

    include_once('includes/admin/header.php');

?>
<div class="table-responsive">
    <table class="table table-bordered" id="bootstrap-data-table-export">
        <thead >
            <tr class="text-center text-uppercase">
                <th>S/N</th>
                <th>Photo</th>
                <th>Name</th>
                <th>P.K.A</th>
                <th>Session</th>
                <th>Post</th>
                <th>Date Added</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i = 1; 
                foreach($alumnis->fetch_alumnis() as $alumni) : 
                    $alumni_post = $posts->fetch_post($alumni->post)->post_name;
            ?>
                
            <tr>
                <td><?=$i++?></td>
                <td>
                    <img src="uploads/<?=$alumni->photo?>" alt="<?=$alumni->nname?>'s photo">
                </td>
                <td><?=$alumni->name?></td>
                <td><?=$alumni->nname?></td>
                <td><?=$sessions->fetch_session($alumni->session)->session_name?></td>
                <td><?=$alumni_post?></td>
                <td><?=$alumni->date_added?></td>
                <td>
                    <a 
                        href="admin/alumni/edit/<?=$alumni->unique_id?>"
                        role="button"
                        class="btn btn-warning btn-flat btn-sm"
                    >
                        <i class="fa fa-edit"></i> Edit
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
    include_once('includes/admin/footer.php'); 
?>