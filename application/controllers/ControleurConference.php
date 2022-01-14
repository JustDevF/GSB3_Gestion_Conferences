<?php
defined('BASEPATH') || exit('No direct script access allowed');

class ControleurConference extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Appel de la librairie pour l'utilisation de session
        $this->load->library('session');
        //Appel de la librairie pour la validation du formulaire
        $this->load->library('form_validation');
        //Appel du helper 'form'
        $this->load->helper('form');
        //chargement de model
        $this->load->model('Monmodel');
    }
      
	public function index()
	{
        $nbConf = $this->Monmodel->nombreConfDispo();
        $obConf = $this->Monmodel->afficher_conferences();
        $data['nbConf'] = $nbConf;
        $data['confDispo'] =  $obConf;

        //recherche
        $theme = "";
        if (isset($_REQUEST['theme']))
        {
            $theme = $_REQUEST['theme'];
        }
       
        $resultR = $this->Monmodel->rechercheConference($theme);

        $data['resultR'] = $resultR;
        
        $resultV = false;

        if (count($resultR) !== 0 ) {
            $resultV = true;
        }
        $data['resultV'] = $resultV;

        //Appel de la vue conference 
        $this->load->view('v_conference', $data);
    }
    
    public function inscriptionConf(){
        //récupération de idConf et codeC)
        $idConf = $_REQUEST['idConf'];
        $codeC = $_REQUEST['codeC'];

        //vérifier si l'utilisateur est déja inscrit sur le conférence
        $bool = $this->Monmodel->verifInscrip($idConf,  $codeC);

        if($bool){
            redirect('ControleurConference');
        } else {
            //inscription
            $this->Monmodel->inscrire($idConf, $codeC);
            redirect('ControleurConference/conferenceU');
        }
    }

    public function desinscriptionConf(){
        //récupartion de idConf et codeC
        $idConf = $_REQUEST['idConf'];
        $codeC = $_REQUEST['codeC'];

        $this->Monmodel->seDesinscrire($idConf,  $codeC);
        redirect('ControleurConference/conferenceU');
    }

    public function conferenceU(){
        $listConf = $this->Monmodel->listConf();
        $data['listConf'] = $listConf;

        $this->load->view('v_listConferenceInscrite', $data);
    }

    public function deconnexion()
    {
        //Appel au model 
        $this->load->model('Monmodel');
        $this->Monmodel->deconnexion();
        //Rédigirer l'utilisateur à la vue connexion
        redirect('C_connexion');
    }

    public function historiqueInscript(){
        $obHistInsc = $this->Monmodel->histConf();
        $data['obHistInsc'] = $obHistInsc;
        $this->load->view('v_historiqueInscrip', $data);
    }

    public function statistique(){
        $totaldeTotal = $this->Monmodel->totalDetTotal();
        $nbInscParTheme = $this->Monmodel->totalInscrisTheme();
        $data['totaldeTotal'] = $totaldeTotal;
        $data['nbInscParTheme'] = $nbInscParTheme;
        $listTheme = $this->Monmodel->themeConf();
        $data['listTheme']  = $listTheme;
        $listIPTa = $this->Monmodel->listInscrisTheme(1);
        $listIPTb = $this->Monmodel->listInscrisTheme(2);
        $data['listIPTa'] = $listIPTa;
        $data['listIPTb'] = $listIPTb;
        $this->load->view('v_statistique', $data);
    }


}