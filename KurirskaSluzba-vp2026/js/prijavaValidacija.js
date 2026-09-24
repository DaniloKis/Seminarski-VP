// Validacija forme za prijavu (.forma-prijava) - samo popunjenost polja.
function validirajPrijavu(forma) {
    ocistiGreske(forma);
    let validno = true;
    const polje = (n) => forma.querySelector('[name="' + n + '"]');

    ['korisnickoIme', 'sifra'].forEach(n => {
        const p = polje(n);
        if (p && p.value.trim() === '') {
            prikaziGresku(p, 'Обавезно поље');
            validno = false;
        }
    });

    return validno;
}

document.addEventListener('DOMContentLoaded', () => {
    const forma = document.querySelector('.forma-prijava');
    if (forma) {
        forma.addEventListener('submit', (dogadjaj) => {
            if (!validirajPrijavu(forma)) dogadjaj.preventDefault();
        });
    }
});
