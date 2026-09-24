// REST izmena paketa (PUT + JSON telo).
document.addEventListener('DOMContentLoaded', () => {
    const forma = document.querySelector('.forma-izmeni');
    if (!forma) return;

    forma.addEventListener('submit', async (dogadjaj) => {
        dogadjaj.preventDefault();

        // JS validacija pre slanja
        if (typeof validirajPaket === 'function' && !validirajPaket(forma)) return;

        const podaci = Object.fromEntries(new FormData(forma).entries());

        try {
            const odgovor = await fetch(OSNOVA_APP + '/rest/paket/paketIzmeni.php', {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(podaci)
            });

            const rezultat = await odgovor.json();

            if (rezultat.uspeh) {
                alert(rezultat.poruka);
                window.location.href = OSNOVA_APP + '/paket/prikazRest';
            } else {
                alert('Грешка: ' + rezultat.poruka);
            }
        } catch (greska) {
            console.error('Грешка при слању података:', greska);
            alert('Дошло је до грешке. Проверите конзолу.');
        }
    });
});
