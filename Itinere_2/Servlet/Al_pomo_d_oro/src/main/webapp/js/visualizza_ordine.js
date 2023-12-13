document.addEventListener("DOMContentLoaded", function () {
  const visualizzaOrdineLink = document.getElementById("visualizza-ordine");
  const chiudiOrdineLink = document.getElementById("chiudi-ordine");
  const tabellaOrdine = document.getElementById("tabella-ordine");
  const menu = document.getElementById("menu");
  const button = document.getElementById("paga1");

  visualizzaOrdineLink.addEventListener("click", function (event) {
    event.preventDefault(); // Impedisce al link di navigare a una nuova pagina
    tabellaOrdine.style.display = "table"; // Mostra la tabella dell'ordine
    menu.style.display = "none"; // Nasconde la tabella menù
      button.style.display= "none";
  });

  chiudiOrdineLink.addEventListener("click", function (event) {
    event.preventDefault(); // Impedisce al link di navigare a una nuova pagina
    menu.style.display = "table"; // Mostra la tabella menù
    tabellaOrdine.style.display = "none"; // Nasconde la tabella dell'ordine
    button.style.display= "inline-block";
  });
});