CREATE TABLE Utilisateur (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username varchar(255),
    nom_complet VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    mot_de_passe VARCHAR(255),
    annee_etudes INT,
    ville_origine VARCHAR(255),
    ville_actuelle VARCHAR(255),
    biographie TEXT,
    preferences TEXT,
    role enum("admin" , "youcoder"),
    photo_profil VARCHAR(255),
);

CREATE TABLE Annonce (
    id INT PRIMARY KEY AUTO_INCREMENT,
    type ENUM('Jai un Logement', 'Recherche Logement/Colocataires'),
    utilisateur_id INT,
    localisation VARCHAR(255),
    loyer FLOAT,
    capacite INT,
    equipements TEXT,
    regles TEXT,
    galerie_photos TEXT,
    disponibilite DATE,
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateur(id)
);

CREATE TABLE Recherche (
    id INT PRIMARY KEY AUTO_INCREMENT,
    utilisateur_id INT,
    zone_geographique VARCHAR(255),
    budget FLOAT,
    date_emmenagement DATE,
    preferences TEXT,
    type_recherche ENUM('rejoindre', 'chercher ensemble'),
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateur(id)
);

CREATE TABLE Matching (
    id INT PRIMARY KEY AUTO_INCREMENT,
    utilisateur1_id INT,
    utilisateur2_id INT,
    score_compatibilite FLOAT,
    FOREIGN KEY (utilisateur1_id) REFERENCES Utilisateur(id),
    FOREIGN KEY (utilisateur2_id) REFERENCES Utilisateur(id)
);

CREATE TABLE Message (
    id INT PRIMARY KEY AUTO_INCREMENT,
    expediteur_id INT,
    destinataire_id INT,
    contenu TEXT,
    date_envoi DATETIME,
    FOREIGN KEY (expediteur_id) REFERENCES Utilisateur(id),
    FOREIGN KEY (destinataire_id) REFERENCES Utilisateur(id)
);

CREATE TABLE Administrateur (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    mot_de_passe VARCHAR(255)
);

CREATE TABLE Signalement (
    id INT PRIMARY KEY AUTO_INCREMENT,
    annonce_id INT,
    utilisateur_id INT,
    raison TEXT,
    statut ENUM('En attente', 'Traité', 'Rejeté'),
    FOREIGN KEY (annonce_id) REFERENCES Annonce(id),
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateur(id)
);
