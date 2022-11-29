-- Personnes
insert into personne (id, nom, prenom) VALUES (nextval('personne_id_seq'), 'ACHARD', 'Christophe');
insert into personne (id, nom, prenom) VALUES (nextval('personne_id_seq'), 'ESPEJO', 'Raphael');
insert into personne (id, nom, prenom) VALUES (nextval('personne_id_seq'), 'GABRIEL', 'Marco');
insert into personne (id, nom, prenom) VALUES (nextval('personne_id_seq'), 'JEAN', 'Florian');

-- Compteurs
insert into compteur (id, nom, partagetaxes, compteurparent_id) VALUES (nextval('compteur_id_seq'), 'Principal', true, null);
insert into compteur (id, nom, partagetaxes, compteurparent_id) VALUES (nextval('compteur_id_seq'), 'Panta Rei', true, 1);
insert into compteur (id, nom, partagetaxes, compteurparent_id) VALUES (nextval('compteur_id_seq'), 'Piscine', false, 2);

-- Rattachement compteur <-> personne
insert into personne_compteur (personne_id, compteur_id) VALUES (2, 1);
insert into personne_compteur (personne_id, compteur_id) VALUES (3, 1);

insert into personne_compteur (personne_id, compteur_id) VALUES (1, 2);
insert into personne_compteur (personne_id, compteur_id) VALUES (4, 2);

insert into personne_compteur (personne_id, compteur_id) VALUES (1, 3);
insert into personne_compteur (personne_id, compteur_id) VALUES (2, 3);
insert into personne_compteur (personne_id, compteur_id) VALUES (3, 3);
insert into personne_compteur (personne_id, compteur_id) VALUES (4, 3);