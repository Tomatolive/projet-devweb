DROP DATABASE IF EXISTS rencontre;
CREATE DATABASE rencontre;
USE rencontre;
SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE Usager (
    login VARCHAR(100) PRIMARY KEY NOT NULL,
    mdp VARCHAR(100) NOT NULL,
    sexe ENUM('H', 'F', 'A') DEFAULT 'A' NOT NULL,
    date_inscription DATE DEFAULT '2000-01-01' NOT NULL,
    date_fin_abonnement DATE,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    ddn DATE DEFAULT '2000-01-01' NOT NULL,
    ville VARCHAR(100),
    profession VARCHAR(100),
    situation ENUM('celibataire', 'divorce', 'veuf'),
    description TEXT,
    informations TEXT,
    profil ENUM('utilisateur', 'abonne', 'admin') NOT NULL,
    zodiaque ENUM('Bélier', 'Taureau', 'Gémeaux', 'Cancer', 'Lion', 'Vierge', 'Balance', 'Scorpion', 'Sagittaire', 'Capricorne', 'Verseau', 'Poissons'),
    image VARCHAR(100)
);

CREATE TABLE Conversation (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    date_dernier_message DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    login1 VARCHAR(100) NOT NULL,
    login2 VARCHAR(100) NOT NULL,
    FOREIGN KEY (login1) REFERENCES Usager(login) ON DELETE CASCADE,
    FOREIGN KEY (login2) REFERENCES Usager(login) ON DELETE CASCADE
);

CREATE TABLE Message (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    date_envoi DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    contenu TEXT NOT NULL,
    expediteur VARCHAR(100) NOT NULL,
    receveur VARCHAR(100) NOT NULL,
    conversation INT NOT NULL,
    FOREIGN KEY (expediteur) REFERENCES Usager(login) ON DELETE CASCADE,
    FOREIGN KEY (receveur) REFERENCES Usager(login) ON DELETE CASCADE,
    FOREIGN KEY (conversation) REFERENCES Conversation(id) ON DELETE CASCADE
);

CREATE TABLE Signalement (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    date_signalement DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    message_id INT NOT NULL,
    message VARCHAR(100) NOT NULL,
    plaintif VARCHAR(100) NOT NULL,
    signale VARCHAR(100) NOT NULL,
    FOREIGN KEY (message_id) REFERENCES Message(id) ON DELETE CASCADE,
    FOREIGN KEY (plaintif) REFERENCES Usager(login) ON DELETE CASCADE,
    FOREIGN KEY (signale) REFERENCES Usager(login) ON DELETE CASCADE
);

CREATE TABLE Recherche (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    date_recherche DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    chercheur VARCHAR(100) NOT NULL,
    recherche VARCHAR(100) NOT NULL,
    FOREIGN KEY (chercheur) REFERENCES Usager(login) ON DELETE CASCADE,
    FOREIGN KEY (recherche) REFERENCES Usager(login) ON DELETE CASCADE
);

INSERT INTO Usager (login, mdp, profil) VALUES ('admin', '$2y$10$HYf7YjR381BoEnxEMzswCefyKtwJfCTHJ2eiM6esPM3F88GnWK6ke', 'admin');
INSERT INTO Usager (login, mdp, sexe, date_inscription, profil) VALUES ('oliviertamon', '$2y$10$U6kfsomBKVicBz1ROslHkuT6KbUyCjaEawkPpoPKC.d1FfrDCGVYS', 'H', CURDATE(), 'abonne');
INSERT INTO Usager (login, mdp, sexe, date_inscription, date_fin_abonnement, profil) VALUES ('thomasllasera', '$2y$10$U6kfsomBKVicBz1ROslHkuT6KbUyCjaEawkPpoPKC.d1FfrDCGVYS', 'H', CURDATE(), '2024-12-31', 'abonne');
INSERT INTO Conversation (login1, login2) VALUES ('oliviertamon', 'thomasllasera');
INSERT INTO Conversation (login1, login2) VALUES ('admin', 'oliviertamon');
INSERT INTO Message (contenu, expediteur, receveur, conversation) VALUES ('Salut Thomas', 'oliviertamon', 'thomasllasera', 1);
INSERT INTO Message (contenu, expediteur, receveur, conversation) VALUES ('Salut Olivier', 'thomasllasera', 'oliviertamon', 1);
