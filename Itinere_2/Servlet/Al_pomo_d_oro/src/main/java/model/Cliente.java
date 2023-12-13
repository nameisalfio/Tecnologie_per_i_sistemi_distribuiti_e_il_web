package model;

public class Cliente {
	private int id_cliente;
	private String nome_cliente;
	private String cognome_cliente;
	private int id_tavolo;

	public Cliente(int id, String n, String c, int id_tav) {
		this.id_cliente = id;
		this.nome_cliente = n;
		this.cognome_cliente = c;
		this.id_tavolo = id_tav;
	}

	public Cliente() {
	}

	public int getId_cliente() {
		return id_cliente;
	}

	public void setId_cliente(int id_cliente) {
		this.id_cliente = id_cliente;
	}

	public String getNome_cliente() {
		return nome_cliente;
	}

	public void setNome_cliente(String nome_cliente) {
		this.nome_cliente = nome_cliente;
	}

	public String getCognome_cliente() {
		return cognome_cliente;
	}

	public void setCognome_cliente(String cognome_cliente) {
		this.cognome_cliente = cognome_cliente;
	}

	public int getId_tavolo() {
		return id_tavolo;
	}

	public void setId_tavolo(int id_tavolo) {
		this.id_tavolo = id_tavolo;
	}

}
