// REST ucitavanje liste korisnika preko fetch (GET -> JSON).
function ucitajKorisnike(prezime = "") {
    let url = OSNOVA_APP + '/rest/korisnik/korisnikUcitajSve.php';
    if (prezime !== "") {
        url += '?prezime=' + encodeURIComponent(prezime);
    }

    fetch(url)
        .then(odgovor => odgovor.json())
        .then(lista => {
            const telo = document.querySelector('.tabela tbody');
            telo.innerHTML = '';

            lista.forEach(k => {
                const red = document.createElement('tr');
                red.innerHTML = `
                    <td>${k.idKorisnika}</td>
                    <td>${k.prezime}</td>
                    <td>${k.ime}</td>
                    <td>${k.email}</td>
                    <td>${k.korisnickoIme}</td>
                    <td>${k.statusUcesca}</td>
                    <td class="akcije">
                        <a class="btn-izmeni" href="${OSNOVA_APP}/korisnik/izmeniForm/${encodeURIComponent(k.idKorisnika)}">Измени</a>
                        <a href="#" class="btn-obrisi" data-id="${k.idKorisnika}">Обриши</a>
                    </td>
                `;
                telo.appendChild(red);
            });

            if (typeof inicijalizujBrisanje === 'function') {
                inicijalizujBrisanje();
            }
        });
}

document.addEventListener('DOMContentLoaded', () => {
    ucitajKorisnike();

    const forma = document.querySelector('#filterForm');
    if (forma) {
        const input = forma.querySelector('input[name="prezime"]');
        forma.addEventListener('submit', (dogadjaj) => {
            dogadjaj.preventDefault();
            ucitajKorisnike(input.value.trim());
        });
        const dugmeSvi = forma.querySelector('.btn-sve');
        if (dugmeSvi) {
            dugmeSvi.addEventListener('click', (dogadjaj) => {
                dogadjaj.preventDefault();
                input.value = '';
                ucitajKorisnike();
            });
        }
    }
});
