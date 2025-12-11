-- -- -- -- -- N°1 -- -- -- -- --
DELIMITER //
CREATE TRIGGER IF NOT EXISTS trg_hackathon_date
    BEFORE INSERT ON hackathon FOR EACH ROW
    BEGIN
        IF TIMESTAMPDIFF(SECOND, NEW.date_heure_debut, NEW.date_heure_fin) < 0 THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'date_debut non anterieur a date_fin';
        end if;
    END//

INSERT INTO hackathon(date_heure_debut, date_heure_fin, lieu, ville, theme, affiche, objectifs, organisateur_id)
VALUES('2025-10-15 20:49:36', '2025-10-14 20:49:36', 'maison', 'ligné', 'cyber', 'affiche', 'objectif', 6);
-- -- -- -- -- N°1 -- -- -- -- --



-- -- -- -- -- N°2 -- -- -- -- --
delimiter //
DROP TRIGGER trg_inscription_date;
CREATE TRIGGER IF NOT EXISTS trg_inscription_date
    before insert on inscription for each row
    begin
        DECLARE date DATETIME;
        select date_heure_debut into date from hackathon where id= NEW.hackathon_id;
        if TIMESTAMPDIFF(SECOND, NEW.date, date) < 0 THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'inscription impossible hackathon en cours / passé';
        end if;
    end //

INSERT INTO inscription(date, competence, hackathon_id, equipe_id, participant_id)
VALUES('2025-10-16 20:45:36', 'cyber', 12, 11, 25);
-- todo ne fonction que au jours pas a l'heure precis
-- -- -- -- -- N°2 -- -- -- -- --



-- -- -- -- -- N°3 -- -- -- -- --
delimiter //
drop trigger trg_inscription_double;
create trigger if not exists trg_inscription_double
    before insert  on inscription for each row
    begin
        if exists(select * from inscription where participant_id=new.participant_id and hackathon_id=new.hackathon_id) then
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'inscription du participant au hackathon existe déjà';
        end if;
    end //
INSERT INTO inscription(date, competence, hackathon_id, equipe_id, participant_id)
VALUES('2025-10-15 20:45:36', 'cyber', 11, 11, 25);
-- -- -- -- -- N°3 -- -- -- -- --



-- -- -- -- -- N°4 -- -- -- -- --
delimiter //
drop trigger trg_responsable_in_hackathon;
create trigger if not exists trg_responsable_in_hackathon
    before insert on equipe for each row
   begin
       if not (new.be_responsable_id) then

       end if;
    end //
-- -- -- -- -- N°4 -- -- -- -- --



-- -- -- -- -- N°5 -- -- -- -- --
-- -- -- -- -- N°5 -- -- -- -- --



-- -- -- -- -- N°6 -- -- -- -- --
delimiter //
drop trigger trg_equipe_name;
create trigger if not exists trg_equipe_name
    before insert on equipe for each row
    begin
        declare new_hk_id int;
        declare hk_id int;
        declare sameName int;

        select hackathon.id into new_hk_id from hackathon inner join projet on hackathon.id = projet.hackathon_id where projet.id=new.projet_id;
        select equipe.id into sameName from equipe where nom=new.nom LIMIT 2;
        select hackathon.id into hk_id from hackathon inner join projet on hackathon.id = projet.hackathon_id where projet.id= sameName;

        if new_hk_id = hk_id then
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'nom d équipe dupliquer pour un meme hackathon';
        end if;
    end //
insert into equipe(nom, lien_prototype, projet_id, be_responsable_id)
values('toto','',6, null);
-- -- -- -- -- N°6 -- -- -- -- --



-- -- -- -- -- N°7 -- -- -- -- --
delimiter //
drop trigger trg_email_organisateur;
create trigger if not exists trg_email_organisateur
    before insert on organisateur for each row
begin
    if not (new.email REGEXP '^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\\.[A-Za-z]{2,}$') then
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'email organisateur non valide';
    end if;
end //
insert into organisateur(statut, nom, site_web, email)
values('gerant','bernard','site.fr','lol.fr')
-- -- -- -- -- N°7 -- -- -- -- --



-- -- -- -- -- N°8 -- -- -- -- --
delimiter //
create trigger trg_delete_projet;
before delete on projet for each row
begin
    if
end//
-- -- -- -- -- N°8 -- -- -- -- --
