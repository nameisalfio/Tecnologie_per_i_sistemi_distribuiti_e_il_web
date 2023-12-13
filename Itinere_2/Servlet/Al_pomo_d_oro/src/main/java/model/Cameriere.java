package model;

public class Cameriere {
	private int id_cameriere;
	private String nome;
	private String cognome;
	private String username;
	private String password;
	
	public Cameriere(int id, String n, String c, String u, String p) {
		this.id_cameriere = id;
		this.nome = n;
		this.cognome = c;
		this.username = u;
		this.password = p;
	}
	
	public Cameriere() {}

	public int getId_cameriere() {
		return id_cameriere;
	}

	public void setId_cameriere(int id_cameriere) {
		this.id_cameriere = id_cameriere;
	}

	public String getNome() {
		return nome;
	}

	public void setNome(String nome) {
		this.nome = nome;
	}

	public String getCognome() {
		return cognome;
	}

	public void setCognome(String cognome) {
		this.cognome = cognome;
	}

	public String getUsername() {
		return username;
	}

	public void setUsername(String username) {
		this.username = username;
	}

	public String getPassword() {
		return password;
	}

	public void setPassword(String password) {
		this.password = password;
	}

}
