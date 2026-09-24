// Validacija forme za paket (koriste je i MVC forme .forma-paket i REST forme .forma-dodaj/.forma-izmeni).
// Vraca true ako je forma validna.
function validirajPaket(forma) {
    ocistiGreske(forma);
    let validno = true;
    const polje = (n) => forma.querySelector('[name="' + n + '"]');

    // Obavezna tekstualna polja
    ['sifraPaketa', 'posiljalac', 'adresaPosiljaoca', 'primalac', 'adresaDostave'].forEach(n => {
        const p = polje(n);
        if (p && p.value.trim() === '') {
            prikaziGresku(p, 'Обавезно поље');
            validno = false;
        }
    });

    // Tezina i cena - broj veci od 0
    const tezina = polje('tezina');
    if (tezina && !(parseFloat(tezina.value) > 0)) {
        prikaziGresku(tezina, 'Мора бити број већи од 0');
        validno = false;
    }
    const cena = polje('cena');
    if (cena && !(parseFloat(cena.value) > 0)) {
        prikaziGresku(cena, 'Мора бити број већи од 0');
        validno = false;
    }

    // Kurir mora biti izabran
    const kurir = polje('idKurira');
    if (kurir && kurir.value === '') {
        prikaziGresku(kurir, 'Изаберите курира');
        validno = false;
    }

    return validno;
}

// MVC forme (serverski submit) - blokiraj slanje ako nije validno
document.addEventListener('DOMContentLoaded', () => {
    const forma = document.querySelector('.forma-paket');
    if (forma) {
        forma.addEventListener('submit', (dogadjaj) => {
            if (!validirajPaket(forma)) dogadjaj.preventDefault();
        });
    }
});
