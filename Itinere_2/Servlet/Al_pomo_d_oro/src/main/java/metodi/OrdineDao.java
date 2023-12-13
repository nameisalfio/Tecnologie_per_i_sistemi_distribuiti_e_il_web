package metodi;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import connessione.Connessione;
import model.Ordine;

public class OrdineDao {

	private Connection con = null;

	public void inserire(Ordine ord) {
		String query = "INSERT INTO ordine(id_tavolo, id_piatto, stato) values(?,?,?)";

		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);

			pst.setInt(1, ord.getId_tavolo());
			pst.setInt(2, ord.getId_piatto());
			pst.setString(3, ord.getStato());
			pst.executeUpdate();

		} catch (SQLException e) {
			System.out.println(e.getMessage());
		}
	}

	public void modifica(Ordine ord) {
		String query = "UPDATE ordine SET id_tavolo = ?, id_piatto = ?, stato = ? WHERE id ='"
				+ ord.getId_ordini() + "'";

		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			pst.setInt(1, ord.getId_tavolo());
			pst.setInt(2, ord.getId_piatto());
			pst.setString(3, ord.getStato());
			pst.executeUpdate();

		} catch (SQLException e) {
			System.out.println(e.getMessage());
		}
	}

	public void elimina(int id_ord) {
		String query = "DELETE FROM ordine WHERE id ='" + id_ord + "'";

		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			pst.executeUpdate();
		} catch (SQLException e) {
			System.out.println(e.getMessage());
		}
	}

	public List<Ordine> lista() {
		List<Ordine> result = new ArrayList<>();
		String query = "SELECT * FROM ordine";

		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			ResultSet rs = pst.executeQuery();

			while (rs.next()) {

				Ordine ord = new Ordine(
						rs.getInt("id"),
						rs.getInt("id_tavolo"),
						rs.getInt("id_piatto"));
				ord.setStato(rs.getString("stato"));

				result.add(ord);
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}

		return result;
	}

	public Ordine cerca(int id_ord) {
		String query = "SELECT * FROM ordine where id ='" + id_ord + "'";
		Ordine ord = null;
		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			ResultSet rs = pst.executeQuery();
			rs.next();

			ord = new Ordine(
					rs.getInt("id"),
					rs.getInt("id_tavolo"),
					rs.getInt("id_piatto"));
			ord.setStato(rs.getString("stato"));

		} catch (SQLException e) {
			System.out.println(e.getMessage());
		}
		return ord;
	}
	
	public Ordine cerca_tavolo(int id_tav) {
		String query = "SELECT * FROM ordine where id_tavolo ='" + id_tav + "'";
		Ordine ord = null;
		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			ResultSet rs = pst.executeQuery();
			rs.next();

			ord = new Ordine(
					rs.getInt("id"),
					rs.getInt("id_tavolo"),
					rs.getInt("id_piatto"));
			ord.setStato(rs.getString("stato"));

		} catch (SQLException e) {
			System.out.println(e.getMessage());
		}
		return ord;
	}
}

