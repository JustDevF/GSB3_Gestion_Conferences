
<?php  defined('BASEPATH') || exit('No direct script access allowed');


class Monmodel extends CI_Model {

    /* Fonctions pour visiteur */
    //connexion utilisateur
    public function connexion($U_login, $U_mdp)
    {   
        $sql = "SELECT * FROM visiteur WHERE login = ? AND mdp = ?";
        $bool = $this->db->query($sql, array($U_login, $U_mdp));
        $bool = $bool->num_rows();
        return $bool;
    }

    //récupération des information de l'utilisateur sur les variables de session
    public function sessionUtilisateur($U_login, $U_mdp){
        $sql = "SELECT * FROM visiteur WHERE login = ? AND mdp = ?";
        $user = $this->db->query($sql, array($U_login, $U_mdp));
        $user = $user->row();

        
        $this->session->set_userdata('id', $user->id);
        $this->session->set_userdata('nom', $user->nom);
        $this->session->set_userdata('prenom', $user->prenom);
        $this->session->set_userdata('statut', $user->Statut);
    }

    //Déconnexion de l'utilisateur
    public function deconnexion(){
        $this->session->sess_destroy();
    }

    /* Fonctions pour la gestion des conférences */
    //information de la conférence par thème
    public function conferencesType($codeTheme){
        $sql = "SELECT * FROM conference, animateur WHERE CodeC = ? AND conference.code = animateur.code";
        return $this->db->query($sql, array($codeTheme));
    }

    //informations de toutes les conférences enrégistrées 
    public function afficher_conferences(){
        $sql = "SELECT * 
        FROM conference, animateur, salle, theme  
        WHERE conference.code = animateur.code
        AND conference.CodeC = theme.CodeC
        AND conference.codeSalle = salle.codeSalle
        AND nbPlace >=1
        GROUP BY theme, id
        ORDER BY theme";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function nombreConfDispo(){
        $sql = "SELECT COUNT(*) AS nb FROM conference WHERE nbPlace >= 1";
        $conf = $this->db->query($sql);
        $conv = $conf->row();
        return $conv->nb;
    }

    //vérifier l'inscription à une conférence par thème
    public function verifInscrip($idConf, $codeC){
        $userId = $this->session->userdata('id');
        $sql = "SELECT * FROM inscris WHERE code = ? AND id = ? AND CodeC = ?";
        $bool = $this->db->query($sql, array($userId, $idConf, $codeC));
        $bool = $bool->num_rows();
        return $bool;
    }

    //inscription d'utilisateur à une conférence
    public function inscrire($idConf, $codeC){
        //inscription
        $userId = $this->session->userdata('id');
        $sql = "INSERT INTO inscris(code, id, CodeC) VALUES(?, ?, ?)";
        $this->db->query($sql, array($userId, $idConf, $codeC));
        //mise à jour des places disponibles
        $rqt = "SELECT * FROM inscris, conference WHERE conference.id = inscris.id AND inscris.code = ? AND inscris.id = ? AND inscris.CodeC = ?";
        $conf = $this->db->query($rqt, array($userId, $idConf, $codeC));
        $remp = $conf->row();
        $places = $remp->nbPlace;
        $places = $places-1;
        $miseJour = "UPDATE conference SET nbPlace = ? WHERE id = ?";
        $this->db->query($miseJour, array($places, $idConf));
    }

    //Désinscription d'utilisateur à une conférence
    public function seDesinscrire($idConf, $codeC){
        //vérifier si l'utilisateur est inscrit
        $bool = $this->verifInscrip($idConf, $codeC);

        if ($bool){
            //mise à jour des places disponibles
            $userId = $this->session->userdata('id');
            $rqt = "SELECT * FROM inscris, conference WHERE conference.id = inscris.id AND inscris.code = ? AND inscris.id = ? AND inscris.CodeC = ?";
            $conf = $this->db->query($rqt, array($userId, $idConf, $codeC));
            $remp = $conf->row();
            $places = $remp->nbPlace;
            $places = $places+1;
            $miseJour = "UPDATE conference SET nbPlace = ? WHERE id = ?";
            $this->db->query($miseJour, array($places, $idConf));
            //supprimer l'utilisateur de la conférence
            $sql = "DELETE FROM inscris WHERE code = ? AND id = ? AND CodeC = ?";
            $this->db->query($sql, array($userId, $idConf, $codeC));
        }
        
    }

    //historique de participation par utilisateur
    public function historiqueConf($nomU){
        $sql = "SELECT * FROM historiquep WHERE nom = ?";
        return $this->db->query($sql, array($nomU));
    }

    //liste de conférence de l'utilisateur
    public function listConf(){
        $userId = $this->session->userdata('id');
        $sql = "SELECT theme, dateP, horaire, nomSalle, inscris.id, inscris.codeC
        FROM inscris, theme, conference, visiteur, salle
        WHERE conference.id = inscris.id 
        AND inscris.code = visiteur.id 
        AND inscris.CodeC = theme.CodeC 
        AND conference.codeSalle = salle.codeSalle
        AND inscris.code = ?
        GROUP BY conference.id";
 
        $query = $this->db->query($sql, array($userId));
        return $query->result();
     }

     public function rechercheConference($theme){
        $sql = "SELECT * 
        FROM conference, animateur, salle, theme  
        WHERE conference.code = animateur.code
        AND conference.CodeC = theme.CodeC
        AND conference.codeSalle = salle.codeSalle
        AND theme = ?
        GROUP BY theme, id
        ORDER BY theme";
        $query = $this->db->query($sql, array($theme));
        return $query->result();
    }

    //historique d'inscription aux conférences
    public function histConf(){
        //nom de l'utilisateur
        $nom = $this->session->userdata('nom');
        $sql = "SELECT * FROM historiquep WHERE nom = ?";
        $query = $this->db->query($sql, array($nom));
        return $query->result();
    }

     /* Fonction de stat  des inscriptions aux conférences */
    //Nombre tôtal d'inscris par conférence
    public function totalDetTotal(){
        $sql = "SELECT COUNT(id) as nbTotalConf, SUM(nbPlace) as nbTotalPlace, 
        (SELECT COUNT(*) from visiteur) as nbTotalVisiteur,
        (SELECT COUNT(inscris.id) from inscris) as nbTotalInscris
      FROM conference";
      $query = $this->db->query($sql);
      return  $query->result();
    }

    public function totalInscrisTheme(){
        $sql = "SELECT COUNT(inscris.id) as nbInsctheme, theme
        FROM inscris, theme
        WHERE inscris.CodeC = theme.CodeC
        GROUP BY theme";

        $query = $this->db->query($sql);
        return $query->result();

    }
    //Liste des utilisateurs de conférence par thème
    public function listInscrisTheme($codeTheme){
        $sql = "SELECT * FROM inscris, theme, conference, visiteur WHERE inscris.CodeC = ? AND inscris.CodeC = theme.CodeC AND conference.id = inscris.id AND inscris.code = visiteur.id GROUP BY conference.id";
        $query = $this->db->query($sql, array($codeTheme));
        return  $query->result();
    }

    public function themeConf(){
        $sql = "SELECT theme FROM theme";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    
}
?>