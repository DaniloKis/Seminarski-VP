// Validacija forme za korisnika (.forma-korisnik).
function validirajKorisnik(forma) {
    ocistiGreske(forma);
    let validno = true;
    const polje = (n) => forma.querySelector('[name="' + n + '"]');

    // Prezime i ime - obavezno, samo slova
    ['prezime', 'ime'].forEach(n => {
        const p = polje(n);
        if (p) {
            if (p.value.trim() === '') {
                prikaziGresku(p, 'Обавезно поље');
                validno = false;
            } else if (!/^[\p{L}\s-]+$/u.test(p.value.trim())) {
                prikaziGresku(p, 'Дозвољена су само слова');
                validno = false;
            }
        }
    });

    // Email - format
    const email = polje('email');
    if (email) {
        if (email.value.trim() === '') {
            prikaziGresku(email, 'Обавезно поље');
            validno = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
            prikaziGresku(email, 'Неисправан е-маил');
            validno = false;
        }
    }

    // Korisnicko ime - min 3, slova/brojevi/donja crta
    const ki = polje('korisnickoIme');
    if (ki) {
        if (ki.value.trim().length < 3) {
            prikaziGresku(ki, 'Најмање 3 карактера');
            validno = false;
        } else if (!/^[A-Za-z0-9_]+$/.test(ki.value.trim())) {
            prikaziGresku(ki, 'Дозвољени су слова, бројеви и доња црта');
            validno = false;
        }
    }

    // Sifra - najmanje 4 karaktera
    const sifra = polje('sifra');
    if (sifra && sifra.value.trim().length < 4) {
        prikaziGresku(sifra, 'Најмање 4 карактера');
        validno = false;
    }

    return validno;
}

document.addEventListener('DOMContentLoaded', () => {
    const forma = document.querySelector('.forma-korisnik');
    if (forma) {
        forma.addEventListener('submit', (dogadjaj) => {
            if (!validirajKorisnik(forma)) dogadjaj.preventDefault();
        });
    }
});
