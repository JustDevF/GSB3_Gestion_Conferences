
<?php  
defined('BASEPATH') || exit('No direct script access allowed');
 //Inclure la vue header   
$this->load->view('v_header');
?>
   
    <section id="login-form2">
        
         <div class="container-sm mt-5">
            <!--barre de recherche-->
            <?php

            echo form_open('controleurConference/index');
            echo form_label('', 'theme');

            $theme = array(
                'name'=>'theme',
                'id'=>'theme',
                'placeholder'=>'Saisir le thème de la conference',
                'class'=>'form-control me-2',
                'style' => 'width:25%',
                'type' => 'search',
                'value'=>set_value('theme')

            );
            echo form_input($theme);
            echo form_error('theme');

            $valider = array(
                'name'=>'Recherche',
                'id'=>'Recherche',
                'class'=>'btn btn-outline-primary mt-2',
                'value'=>'Recherche'
            );
            echo form_submit($valider);
            echo form_close();
        ?>
        <!-- condition pour afficher les résultats de la recharche-->    
        <!-- Tableau de résultat de recherche -->
        <?php
            if ($resultV) {
                $this->load->view('v_resultatRecherche');
            } else {
                //
            }
            
        ?>

            <!--Tableau de conférence par thème disponible-->
            <h5 class="pt-5">Conférences disponibles </h5>
            <table class="table table-striped"  style="width:70%" style='text-align : center'>
                <caption>Nombre tôtal de conférence disponibles : <?php echo $nbConf ?></caption>
                <thead>
                    <tr style='background-color: #2E86C1; color: white'>
                        <th scope="col">Thème</th>
                        <th scope="col">Horaire</th>
                        <th scope="col">Place dispo</th>
                        <th scope="col">Date</th>
                        <th scope="col">Animateur</th>
                        <th scope="col">Salle</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($confDispo as $conf) {
                            echo "<tr>";
                            echo "  <td> $conf->theme </td>";
                            echo "  <td> $conf->horaire </td>";
                            echo "  <td> $conf->nbPlace </td>";
                            echo "  <td> $conf->dateP </td>";
                            echo "  <td> $conf->nom </td>";
                            echo "  <td> $conf->nomSalle </td>";
                            //bouton ajouter une conférence
                            echo " <td>";
                            //s'inscrire au conférence
                                echo form_open('ControleurConference/inscriptionConf');
                                echo form_input(array(
                                    'type'  => 'hidden',
                                    'name'  => 'idConf',
                                    'id'    => 'idConf', 
                                    'value' => $conf->id,
                                ));
                                echo form_input(array(
                                    'type'  => 'hidden',
                                    'name'  => 'codeC',
                                    'id'    => 'codeC',
                                    'value' => $conf->CodeC,
                            ));
                            echo form_submit(array(
                                    'id' => 'inscription',
                                    'placeholder'=>'Ajouter',
                                    'class' => 'btn btn-outline-primary',
                                    'value' => 'Ajouter',
                            ));
                            echo form_close();
                            echo "  </td>";
                            echo "</tr>";
                        }
                        
                    ?>
                </tbody>
            </table>
         </div>
    </section>

<?php 
//Inclure la vue footer
$this->load->view('v_footer');
?>


