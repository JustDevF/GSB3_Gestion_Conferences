<?php
defined('BASEPATH') || exit('No direct script access allowed');

class ControleurConnexion extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Appel de la librairie pour l'utilisation de session
        $this->load->library('session');
        //Appel de la librairie pour la validation du formulaire
        $this->load->library('form_validation');
        //Appel du helper 'form'
        $this->load->helper('form');
    }
      
	public function index()
	{
        //Appel de la vue du formulaire de connexion
        $data['err'] = false;
        //Appel de la vue connexion
        $this->load->view('v_connexion', $data);
    }
    
    public function verifierConnexion()
    {
        $loginU = $_REQUEST['loginU'];
        $mdpU = $_REQUEST['mdp'];
        $this->load->model('Monmodel');
        
        $con = $this->Monmodel->connexion($loginU, $mdpU);
        
        if($con){
            $this->Monmodel->sessionUtilisateur($loginU, $mdpU);
            redirect('ControleurConference');
        }
        else{
            //Appel de la librairie pour la validation du formulaire
            $this->load->library('form_validation');
            //Appel du helper 'form'
            $this->load->helper('form');
            $data['err'] = true;
            $this->load->view('v_connexion', $data);
        }
        
    }

    public function deconnexion()
    {
        //Appel au model 
        $this->load->model('Monmodel');
        $this->Monmodel->deconnexion();
        //Rédigirer l'utilisateur à la vue connexion
        redirect('ControleurConnexion');
    }


}