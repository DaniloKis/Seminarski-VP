// Validacija forme za kurira (.forma-kurir).
function validirajKurir(forma) {
    ocistiGreske(forma);
    let validno = true;
    const polje = (n) => forma.querySelector('[name="' + n + '"]');

    // ID kurira - obavezno, slova i brojevi
    const id = polje('idKurira');
    if (id) {
        if (id.value.trim() === '') {
            prikaziGresku(id, 'Обавезно поље');
            validno = false;
        } else if (!/^[A-Za-z0-9]+$/.test(id.value.trim())) {
            prikaziGresku(id, 'Дозвољени су само слова и бројеви');
            validno = false;
        }
    }

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

    // Telefon - obavezno, cifre/razmaci/+/-
    const tel = polje('telefon');
    if (tel) {
        if (tel.value.trim() === '') {
            prikaziGresku(tel, 'Обавезно поље');
            validno = false;
        } else if (!/^[0-9+\/\s-]+$/.test(tel.value.trim())) {
            prikaziGresku(tel, 'Неисправан број телефона');
            validno = false;
        }
    }

    // Ukupan broj paketa (samo na izmeni) - ceo broj >= 0
    const ukp = polje('ukupanBrojPaketa');
    if (ukp) {
        const v = parseInt(ukp.value, 10);
        if (isNaN(v) || v < 0) {
            prikaziGresku(ukp, 'Мора бити цео број ≥ 0');
            validno = false;
        }
    }

    return validno;
}

document.addEventListener('DOMContentLoaded', () => {
    const forma = document.querySelector('.forma-kurir');
    if (forma) {
        forma.addEventListener('submit', (dogadjaj) => {
            if (!validirajKurir(forma)) dogadjaj.preventDefault();
        });
    }
});
