package metodi;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import connessione.Connessione;
import model.Cameriere;


public class CameriereDao {

	private Connection con = null;

	public void inserire (Cameriere cam) {
		String query = "INSERT INTO cameriere( nome, cognome, username, password) values(?,?,?,?)";

		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);

			pst.setString(1, cam.getNome());
			pst.setString(2, cam.getCognome());
			pst.setString(3, cam.getUsername());
			pst.setString(4, cam.getPassword());
			pst.executeUpdate();

		} catch (SQLException e) {
			System.out.println(e.getMessage());
		}
	}

	public void modifica(Cameriere cam) {
		String query = "UPDATE cameriere SET nome = ?, cognome = ?, username = ?, password = ? WHERE id ='"
				+ cam.getId_cameriere() + "'";

		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			pst.setString(1, cam.getNome());
			pst.setString(2, cam.getCognome());
			pst.setString(3, cam.getUsername());
			pst.setString(4, cam.getPassword());
			pst.executeUpdate();

		} catch (SQLException e) {
			System.out.println(e.getMessage());
		}
	}

	public void elimina(int id_cam) {
		String query = "DELETE FROM cameriere WHERE id ='" + id_cam + "'";

		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			pst.executeUpdate();
		} catch (SQLException e) {
			System.out.println(e.getMessage());
		}
	}

	public List<Cameriere> lista() {
		List<Cameriere> result = new ArrayList<>();
		String query = "SELECT * FROM cameriere";

		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			ResultSet rs = pst.executeQuery();

			while (rs.next()) {
				Cameriere cam = new Cameriere(
						rs.getInt("id"),
						rs.getString("nome"),
						rs.getString("cognome"),
						rs.getString("username"),
						rs.getString("password")
						);
				result.add(cam);
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}

		return result;
	}
	
	public Cameriere cerca(int id_cam) {
        String query = "SELECT * FROM Cameriere where id ='"+id_cam+"'";
        Cameriere cam = null;
        try {
            con = Connessione.getInstance().getConnection();
            PreparedStatement pst = con.prepareStatement(query);
            ResultSet rs=  pst.executeQuery();
            rs.next();
			cam = new Cameriere(
					rs.getInt("id"),
					rs.getString("nome"),
					rs.getString("cognome"),
					rs.getString("username"),
					rs.getString("password")
					);
        } catch (SQLException e) {
            System.out.println(e.getMessage());
        }
        return cam;
    }
}
