DROP DATABASE IF EXISTS rencontre;
CREATE DATABASE rencontre;
USE rencontre;

CREATE TABLE Usager (
    login VARCHAR(100) PRIMARY KEY NOT NULL,
    mdp VARCHAR(100) NOT NULL,
    sexe ENUM('H', 'F', 'A') DEFAULT 'A' NOT NULL,
    date_inscription DATE DEFAULT '1000-01-01' NOT NULL,
    date_fin_abonnement DATE,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    ddn DATE,
    ville VARCHAR(100),
    profession VARCHAR(100),
    situation ENUM('celibataire', 'divorce', 'veuf'),
    description TEXT,
    informations TEXT,
    profil ENUM('utilisateur', 'abonne', 'admin') NOT NULL);

INSERT INTO Usager (login, mdp, profil) VALUES ('admin', '$2y$10$HYf7YjR381BoEnxEMzswCefyKtwJfCTHJ2eiM6esPM3F88GnWK6ke', 'admin');
INSERT INTO Usager (login, mdp, sexe, date_inscription, profil) VALUES ('oliviertamon', '$2y$10$U6kfsomBKVicBz1ROslHkuT6KbUyCjaEawkPpoPKC.d1FfrDCGVYS', 'H', CURDATE(), 'utilisateur');
INSERT INTO Usager (login, mdp, sexe, date_inscription, date_fin_abonnement, profil) VALUES ('thomasllasera', '$2y$10$U6kfsomBKVicBz1ROslHkuT6KbUyCjaEawkPpoPKC.d1FfrDCGVYS', 'H', CURDATE(), '2024-12-31', 'abonne');
