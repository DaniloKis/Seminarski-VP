-- ============================================================
-- MASTER-DETAIL: Otpremnica (celina) -> Stavke otpremnice (delovi)
-- Dodatne tabele; postojece (kurir, paket, korisnik) se NE menjaju.
-- Jedna otpremnica = jedan preuzimanje/tura kurira sa vise paketa (stavki).
-- ============================================================

CREATE TABLE IF NOT EXISTS `otpremnica`
(
   `BrojOtpremnice`    int          NOT NULL AUTO_INCREMENT PRIMARY KEY,
   `Datum`             date         NOT NULL,
   `Posiljalac`        varchar(80)  NOT NULL,
   `AdresaPreuzimanja` varchar(120) NOT NULL,
   `IDKurira`          varchar(10)  NOT NULL,
   `UkupnaCena`        decimal(10,2) NOT NULL,
   `Status`            varchar(20)  NOT NULL,
   CONSTRAINT `FK_OTP_KURIR` FOREIGN KEY (`IDKurira`)
       REFERENCES `kurir`(`IDKurira`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `otpremnicastavka`
(
   `IDStavke`          int          NOT NULL AUTO_INCREMENT PRIMARY KEY,
   `BrojOtpremnice`    int          NOT NULL,
   `Primalac`          varchar(80)  NOT NULL,
   `AdresaDostave`     varchar(120) NOT NULL,
   `OznakaUpozorenja`  varchar(30)  NOT NULL,
   `Tezina`            decimal(6,2) NOT NULL,
   `Cena`              decimal(10,2) NOT NULL,
   CONSTRAINT `FK_STAVKA_OTP` FOREIGN KEY (`BrojOtpremnice`)
       REFERENCES `otpremnica`(`BrojOtpremnice`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
