package model;

public class Tavolo {
	private int id_tavolo;
	private int id_camerie;
	private int num_posti;
	private String stato;

	public Tavolo(int id, int n, int cp, String st) {
		this.id_tavolo = id;
		this.id_camerie = n;
		this.num_posti = cp;
		this.stato = st;
	}

	public Tavolo() {
	}

	public int getId_tavolo() {
		return id_tavolo;
	}

	public void setId_tavolo(int id_tavolo) {
		this.id_tavolo = id_tavolo;
	}

	public Integer getId_camerie() {
		return id_camerie;
	}

	public void setId_camerie(int id_camerie) {
		this.id_camerie = id_camerie;
	}

	public int getNum_posti() {
		return num_posti;
	}

	public void setNum_posti(int num_posti) {
		this.num_posti = num_posti;
	}

	public String getStato() {
		return stato;
	}

	public void setStato(String stato) {
		this.stato = stato;
	}
	

}
