-- -- -- -- -- Niveau 1 -- -- -- -- --
delimiter //
DROP PROCEDURE IF EXISTS countHackathon //
CREATE PROCEDURE countHackathon(IN idHackathon INT, OUT nb INT)
BEGIN
    select COUNT(inscription.id) into nb from inscription where inscription.hackathon_id=idHackathon;
END
//
CALL countHackathon(8,@nb);
select @nb;
-- PROF : OK

delimiter //
DROP PROCEDURE IF EXISTS getEquipeNameForProject //
CREATE PROCEDURE getEquipeNameForProject(IN projetId INT)
BEGIN
    select nom from equipe where projet_id=projetID;
END
//
CALL getEquipeNameForProject(6);
-- PROF : OK

-- -- -- -- -- Niveau 2 -- -- -- -- --
delimiter //
DROP PROCEDURE IF EXISTS getEqNameAndNumberForProject //
CREATE PROCEDURE getEqNameAndNumberForProject(IN projetId INT)
BEGIN
    select equipe.nom,count(inscription.id) from equipe left outer join inscription on inscription.equipe_id=equipe.id
	where projet_id=projetID group by equipe.nom;
END
//
CALL getEqNameAndNumberForProject(6);
-- PROF : OK

delimiter //
DROP PROCEDURE IF EXISTS inscriptionParticipant //
CREATE PROCEDURE inscriptionParticipant(IN p_participant_id INT, IN p_hackathon_id INT, OUT p_code_retour INT)
main:BEGIN
	DECLARE v_count INT DEFAULT 0;

	SELECT COUNT(*) INTO v_count FROM hackathon WHERE id = p_hackathon_id;
    IF v_count = 0 THEN SET p_code_retour = 1; -- Erreur 1 : Hackathon inexistant
    LEAVE main;
    END IF;

	SELECT COUNT(*) INTO v_count FROM participant WHERE id = p_participant_id;
    IF v_count = 0 THEN SET p_code_retour = 2; -- Erreur 2 : Participant inexistant
    LEAVE main;
    END IF;

	SELECT COUNT(*) INTO v_count FROM inscription WHERE hackathon_id = p_hackathon_id AND participant_id = p_participant_id;
    IF v_count > 0 THEN SET p_code_retour = 3; -- Erreur 3 : déjà inscrit
    LEAVE main;
    END IF;

    INSERT INTO inscription (participant_id, hackathon_id, date)
    VALUES (p_participant_id, p_hackathon_id, NOW());
    SET p_code_retour = 0; -- OK
END
//
CALL inscriptionParticipant(12, 8, @code_retour);
SELECT @code_retour AS resultat;
-- PROF : OK


DELIMITER //
DROP PROCEDURE IF EXISTS addToEquipe //
CREATE PROCEDURE addToEquipe(IN inscription_id INT, IN equipe__id INT, OUT code_retour INT)
main:BEGIN
    DECLARE nbr INT DEFAULT 0;

    SELECT COUNT(*) INTO nbr FROM inscription WHERE id = inscription_id;
    IF nbr = 0 THEN SET code_retour = 1; -- Erreur 1 : inscription inexistante
    LEAVE main;
    END IF;

    SELECT COUNT(*) INTO nbr FROM equipe WHERE id = equipe__id;
    IF nbr = 0 THEN SET code_retour = 2; -- Erreur 2 : équipe inexistante
    LEAVE main;
    END IF;

    SELECT COUNT(*) INTO nbr FROM inscription WHERE inscription.id = inscription_id AND inscription.equipe_id = equipe__id;
    IF nbr > 0 THEN SET code_retour = 3; -- Erreur 3 : déjà rattachée
    LEAVE main;
    END IF;

    UPDATE inscription SET equipe_id = equipe__id WHERE id = inscription_id;
    SET code_retour = 0; -- OK
END;
//
CALL addToEquipe(0,10,@code);
SELECT @code AS resultat; -- code 1 inscription inexistante

CALL addToEquipe(9,10,@code);
SELECT @code AS resultat; -- code 2 inscription inexistante

CALL addToEquipe(9,10,@code);
SELECT @code AS resultat; -- code 3 inscription inexistante

CALL addToEquipe(9,10,@code);
SELECT @code AS resultat; -- code 0 ok
-- PROF : OK
    -- TODO CASE
-- test : tu devrais proposer 4 cas de tests différents.

-- -- -- -- -- Niveau 3 -- -- -- -- --
delimiter //
DROP PROCEDURE IF EXISTS getHackathonAllPjRetenue //
CREATE PROCEDURE getHackathonAllPjRetenue()
BEGIN
    select distinct hackathon.* from hackathon inner join projet on projet.hackathon_id=hackathon.id GROUP BY hackathon.id
    HAVING SUM(projet.retenu = 'oui') = COUNT(projet.id);
END
//
CALL getHackathonAllPjRetenue();
-- PROF : OK
