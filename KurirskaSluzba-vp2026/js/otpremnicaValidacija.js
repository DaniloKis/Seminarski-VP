// Validacija master-detail forme otpremnice (.forma-otpremnica): zaglavlje + sve stavke.
function validirajOtpremnicu(forma) {
    ocistiGreske(forma);
    let validno = true;
    const polje = (n) => forma.querySelector('[name="' + n + '"]');

    // --- zaglavlje ---
    ['datum', 'posiljalac', 'adresaPreuzimanja'].forEach(n => {
        const p = polje(n);
        if (p && p.value.trim() === '') {
            prikaziGresku(p, 'Обавезно поље');
            validno = false;
        }
    });
    const kurir = polje('idKurira');
    if (kurir && kurir.value === '') {
        prikaziGresku(kurir, 'Изаберите курира');
        validno = false;
    }

    // --- stavke (delovi) ---
    const redovi = forma.querySelectorAll('#stavkeTabela tbody tr');
    let imaValidnuStavku = false;

    redovi.forEach(red => {
        const prim = red.querySelector('[name="primalac[]"]');
        const adr = red.querySelector('[name="adresaDostave[]"]');
        const tez = red.querySelector('[name="tezina[]"]');
        const cen = red.querySelector('[name="cena[]"]');

        if (prim && prim.value.trim() === '') { prikaziGresku(prim, 'Обавезно'); validno = false; }
        if (adr && adr.value.trim() === '') { prikaziGresku(adr, 'Обавезно'); validno = false; }
        if (tez && !(parseFloat(tez.value) > 0)) { prikaziGresku(tez, '> 0'); validno = false; }
        if (cen && !(parseFloat(cen.value) > 0)) { prikaziGresku(cen, '> 0'); validno = false; }

        if (prim && prim.value.trim() !== '') { imaValidnuStavku = true; }
    });

    if (!imaValidnuStavku) {
        alert('Отпремница мора имати бар једну ставку.');
        validno = false;
    }

    return validno;
}

document.addEventListener('DOMContentLoaded', () => {
    const forma = document.querySelector('.forma-otpremnica');
    if (forma) {
        forma.addEventListener('submit', (dogadjaj) => {
            if (!validirajOtpremnicu(forma)) dogadjaj.preventDefault();
        });
    }
});
