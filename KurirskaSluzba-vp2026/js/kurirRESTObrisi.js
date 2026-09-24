// REST brisanje kurira (DELETE + JSON telo).
function inicijalizujBrisanje() {
    document.querySelectorAll('.btn-obrisi').forEach(dugme => {
        dugme.addEventListener('click', async (dogadjaj) => {
            dogadjaj.preventDefault();
            const idKurira = dugme.dataset.id;

            if (!confirm('Да ли сте сигурни да желите брисање курира?')) return;

            try {
                const odgovor = await fetch(OSNOVA_APP + '/rest/kurir/kurirObrisi.php', {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ idKurira })
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
