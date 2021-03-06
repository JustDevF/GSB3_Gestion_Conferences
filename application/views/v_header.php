<!DOCTYPE html>
<html lang="fr">
    <head>
        <!--charger un fichier css-->
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>assets/css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <title>Gestion des conférences </title>
    </head>
    <body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav px-4" style="margin-left:12%;">
                
                <?php

                    if($this->session->has_userdata('id')){
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url().'index.php/ControleurConference/'?>">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url().'index.php/ControleurConference/conferenceU' ?>"> Conférences </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url().'index.php/ControleurConference/historiqueInscript'?>">Historique</a>
                </li>
                <?php
                    if($this->session->userdata('statut') =='R'){
                        
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url().'index.php/ControleurConference/statistique' ?>">Statistiques</a>
                </li>
                <?php
                    }
                    
                }
                ?>
            </ul>
        </div>

        
        <?php
        //Déconnexion de l'utilisateur
        if($this->session->has_userdata('id')){
            echo form_open('controleurConnexion/deconnexion');
            $deconnexion = array(

                'name'=>'deco',
        
                'id'=>'deco',
        
                'class'=>'btn btn-outline-danger',

                'style'=>'float: right',
        
                'value'=>'Deconnexion'
        
            );
            echo form_submit($deconnexion);
            echo form_close();
        }
        ?>
    </nav>