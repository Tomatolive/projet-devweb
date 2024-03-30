<?php
    class Usager {
        private $login;
        private $sexe;
        private $date_inscription;
        private $date_fin_abonnement;
        private $nom;
        private $prenom;
        private $ddn;
        private $ville;
        private $profession;
        private $situation;
        private $description;
        private $informations;
        private $profil;
        private $zodiaque;

        public function __construct($login, $sexe, $date_inscription, $date_fin_abonnement, $nom, $prenom, $ddn, $ville, $profession, $situation, $description, $informations, $profil) {
            $this->login = $login;
            $this->sexe = $sexe;
            $this->date_inscription = $date_inscription;
            $this->date_fin_abonnement = $date_fin_abonnement;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->ddn = $ddn;
            $this->ville = $ville;
            $this->profession = $profession;
            $this->situation = $situation;
            $this->description = $description;
            $this->informations = $informations;
            $this->profil = $profil;
            $this->zodiaque = Usager::setZodiaque($this->ddn);
        }

        public function getLogin() {
            return $this->login;
        }
        
        public function getSexe() {
            return $this->sexe;
        }

        public function getDateInscription() {
            return $this->date_inscription;
        }

        public function getDateFinAbonnement() {
            return $this->date_fin_abonnement;
        }

        public function getNom() {
            return $this->nom;
        }

        public function getPrenom() {
            return $this->prenom;
        }

        public function getDdn() {
            return $this->ddn;
        }

        public function getVille() {
            return $this->ville;
        }

        public function getProfession() {
            return $this->profession;
        }

        public function getSituation() {
            return $this->situation;
        }

        public function getDescription() {
            return $this->description;
        }

        public function getInformations() {
            return $this->informations;
        }

        public function getProfil() {
            return $this->profil;
        }

        public function getZodiaque() {
            return $this->zodiaque;
        }

        public function setLogin($login) {
            $this->login = $login;
        }

        public function setSexe($sexe) {
            $this->sexe = $sexe;
        }

        public function setDateInscription($date_inscription) {
            $this->date_inscription = $date_inscription;
        }

        public function setDateFinAbonnement($date_fin_abonnement) {
            $this->date_fin_abonnement = $date_fin_abonnement;
        }

        public function setNom($nom) {
            $this->nom = $nom;
        }

        public function setPrenom($prenom) {
            $this->prenom = $prenom;
        }

        public function setDdn($ddn) {
            $this->ddn = $ddn;
        }

        public function setVille($ville) {
            $this->ville = $ville;
        }

        public function setProfession($profession) {
            $this->profession = $profession;
        }

        public function setSituation($situation) {
            $this->situation = $situation;
        }

        public function setDescription($description) {
            $this->description = $description;
        }

        public function setInformations($informations) {
            $this->informations = $informations;
        }

        public function setProfil($profil) {
            $this->profil = $profil;
        }

        public static function setZodiaque($ddn) {
            $date = explode("-", $ddn);
            $jour = $date[2];
            $mois = $date[1];
            if (($mois == 3 && $jour >= 21) || ($mois == 4 && $jour <= 19)) {
                return "Bélier";
            } else if (($mois == 4 && $jour >= 20) || ($mois == 5 && $jour <= 20)) {
                return "Taureau";
            } else if (($mois == 5 && $jour >= 21) || ($mois == 6 && $jour <= 21)) {
                return "Gémeaux";
            } else if (($mois == 6 && $jour >= 22) || ($mois == 7 && $jour <= 22)) {
                return "Cancer";
            } else if (($mois == 7 && $jour >= 23) || ($mois == 8 && $jour <= 22)) {
                return "Lion";
            } else if (($mois == 8 && $jour >= 23) || ($mois == 9 && $jour <= 22)) {
                return "Vierge";
            } else if (($mois == 9 && $jour >= 23) || ($mois == 10 && $jour <= 23)) {
                return "Balance";
            } else if (($mois == 10 && $jour >= 24) || ($mois == 11 && $jour <= 21)) {
                return "Scorpion";
            } else if (($mois == 11 && $jour >= 22) || ($mois == 12 && $jour <= 21)) {
                return "Sagittaire";
            } else if (($mois == 12 && $jour >= 22) || ($mois == 1 && $jour <= 19)) {
                return "Capricorne";
            } else if (($mois == 1 && $jour >= 20) || ($mois == 2 && $jour <= 18)) {
                return "Verseau";
            } else if (($mois == 2 && $jour >= 19) || ($mois == 3 && $jour <= 20)) {
                return "Poissons";
            } 
        }

        public function __toString() {
            return "Login : " . $this->login . ", Sexe : " . $this->sexe . ", Date d'inscription : " . $this->date_inscription . ", Date de fin d'abonnement : " . $this->date_fin_abonnement . ", Nom : " . $this->nom . ", Prénom : " . $this->prenom . ", Date de naissance : " . $this->ddn . ", Ville : " . $this->ville . ", Situation : " . $this->situation . ", Description : " . $this->description . ", Informations : " . $this->informations . ", Profil : " . $this->profil . ", Signe du zodiaque : " . $this->zodiaque;
        }

        public function afficher() {
            echo $this->__toString();
        }
    }
