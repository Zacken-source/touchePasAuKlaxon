USE klaxon;

INSERT INTO agences (nom) VALUES
('Paris'), ('Lyon'), ('Marseille'), ('Toulouse'), ('Nice'),
('Nantes'), ('Strasbourg'), ('Montpellier'), ('Bordeaux'),
('Lille'), ('Rennes'), ('Reims');

INSERT INTO utilisateurs (nom, prenom, telephone, email, mot_de_passe, role) VALUES
('Martin',    'Alexandre', '0612345678', 'alexandre.martin@email.fr',  '$2y$10$JvKIreaKZ7924ol9Y.K/bOpquqCAb6jBOaS.kB3d/N5h9EaqkDmpy', 'user'),
('Dubois',    'Sophie',    '0698765432', 'sophie.dubois@email.fr',      '$2y$10$JvKIreaKZ7924ol9Y.K/bOpquqCAb6jBOaS.kB3d/N5h9EaqkDmpy', 'user'),
('Bernard',   'Julien',    '0622446688', 'julien.bernard@email.fr',     '$2y$10$JvKIreaKZ7924ol9Y.K/bOpquqCAb6jBOaS.kB3d/N5h9EaqkDmpy', 'user'),
('Moreau',    'Camille',   '0611223344', 'camille.moreau@email.fr',     '$2y$10$JvKIreaKZ7924ol9Y.K/bOpquqCAb6jBOaS.kB3d/N5h9EaqkDmpy', 'user'),
('Lefèvre',   'Lucie',     '0777889900', 'lucie.lefevre@email.fr',      '$2y$10$JvKIreaKZ7924ol9Y.K/bOpquqCAb6jBOaS.kB3d/N5h9EaqkDmpy', 'user'),
('Leroy',     'Thomas',    '0655443322', 'thomas.leroy@email.fr',       '$2y$10$JvKIreaKZ7924ol9Y.K/bOpquqCAb6jBOaS.kB3d/N5h9EaqkDmpy', 'user'),
('Roux',      'Chloé',     '0633221199', 'chloe.roux@email.fr',         '$2y$10$JvKIreaKZ7924ol9Y.K/bOpquqCAb6jBOaS.kB3d/N5h9EaqkDmpy', 'user'),
('Petit',     'Maxime',    '0766778899', 'maxime.petit@email.fr',       '$2y$10$JvKIreaKZ7924ol9Y.K/bOpquqCAb6jBOaS.kB3d/N5h9EaqkDmpy', 'user'),
('Garnier',   'Laura',     '0688776655', 'laura.garnier@email.fr',      '$2y$10$JvKIreaKZ7924ol9Y.K/bOpquqCAb6jBOaS.kB3d/N5h9EaqkDmpy', 'user'),
('Dupuis',    'Antoine',   '0744556677', 'antoine.dupuis@email.fr',     '$2y$10$JvKIreaKZ7924ol9Y.K/bOpquqCAb6jBOaS.kB3d/N5h9EaqkDmpy', 'user'),
('Lefebvre',  'Emma',      '0699887766', 'emma.lefebvre@email.fr',      '$2y$10$JvKIreaKZ7924ol9Y.K/bOpquqCAb6jBOaS.kB3d/N5h9EaqkDmpy', 'user'),
('Fontaine',  'Louis',     '0655667788', 'louis.fontaine@email.fr',     '$2y$10$JvKIreaKZ7924ol9Y.K/bOpquqCAb6jBOaS.kB3d/N5h9EaqkDmpy', 'user'),
('Chevalier', 'Clara',     '0788990011', 'clara.chevalier@email.fr',    '$2y$10$JvKIreaKZ7924ol9Y.K/bOpquqCAb6jBOaS.kB3d/N5h9EaqkDmpy', 'user'),
('Robin',     'Nicolas',   '0644332211', 'nicolas.robin@email.fr',      '$2y$10$JvKIreaKZ7924ol9Y.K/bOpquqCAb6jBOaS.kB3d/N5h9EaqkDmpy', 'user'),
('Gauthier',  'Marine',    '0677889922', 'marine.gauthier@email.fr',    '$2y$10$JvKIreaKZ7924ol9Y.K/bOpquqCAb6jBOaS.kB3d/N5h9EaqkDmpy', 'user'),
('Fournier',  'Pierre',    '0722334455', 'pierre.fournier@email.fr',    '$2y$10$JvKIreaKZ7924ol9Y.K/bOpquqCAb6jBOaS.kB3d/N5h9EaqkDmpy', 'user'),
('Girard',    'Sarah',     '0688665544', 'sarah.girard@email.fr',       '$2y$10$JvKIreaKZ7924ol9Y.K/bOpquqCAb6jBOaS.kB3d/N5h9EaqkDmpy', 'user'),
('Lambert',   'Hugo',      '0611223366', 'hugo.lambert@email.fr',       '$2y$10$JvKIreaKZ7924ol9Y.K/bOpquqCAb6jBOaS.kB3d/N5h9EaqkDmpy', 'user'),
('Masson',    'Julie',     '0733445566', 'julie.masson@email.fr',       '$2y$10$JvKIreaKZ7924ol9Y.K/bOpquqCAb6jBOaS.kB3d/N5h9EaqkDmpy', 'user'),
('Henry',     'Arthur',    '0666554433', 'arthur.henry@email.fr',       '$2y$10$JvKIreaKZ7924ol9Y.K/bOpquqCAb6jBOaS.kB3d/N5h9EaqkDmpy', 'user'),
('Admin',     'Super',     '0100000000', 'admin@klaxon.fr',             '$2y$10$JvKIreaKZ7924ol9Y.K/bOpquqCAb6jBOaS.kB3d/N5h9EaqkDmpy', 'admin');

INSERT INTO trajets
    (agence_depart_id, agence_arrivee_id, gdh_depart, gdh_arrivee, nb_places_total, nb_places_dispo, utilisateur_id)
VALUES
(1, 2, '2026-04-10 07:30:00', '2026-04-10 09:30:00', 4, 3, 1),
(2, 3, '2026-04-11 08:00:00', '2026-04-11 11:00:00', 3, 2, 2),
(1, 4, '2026-04-12 06:45:00', '2026-04-12 12:00:00', 5, 5, 3),
(3, 1, '2026-04-13 14:00:00', '2026-04-13 17:30:00', 4, 1, 4),
(5, 1, '2026-04-14 09:00:00', '2026-04-14 12:00:00', 3, 3, 5),
(1, 6, '2026-04-15 07:00:00', '2026-04-15 10:00:00', 4, 2, 1),
(7, 2, '2026-04-16 08:30:00', '2026-04-16 10:00:00', 2, 1, 6),
(8, 9, '2026-04-17 11:00:00', '2026-04-17 13:30:00', 4, 4, 7);