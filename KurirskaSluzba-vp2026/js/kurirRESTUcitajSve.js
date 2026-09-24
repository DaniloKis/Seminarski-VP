// REST ucitavanje liste kurira preko fetch (GET -> JSON).
function ucitajKurire(prezime = "") {
    let url = OSNOVA_APP + '/rest/kurir/kurirUcitajSve.php';
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
                    <td>${k.idKurira}</td>
                    <td>${k.prezime}</td>
                    <td>${k.ime}</td>
                    <td>${k.telefon}</td>
                    <td>${k.ukupanBrojPaketa}</td>
                    <td class="akcije">
                        <a class="btn-izmeni" href="${OSNOVA_APP}/kurir/izmeniForm/${encodeURIComponent(k.idKurira)}">Измени</a>
                        <a href="#" class="btn-obrisi" data-id="${k.idKurira}">Обриши</a>
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
    ucitajKurire();

    const forma = document.querySelector('#filterForm');
    if (forma) {
        const input = forma.querySelector('input[name="prezime"]');
        forma.addEventListener('submit', (dogadjaj) => {
            dogadjaj.preventDefault();
            ucitajKurire(input.value.trim());
        });
        const dugmeSvi = forma.querySelector('.btn-sve');
        if (dugmeSvi) {
            dugmeSvi.addEventListener('click', (dogadjaj) => {
                dogadjaj.preventDefault();
                input.value = '';
                ucitajKurire();
            });
        }
    }
});
