<header>
    <nav>
        <ul>
            <li><a href="<?php echo OSNOVA; ?>/pocetna/index">Почетна</a></li>
            <li><a href="<?php echo OSNOVA; ?>/paket/index">Пакети</a></li>
            <li><a href="<?php echo OSNOVA; ?>/paket/prikazRest">Пакети (REST)</a></li>
            <li><a href="<?php echo OSNOVA; ?>/otpremnica/index">Отпремнице (M–D)</a></li>
            <li><a href="<?php echo OSNOVA; ?>/kurir/index">Курири</a></li>
            <li><a href="<?php echo OSNOVA; ?>/kurir/prikazRest">Курири (REST)</a></li>
            <li><a href="<?php echo OSNOVA; ?>/korisnik/index">Корисници</a></li>
            <li><a href="<?php echo OSNOVA; ?>/korisnik/prikazRest">Корисници (REST)</a></li>
            <li style="margin-left:auto;">
                <a href="<?php echo OSNOVA; ?>/korisnik/odjava">Одјава<?php
                    if (isset($_SESSION['korisnik'])) { echo ' (' . htmlspecialchars($_SESSION['korisnik']) . ')'; }
                ?></a>
            </li>
        </ul>
    </nav>
</header>
