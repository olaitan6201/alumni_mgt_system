<?php
    $page_link1='Dashboard';
    $page_link2='Dashboard';
    
    include_once('includes/admin/header.php');
?>


<style>
    font i{
        opacity: 0.3;
    }
    
    .card{
        background-color: rgba(0,0,0,0.1);
        border: 0!important;
    }
    .card-body:hover font i{
        opacity: 0.7;
    }
</style>

<div class="container">
    <center>
        <div class="h1 text-uppercase">
            welcome to alumni management admin section
        </div>
    </center>
    <div class="row">

        <div class="col-md-4">
            <div class="card p-2">
                <div class="card-body">
                    <font size="32px">
                        <i class="fa fa-users"></i>
                    </font>
                    <span class="float-right">
                    <br>
                        <a href="admin/sessions" class="stretched-link pr-4">Add New Session</a>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-2">
                <div class="card-body">
                    <font size="32px">
                        <i class="fa fa-id-badge"></i>
                    </font>
                    <span class="float-right">
                    <br>
                        <a href="admin/alumni/add" class="stretched-link pr-4">Add New Alumni</a>
                    </span>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card p-2">
                <div class="card-body">
                    <font size="32px">
                        <i class="fa fa-paper-plane"></i>
                    </font>
                    <span class="float-right">
                    <br>
                        <a href="admin/events" class="stretched-link pr-4">Add New Event</a>
                    </span>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card p-2">
                <div class="card-body">
                    <font size="32px">
                        <i class="fa fa-microphone"></i>
                    </font>
                    <span class="float-right">
                    <br>
                        <a href="admin/alumni/speech" class="stretched-link pr-4">Add Alumni Speech</a>
                    </span>
                </div>
            </div>
        </div>



        <div class="col-md-4">
            <div class="card p-2">
                <div class="card-body">
                    <font size="32px">
                        <i class="fa fa-id-card-o"></i>
                    </font>
                    <span class="float-right">
                    <br>
                        <a href="admin/posts" class="stretched-link pr-4">Add New Alumni Post</a>
                    </span>
                </div>
            </div>
        </div>


    </div>
</div>

<?php
    include_once('includes/admin/footer.php'); 
?>