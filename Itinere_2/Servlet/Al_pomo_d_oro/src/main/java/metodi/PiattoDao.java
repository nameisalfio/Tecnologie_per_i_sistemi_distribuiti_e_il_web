package metodi;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import connessione.Connessione;
import model.Piatto;

public class PiattoDao {
	private Connection con = null;

	public void inserire(Piatto piatto) {
		String query = "INSERT INTO piatto( nome, costo, descrizione, tipo,immagine) values(?,?,?,?,?)";
		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			pst.setString(1, piatto.getNome_piatto());
			pst.setBigDecimal(2, piatto.getCosto());
			pst.setString(3, piatto.getDescrizione());
			pst.setString(4, piatto.getTipo());
			pst.setString(5, piatto.getImmagine());
			
			pst.executeUpdate();
		} catch (SQLException e) {
			System.out.println(e.getMessage());
		}

	}

	public void modifica(Piatto piatto) {
		String query = "UPDATE piatto SET nome = ?, costo = ?, descrizione = ?, tipo = ?, immagine = ? WHERE id ='"
				+ piatto.getId_piatto() + "'";
		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			pst.setString(1, piatto.getNome_piatto());
			pst.setBigDecimal(2, piatto.getCosto());
			pst.setString(3, piatto.getDescrizione());
			pst.setString(4, piatto.getTipo());
			pst.setString(5, piatto.getImmagine());
			
			pst.executeUpdate();
		} catch (SQLException e) {
			System.out.println(e.getMessage());
		}
	}

	public void elimina(int id_piatto) {
		String query = "DELETE FROM piatto WHERE id ='" + id_piatto + "'";

		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			pst.executeUpdate();
		} catch (SQLException e) {
			System.out.println(e.getMessage());
		}
	}

	public List<Piatto> lista() {
		String query = "SELECT * FROM piatto";
		List<Piatto> list = new ArrayList<Piatto>();
		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			ResultSet rst = pst.executeQuery();
			while (rst.next()) {
				Piatto piatto = new Piatto(rst.getInt(1),rst.getString(2),rst.getBigDecimal(3),rst.getString(4), rst.getString(5),rst.getString(6));
				
				
				list.add(piatto);
			}
		} catch (SQLException e) {
			System.out.println(e.getMessage());
		}
		return list;
	}

	public Piatto cerca(int id) {
		String query = "SELECT * FROM Piatto where id ='" + id + "'";
		Piatto piatto = null;
		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			ResultSet rst = pst.executeQuery();
			rst.next();
			piatto = new Piatto(rst.getInt(1),rst.getString(2),rst.getBigDecimal(3),rst.getString(4), rst.getString(5),rst.getString(6));
			

		} catch (SQLException e) {
			System.out.println(e.getMessage());
		}
		return piatto;

	}

}
