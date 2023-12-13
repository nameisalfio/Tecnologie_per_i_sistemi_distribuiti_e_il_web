package connessione;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class Connessione {
    private static Connessione instance;
    private Connection connection;

    // Costruttore privato per impedire l'istanziazione diretta
    private Connessione() {
        try {
            // Configura la connessione al tuo database
            String url = "jdbc:mysql://localhost:3306/ristorante";
            String user = "root";
            String password = "root";
            connection = DriverManager.getConnection(url, user, password);
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    // Metodo per ottenere l'istanza della connessione
    public static synchronized Connessione getInstance() {
        if (instance == null) {
            instance = new Connessione();
        }
        return instance;
    }

    // Metodo per ottenere la connessione al database
    public Connection getConnection() {
        return connection;
    }
}
