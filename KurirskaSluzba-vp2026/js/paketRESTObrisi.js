// REST brisanje paketa (DELETE + JSON telo). Poziva se nakon svakog iscrtavanja tabele.
function inicijalizujBrisanje() {
    document.querySelectorAll('.btn-obrisi').forEach(dugme => {
        dugme.addEventListener('click', async (dogadjaj) => {
            dogadjaj.preventDefault();
            const sifraPaketa = dugme.dataset.sifra;

            if (!confirm('Да ли сте сигурни да желите брисање пакета?')) return;

            try {
                const odgovor = await fetch(OSNOVA_APP + '/rest/paket/paketObrisi.php', {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ sifraPaketa })
                });

                const rezultat = await odgovor.json();

                if (rezultat.uspeh) {
                    alert(rezultat.poruka);
                    dugme.closest('tr').remove();
                } else {
                    alert('Грешка: ' + rezultat.poruka);
                }
            } catch (greska) {
                console.error('Грешка при слању података:', greska);
                alert('Дошло је до грешке. Проверите конзолу.');
            }
        });
    });
}
