-- Stored procedure za unos paketa (koristi je "Унос применом SP" у MVC-у).
USE `Kurirska_Sluzba_2026`;

DROP PROCEDURE IF EXISTS `DodajPaket`;

DELIMITER $$
CREATE PROCEDURE `DodajPaket` (
    IN SifraPaketaParametar      varchar(15),
    IN PosiljalacParametar       varchar(80),
    IN AdresaPosiljaocaParametar varchar(120),
    IN PrimalacParametar         varchar(80),
    IN AdresaDostaveParametar    varchar(120),
    IN OznakaUpozorenjaParametar varchar(30),
    IN TezinaParametar           decimal(6,2),
    IN CenaParametar             decimal(10,2),
    IN StatusParametar           varchar(20),
    IN IDKuriraParametar         varchar(10)
)
BEGIN
    INSERT INTO `PAKET`
        (`SifraPaketa`, `Posiljalac`, `AdresaPosiljaoca`, `Primalac`, `AdresaDostave`,
         `OznakaUpozorenja`, `Tezina`, `Cena`, `Status`, `IDKurira`)
    VALUES
        (SifraPaketaParametar, PosiljalacParametar, AdresaPosiljaocaParametar, PrimalacParametar, AdresaDostaveParametar,
         OznakaUpozorenjaParametar, TezinaParametar, CenaParametar, StatusParametar, IDKuriraParametar);
END$$
DELIMITER ;
