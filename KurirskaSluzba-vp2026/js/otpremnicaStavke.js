// Dinamicko dodavanje/uklanjanje stavki (delova) na master-detail formi otpremnice.
const tabela = document.querySelector('#stavkeTabela tbody');
const dugmeDodaj = document.getElementById('dodajStavku');

const opcijeUpozorenja = [
    { v: 'Nema', t: 'Нема' },
    { v: 'Lomljivo', t: 'Ломљиво' },
    { v: 'Opasno', t: 'Опасно' },
    { v: 'Hitno', t: 'Хитно' }
];

function prenumerisi() {
    Array.from(tabela.rows).forEach((r, i) => { r.cells[0].textContent = i + 1; });
}

function dodajBrisanje(btn) {
    btn.addEventListener('click', () => {
        if (tabela.rows.length > 1) {
            btn.closest('tr').remove();
            prenumerisi();
        } else {
            alert('Отпремница мора имати бар једну ставку.');
        }
    });
}

dugmeDodaj.addEventListener('click', () => {
    const noviRed = tabela.insertRow();

    // Р.б.
    noviRed.insertCell().textContent = tabela.rows.length;

    // Прималац
    const primalac = document.createElement('input');
    primalac.type = 'text'; primalac.name = 'primalac[]'; primalac.required = true;
    noviRed.insertCell().appendChild(primalac);

    // Адреса доставе
    const adresa = document.createElement('input');
    adresa.type = 'text'; adresa.name = 'adresaDostave[]'; adresa.required = true;
    noviRed.insertCell().appendChild(adresa);

    // Упозорење
    const select = document.createElement('select');
    select.name = 'oznakaUpozorenja[]';
    opcijeUpozorenja.forEach(o => {
        const op = document.createElement('option');
        op.value = o.v; op.textContent = o.t;
        select.appendChild(op);
    });
    noviRed.insertCell().appendChild(select);

    // Тежина
    const tezina = document.createElement('input');
    tezina.type = 'number'; tezina.step = '0.01'; tezina.min = '0'; tezina.name = 'tezina[]'; tezina.required = true;
    noviRed.insertCell().appendChild(tezina);

    // Цена
    const cena = document.createElement('input');
    cena.type = 'number'; cena.step = '0.01'; cena.min = '0'; cena.name = 'cena[]'; cena.required = true;
    noviRed.insertCell().appendChild(cena);

    // Дугме за брисање
    const btn = document.createElement('button');
    btn.type = 'button'; btn.textContent = 'Обриши'; btn.className = 'btn btn-obrisi-stavku';
    dodajBrisanje(btn);
    noviRed.insertCell().appendChild(btn);
});

// Брисање за почетни ред
document.querySelectorAll('.btn-obrisi-stavku').forEach(dodajBrisanje);
