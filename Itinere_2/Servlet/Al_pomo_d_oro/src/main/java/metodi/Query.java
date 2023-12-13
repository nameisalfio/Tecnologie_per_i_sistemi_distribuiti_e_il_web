package metodi;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import connessione.Connessione;

public class Query {
	private Connection con = null;
	
	public ResultSet getResult(String query) {
		ResultSet result = null;
        
        try {
            con = Connessione.getInstance().getConnection();
            PreparedStatement pst = con.prepareStatement(query);
            result = pst.executeQuery();
        } catch (SQLException e) {
            System.out.println(e.getMessage());
        }
		return result;
	}
	
	public void executeUpdate(String query) {
        try {
            con = Connessione.getInstance().getConnection();
            PreparedStatement pst = con.prepareStatement(query);
            pst.executeUpdate();
        } catch (SQLException e) {
            System.out.println(e.getMessage());
        }
	}

}
