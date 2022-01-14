
<?php  
defined('BASEPATH') || exit('No direct script access allowed');
 //Inclure la vue header   
$this->load->view('v_header');
?>

<!-- connexion -->
<section id="login-form">
    <div class="row m-0">
        <div class="col-lg-4 offset-lg-2">
            <div class="text-center pb-5">
                <h1 class="login-title text-dark">Login</h1>
                <p class="p-1 m-0 font-ubuntu text-black-50">Connectez-vous et profitez de vos de conférences</p>
                <span class="font-ubuntu text-black-50">Créer un nouveau <a href="inscription.php">compte</a></span>
            </div>
            <div class="d-flex justify-content-center">
                <!--charger la vue formulaire-->
                <?php
                    $this->load->view('v_formConnexion');
                ?>
            </div>
            <?php
                //connexion échouée. Appel à la variable du contrôleur
                 if($err){
                    //Appel à la vue erreurConnexion
                    $this->load->view('v_connexionEchouee');
                }
            ?>
        </div>
    </div>
</section>
<!-- #connexion -->

<?php 
//Inclure la vue footer
$this->load->view('v_footer');
?>


