
DROP TABLE IF EXISTS TEMPTABLE1;

CREATE TEMPORARY TABLE TEMPTABLE1 (suma INT, patro INT, fakulta INT,budova INT);



INSERT INTO TEMPTABLE1 (`suma`,`patro`,`fakulta`,`budova`) VALUES (0,0,0,0);


DELIMITER //

FOR i IN 1..(SELECT budova FROM `utb`.`mistnost` ORDER BY `budova` DESC LIMIT 1)
DO
    FOR j IN 1..(SELECT podlazi FROM `utb`.`mistnost` ORDER BY `podlazi` DESC LIMIT 1)
    DO
    INSERT INTO TEMPTABLE1 (`suma`,`patro`,`fakulta`,`budova`) VALUES 

            (
            (SELECT count(stav) FROM `utb`.`nabytek/msitnost` 
            JOIN nabytek ON nabytek=nabytek.id
            JOIN mistnost ON mistnost=mistnost.id
            WHERE budova = i AND podlazi = j AND stav = 4)
              ,
              (SELECT podlazi FROM `utb`.`nabytek/msitnost` 
            JOIN nabytek ON nabytek=nabytek.id
            JOIN mistnost ON mistnost=mistnost.id
            WHERE budova = i AND podlazi = j AND stav = 4 LIMIT 1)
              ,
              (SELECT fakulta FROM `utb`.`nabytek/msitnost` 
            JOIN nabytek ON nabytek=nabytek.id
            JOIN mistnost ON mistnost=mistnost.id
            WHERE budova = i AND podlazi = j AND stav = 4 LIMIT 1)
            ,
            (SELECT budova FROM `utb`.`nabytek/msitnost` 
            JOIN nabytek ON nabytek=nabytek.id
            JOIN mistnost ON mistnost=mistnost.id
            WHERE budova = i AND podlazi = j AND stav = 4 LIMIT 1)
              );

    END FOR;
END FOR;
//

DELIMITER ;

SELECT * FROM TEMPTABLE1 JOIN fakulty ON fakulta=fakulty.id;
