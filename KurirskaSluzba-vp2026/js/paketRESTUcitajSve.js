// REST ucitavanje liste paketa preko fetch (GET -> JSON). OSNOVA_APP se postavlja u pogledu.
function ucitajPakete(sifra = "") {
    let url = OSNOVA_APP + '/rest/paket/paketUcitajSve.php';
    if (sifra !== "") {
        url += '?sifra=' + encodeURIComponent(sifra);
    }

    fetch(url)
        .then(odgovor => odgovor.json())
        .then(lista => {
            const telo = document.querySelector('.tabela tbody');
            telo.innerHTML = '';

            lista.forEach(p => {
                const red = document.createElement('tr');
                red.innerHTML = `
                    <td>${p.sifraPaketa}</td>
                    <td>${p.primalac}</td>
                    <td>${p.oznakaUpozorenja}</td>
                    <td>${p.tezina}</td>
                    <td>${p.cena}</td>
                    <td>${p.status}</td>
                    <td>${p.kurir}</td>
                    <td class="akcije">
                        <a class="btn-izmeni" href="${OSNOVA_APP}/paket/izmeniRestForm/${encodeURIComponent(p.sifraPaketa)}">Измени</a>
                        <a href="#" class="btn-obrisi" data-sifra="${p.sifraPaketa}">Обриши</a>
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
    ucitajPakete();

    const forma = document.querySelector('#filterForm');
    if (forma) {
        const input = forma.querySelector('input[name="sifra"]');
        forma.addEventListener('submit', (dogadjaj) => {
            dogadjaj.preventDefault();
            ucitajPakete(input.value.trim());
        });
        const dugmeSvi = forma.querySelector('.btn-sve');
        if (dugmeSvi) {
            dugmeSvi.addEventListener('click', (dogadjaj) => {
                dogadjaj.preventDefault();
                input.value = '';
                ucitajPakete();
            });
        }
    }
});
