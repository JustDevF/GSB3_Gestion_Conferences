<?php  
defined('BASEPATH') || exit('No direct script access allowed');
 //Inclure la vue header   
$this->load->view('v_header');
?>
<!--Tableau des conférences de l'utilisateur-->
<section id="login-form2">
    <div class="container-sm mt-5" style="width:60%;">
    <?php
                echo heading("Mes conférences", "3", "style='padding-top:3%'");
            ?>
            <table class="table table-bordered" style='text-align : center'>
                <caption>Liste de mes conférences</caption>
                <tr style='background-color: #2E86C1; color: white'>
                    <th scope="col">Thème</th>
                    <th scope="col">Date</th>
                    <th scope="col">Horaire</th>
                    <th scope="col">Nom salle</th>
                </tr>
                <?php
                foreach ($listConf as $confInsc){
                    echo "<tr>";
                    echo "  <td> $confInsc->theme </td>";
                    echo "  <td> $confInsc->dateP </td>";
                    echo "  <td> $confInsc->horaire </td>";
                    echo "  <td> $confInsc->nomSalle </td>";
                     //bouton ajouter une conférence
                     echo " <td>";
                     //s'inscrire au conférence
                         echo form_open('ControleurConference/desinscriptionConf');
                         echo form_input(array(
                             'type'  => 'hidden',
                             'name'  => 'idConf',
                             'id'    => 'idConf', 
                             'value' => $confInsc->id,
                         ));
                         echo form_input(array(
                             'type'  => 'hidden',
                             'name'  => 'codeC',
                             'id'    => 'codeC',
                             'value' => $confInsc->codeC,
                     ));
                     echo form_submit(array(
                             'id' => 'desinscription',
                             'placeholder'=>'Supprimer',
                             'class' => 'btn btn-outline-danger',
                             'value' => 'Supprimer',
                     ));
                     echo form_close();
                     echo "  </td>";
                     echo "</tr>";
            }
                ?>
            </table>
    </div>
</section>
            
<?php 
//Inclure la vue footer
$this->load->view('v_footer');
?>