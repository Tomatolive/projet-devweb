DROP DATABASE IF EXISTS rencontre;
CREATE DATABASE rencontre;
USE rencontre;
CREATE TABLE Usager (
    login VARCHAR(100) PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    mdp VARCHAR(100),
    sexe ENUM('H', 'F'),
    profil ENUM('admin', 'utilisateur', 'abonne'));

INSERT INTO Usager VALUES ('admin', 'admin', 'admin', 'admin', 'H', 'admin');
INSERT INTO Usager VALUES ('oliviertamon', 'Tamon', 'Olivier', 'testmdp', 'H', 'utilisateur');
INSERT INTO Usager VALUES ('thomasllasera', 'Llasera', 'Thomas', 'testmdp', 'H', 'abonne');
