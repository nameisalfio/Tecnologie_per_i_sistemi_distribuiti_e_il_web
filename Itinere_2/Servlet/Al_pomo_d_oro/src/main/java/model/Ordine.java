package model;

public class Ordine {
	private int id_ordini;
	private int id_tavolo;
	private int id_piatto;
	private String stato;

	public Ordine(int id, int t, int p) {
		this.id_ordini = id;
		this.id_tavolo = t;
		this.id_piatto = p;
		this.stato = "in preparazione";
	}

	public Ordine() {
	}

	public int getId_ordini() {
		return id_ordini;
	}

	public void setId_ordini(int id_ordini) {
		this.id_ordini = id_ordini;
	}

	public int getId_tavolo() {
		return id_tavolo;
	}

	public void setId_tavolo(int id_tavolo) {
		this.id_tavolo = id_tavolo;
	}

	public int getId_piatto() {
		return id_piatto;
	}

	public void setId_piatto(int id_piatto) {
		this.id_piatto = id_piatto;
	}

	public String getStato() {
		return stato;
	}

	public void setStato(String stato) {
		this.stato = stato;
	}

}
