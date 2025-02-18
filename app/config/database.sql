CREATE TABLE Utilisateur (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) ,
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
    budget int
);



CREATE TABLE Annonce (
    id INT PRIMARY KEY AUTO_INCREMENT,
    utilisateur_id INT,
    localisation VARCHAR(255),
    loyer FLOAT,
    capacite INT,
    equipements TEXT,
    regles TEXT,
    statut enum("inactif" , "active" , "rejete"),
    galerie_photos TEXT,
    disponibilite DATE,
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateur(id)
);

-- INSERT INTO Annonce (type, utilisateur_id, localisation, loyer, capacite, equipements, regles, galerie_photos, disponibilite) VALUES
-- ('Jai un Logement', 6, 'Casablanca', 3500, 2, 'WiFi, Climatisation, Cuisine équipée', 'Non-fumeur, Pas d’animaux', 'photo1.jpg,photo2.jpg', '2025-03-01'),
-- ('Recherche Logement/Colocataires', 7, 'Marrakech', 2500, 1, 'WiFi', 'Pas de soirées', NULL, '2025-02-20'),
-- ('Jai un Logement', 8, 'Rabat', 4000, 3, 'Parking, Piscine, Salle de sport', 'Non-fumeur', 'photo3.jpg,photo4.jpg', '2025-04-15'),
-- ('Recherche Logement/Colocataires', 9, 'Fès', 2000, 1, 'WiFi, Chauffage', 'Respect du calme après 22h', NULL, '2025-02-25'),
-- ('Jai un Logement', 10, 'Tanger', 3200, 2, 'Jardin, Terrasse', 'Pas d’animaux', 'photo5.jpg,photo6.jpg', '2025-03-10');



CREATE TABLE Message (
    id INT PRIMARY KEY AUTO_INCREMENT,
    expediteur_id INT,
    destinataire_id INT,
    contenu TEXT,
    date_envoi DATETIME,
    FOREIGN KEY (expediteur_id) REFERENCES Utilisateur(id),
    FOREIGN KEY (destinataire_id) REFERENCES Utilisateur(id)
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
