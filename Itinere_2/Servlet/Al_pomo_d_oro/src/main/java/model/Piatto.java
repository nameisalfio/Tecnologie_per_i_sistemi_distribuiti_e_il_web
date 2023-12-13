package model;

import java.math.BigDecimal;

public class Piatto {
	private int id_piatto;
	private String nome_piatto;
	private BigDecimal costo;
	private String descrizione;
	private String tipo;
	private String immagine;

	public Piatto(int id, String n, BigDecimal c, String descrizione, String tipo,String im) {
		this.id_piatto = id;
		this.nome_piatto = n;
		this.costo = c;
		this.descrizione = descrizione;
		this.tipo = tipo;
		this.immagine = im;
	}

	public Piatto() {
	}

	public int getId_piatto() {
		return id_piatto;
	}

	public void setId_piatto(int id_piatto) {
		this.id_piatto = id_piatto;
	}

	public String getNome_piatto() {
		return nome_piatto;
	}

	public void setNome_piatto(String nome_piatto) {
		this.nome_piatto = nome_piatto;
	}

	public BigDecimal getCosto() {
		return costo;
	}

	public void setCosto(BigDecimal costo) {
		this.costo = costo;
	}

	public String getDescrizione() {
		return descrizione;
	}

	public void setDescrizione(String descrizione) {
		this.descrizione = descrizione;
	}

	@Override
	public String toString() {
		return "Piatto [id_piatto=" + id_piatto + ", nome_piatto=" + nome_piatto + ", costo=" + costo + ", descrizione="
				+ descrizione + "]";
	}

	public String getTipo() {
		return tipo;
	}

	public void setTipo(String tipo) {
		this.tipo = tipo;
	}

	public String getImmagine() {
		return immagine;
	}

	public void setImmagine(String immagine) {
		this.immagine = immagine;
	}
	

}
