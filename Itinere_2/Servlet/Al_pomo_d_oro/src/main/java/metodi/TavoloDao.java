package metodi;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import connessione.Connessione;
import model.Tavolo;

public class TavoloDao {
	private Connection con = null;

	public void inserire(Tavolo tavolo) {
		String query = "INSERT INTO tavolo( id_cameriere, num_posti) values(?,?)";
		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			pst.setInt(1, tavolo.getId_camerie());
			pst.setInt(2, tavolo.getNum_posti());
			pst.executeUpdate();
		} catch (SQLException e) {
			System.out.println(e.getMessage());
		}
	}

	public void modifica(Tavolo tavolo) {
		String query = "UPDATE tavolo SET id_cameriere = ?, num_posti = ? WHERE id ='" + tavolo.getId_tavolo() + "'";
		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			pst.setInt(1, tavolo.getId_camerie());
			pst.setInt(2, tavolo.getNum_posti());

			pst.executeUpdate();
		} catch (SQLException e) {
			System.out.println(e.getMessage());
		}
	}

	public void elimina(int id_tavolo) {
		String query = "DELETE FROM tavolo WHERE id ='" + id_tavolo + "'";

		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			pst.executeUpdate();
		} catch (SQLException e) {
			System.out.println(e.getMessage());
		}
	}

	public List<Tavolo> lista() {
		String query = "SELECT * FROM tavolo";
		List<Tavolo> list = new ArrayList<Tavolo>();
		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			ResultSet rst = pst.executeQuery();
			while (rst.next()) {
				Tavolo tavolo = new Tavolo(rst.getInt(1), rst.getInt(2), rst.getInt(3), rst.getString(4));

				list.add(tavolo);
			}
		} catch (SQLException e) {
			System.out.println(e.getMessage());
		}
		return list;
	}

	public Tavolo cerca(int id) {
		String query = "SELECT * FROM tavolo where id ='" + id + "'";
		Tavolo tavolo = null;
		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			ResultSet rst = pst.executeQuery();
			rst.next();
			tavolo = new Tavolo(rst.getInt(1), rst.getInt(2), rst.getInt(3), rst.getString(4));

		} catch (SQLException e) {
			System.out.println(e.getMessage());
		}
		return tavolo;

	}
}
