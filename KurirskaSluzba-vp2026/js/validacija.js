// Zajednicki helperi za JavaScript validaciju formi.
// Prikaz crvene poruke ispod polja i ciscenje prethodnih gresaka.

function prikaziGresku(polje, poruka) {
    const porukaElement = document.createElement("span");
    porukaElement.className = "greska";
    porukaElement.textContent = poruka;
    polje.insertAdjacentElement("afterend", porukaElement);
    polje.classList.add("polje-greska");
}

function ocistiGreske(forma) {
    forma.querySelectorAll(".greska").forEach(e => e.remove());
    forma.querySelectorAll(".polje-greska").forEach(e => e.classList.remove("polje-greska"));
}
