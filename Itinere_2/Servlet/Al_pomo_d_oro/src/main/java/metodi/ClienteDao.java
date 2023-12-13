package metodi;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import connessione.Connessione;
import model.Cliente;

public class ClienteDao {
	private Connection con = null;

	public String inserire(Cliente cliente) {
		String query = "INSERT INTO cliente( nome, cognome, id_tavolo) values(?,?,?)";
		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			pst.setString(1, cliente.getNome_cliente());
			pst.setString(2, cliente.getCognome_cliente());
			pst.setInt(3, cliente.getId_tavolo());
			pst.executeUpdate();
			return "SUCCESS";
		} catch (SQLException e) {
			System.out.println(e.getMessage());
			return "FAILURE";
		}

	}

	public void modifica(Cliente cliente) {
		String query = "UPDATE cliente SET nome = ?, cognome = ?, username = ?, password = ? WHERE id ='"
				+ cliente.getId_cliente() + "'";
		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			pst.setString(1, cliente.getNome_cliente());
			pst.setString(2, cliente.getCognome_cliente());
			pst.setInt(3, cliente.getId_tavolo());
			
			pst.executeUpdate();
		} catch (SQLException e) {
			System.out.println(e.getMessage());
		}

	}

	public void elimina(int id_cliente) {
		String query = "DELETE FROM cliente WHERE id ='" + id_cliente + "'";

		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			pst.executeUpdate();
		} catch (SQLException e) {
			System.out.println(e.getMessage());
		}
	}

	public List<Cliente> lista() {
		String query = "SELECT * FROM cliente";
		List<Cliente> list = new ArrayList<Cliente>();
		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			ResultSet rst = pst.executeQuery();
			while (rst.next()) {
				Cliente n = new Cliente();
				n.setId_cliente(rst.getInt(1));
				n.setNome_cliente(rst.getString(2));
				n.setCognome_cliente(rst.getString(3));
				n.setId_tavolo(rst.getInt(4));
				
				list.add(n);
			}
		} catch (SQLException e) {
			System.out.println(e.getMessage());
		}
		return list;
	}

	public Cliente cerca(int id) {
		String query = "SELECT * FROM cliente where id ='" + id + "'";
		Cliente n = new Cliente();
		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			ResultSet rst = pst.executeQuery();
			rst.next();

			n.setId_cliente(rst.getInt(1));
			n.setNome_cliente(rst.getString(2));
			n.setCognome_cliente(rst.getString(3));
			n.setId_tavolo(rst.getInt(4));

		} catch (SQLException e) {
			System.out.println(e.getMessage());
		}
		return n;

	}
	
	public Cliente cerca_tavolo(int id_tavolo) {
		String query = "SELECT * FROM cliente where id_tavolo ='" + id_tavolo + "'";
		Cliente n = new Cliente();
		try {
			con = Connessione.getInstance().getConnection();
			PreparedStatement pst = con.prepareStatement(query);
			ResultSet rst = pst.executeQuery();
			rst.next();

			n.setId_cliente(rst.getInt(1));
			n.setNome_cliente(rst.getString(2));
			n.setCognome_cliente(rst.getString(3));
			n.setId_tavolo(rst.getInt(4));

		} catch (SQLException e) {
			System.out.println(e.getMessage());
		}
		return n;

	}

}
