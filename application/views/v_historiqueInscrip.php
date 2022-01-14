<?php  
defined('BASEPATH') || exit('No direct script access allowed');
 //Inclure la vue header   
$this->load->view('v_header');
?>
<!--Tableau d'historique des inscriptions-->
<section id="login-form2">
    <div class="container-sm mt-5" style="width:60%;">
            <?php
                echo heading("Historique de mes inscriptions aux conférences", "3", "style='padding-top:3%'");
            ?>
            <table class="table table-bordered" style='text-align : center'>
                <caption>Liste des inscriptions aux conférences</caption>
                <tr style='background-color: #2E86C1; color: white'>
                    <th scope="col">Date Conférence</th>
                    <th scope="col">Thème</th>
                    <th scope="col">Date d'inscription</th>
                </tr>
                <?php
                foreach ($obHistInsc as $histInsc){
                    echo "<tr>";
                    echo "  <td> $histInsc->dateConf </td>";
                    echo "  <td> $histInsc->theme </td>";
                    echo "  <td> $histInsc->dateInscrit </td>"; 
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