// REST dodavanje paketa (POST + JSON telo).
document.addEventListener('DOMContentLoaded', () => {
    const forma = document.querySelector('.forma-dodaj');
    if (!forma) return;

    forma.addEventListener('submit', async (dogadjaj) => {
        dogadjaj.preventDefault();

        // JS validacija pre slanja
        if (typeof validirajPaket === 'function' && !validirajPaket(forma)) return;

        const podaci = Object.fromEntries(new FormData(forma).entries());

        try {
            const odgovor = await fetch(OSNOVA_APP + '/rest/paket/paketSnimi.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(podaci)
            });

            const rezultat = await odgovor.json();

            if (rezultat.uspeh) {
                alert(rezultat.poruka);
                forma.reset();
                if (typeof ucitajPakete === 'function') ucitajPakete();
            } else {
                alert('Грешка: ' + rezultat.poruka);
            }
        } catch (greska) {
            console.error('Грешка при слању података:', greska);
            alert('Дошло је до грешке. Проверите конзолу.');
        }
    });
});
