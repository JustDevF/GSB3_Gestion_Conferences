<?php  
defined('BASEPATH') || exit('No direct script access allowed');
 //Inclure la vue header   
$this->load->view('v_header');
?>
<!--Tableau des statistiques -->
<section id="login-form2">
    <div class="container-sm mt-5" style="width:60%;">
            <?php
                echo heading("Statistiques sur les conférences", "3", "style='padding-top:3%'");
            ?>
            <table class="table table-bordered" style='text-align : center'>
                <caption>Statistiques sur les inscriptions aux conférences</caption>
                <tr style='background-color: #2E86C1; color: white'>
                    <th scope="col">Total conférence</th>
                    <th scope="col">Total place</th>
                    <th scope="col">Total visiteur</th>
                    <th scope="col">Total inscris</th>
                </tr>
                <?php
                foreach ($totaldeTotal as $total){
                    echo "<tr>";
                    echo "  <td> $total->nbTotalConf </td>";
                    echo "  <td> $total->nbTotalPlace </td>";
                    echo "  <td> $total->nbTotalVisiteur </td>";
                    echo "  <td> $total->nbTotalInscris </td>";
                    echo "</tr> ";
                }
                ?>
            </table>

            <?php
                echo heading("Statistiques sur les inscriptions par thème", "3", "style='padding-top:3%'");
            ?>
            <table class="table table-bordered" style='text-align : center'>
                <caption>Statistiques sur les inscriptions aux conférences par thème</caption>
                <tr style='background-color: #2E86C1; color: white'>
                    <th scope="col">Nombre</th>
                    <th scope="col">Thème</th>
                </tr>
                <?php
                foreach ($nbInscParTheme as $theme){
                    echo "<tr>";
                    echo "  <td> $theme->nbInsctheme</td>";
                    echo "  <td> $theme->theme </td>";
                    echo "</tr>";
            }
                ?>
            </table>
                <?php 
                    echo heading("Liste des inscris par thème", "4");
                    echo form_open('ControleurConference/statistique');
                    echo form_dropdown('themeS', $listTheme);
                    echo form_submit(array(
                        'id' => 'themeValide',
                        'class' => 'btn btn-outline-primary',
                        'value' => 'Afficher',
                        ));
                echo form_close();

                ?>
            <table class="table table-striped"  style="width:70%" style='text-align : center'>
                <caption>Statistiques sur les inscriptions aux conférences par thème</caption>
                <thead>
                    <tr style='background-color: #2E86C1; color: white'>
                        <th scope="col">Thème</th>
                        <th scope="col">dateP</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Salle</th>
                        <th scope="col">Ville</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($listIPTa as $ipta) {
                            echo "<tr>";
                            echo "  <td> $ipta->theme </td>";
                            echo "  <td> $ipta->dateP </td>";
                            echo "  <td> $ipta->nom </td>";
                            echo "  <td> $ipta->codeSalle </td>";
                            echo "  <td> $ipta->ville </td>";
                            echo "  <td> $ipta->codeSalle </td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>

            <table class="table table-striped"  style="width:70%" style='text-align : center'>
                <caption>Statistiques sur les inscriptions aux conférences par thème</caption>
                <thead>
                    <tr style='background-color: #2E86C1; color: white'>
                        <th scope="col">Thème</th>
                        <th scope="col">dateP</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Salle</th>
                        <th scope="col">Ville</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($listIPTb as $iptb) {
                            echo "<tr>";
                            echo "  <td> $iptb->theme </td>";
                            echo "  <td> $iptb->dateP </td>";
                            echo "  <td> $iptb->nom </td>";
                            echo "  <td> $iptb->codeSalle </td>";
                            echo "  <td> $iptb->ville </td>";
                            echo "  <td> $iptb->codeSalle </td>";
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