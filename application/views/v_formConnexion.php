<?php
    //Appel du contrôleur et la méthode à exécuter
    echo form_open('controleurConnexion/verifierConnexion');
    echo form_label('', 'loginU');
    echo '<br>';
    $identifiant= array(

        'name'=>'loginU',

        'id'=>'loginU',

        'placeholder'=>'Identifiant',

        'class'=>'form-control',

        'value'=>set_value('loginU')

    );
    echo form_input($identifiant);
    echo form_error('loginU');

    echo '<br>';

    echo form_label('', 'mdp');
    echo '<br>';
    $mdpU= array(

        'name'=>'mdp',

        'id'=>'mdp',

        'placeholder'=>'Mot de passe',

        'class'=>'form-control',

        'value'=>set_value('mdp')

    );
    echo form_input($mdpU);
    echo form_error('mdp');
    echo '<br>';
    $valider = array(

        'name'=>'connexion',

        'id'=>'connexion',

        'class'=>'btn btn-outline-primary',

        'value'=>'Connexion'

    );
    echo form_submit($valider);
    echo form_close();
?>