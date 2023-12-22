import java.io.*;
import java.sql.*;
import jakarta.servlet.http.*;
import jakarta.servlet.annotation.*;

@WebServlet("/farmacia")
public class FarmaciaServlet extends HttpServlet {
    
    Connection conn;

    public void init() {
        try {
            conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/Farmacia?user=root&password=root");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void doGet(HttpServletRequest req, HttpServletResponse resp) {
        try {
            resp.setContentType("text/html");
            PrintWriter out = resp.getWriter();
            out.print("<link rel='stylesheet' type='text/css' href='./css/style.css'>");

            if (req.getParameter("action").equals("Ricerca")) {

                String query="";

                if (req.getParameter("Principio_Attivo").equals("Vedi tutti")) 
                    query = "SELECT * FROM Medicinali";
                else
                    query = "SELECT * FROM Medicinali WHERE Principio_Attivo = '"+req.getParameter("Principio_Attivo")+"'";

                PreparedStatement stmt = conn.prepareStatement(query);
                ResultSet res = stmt.executeQuery();
                
                out.print("<h2>Medicinali trovati:</h2>");
                while(res.next()) {
                    String id = res.getString("ID");
                    String Nome_Medicinale = res.getString("Nome_Medicinale");
                    String Principio_Attivo = res.getString("Principio_Attivo");
                    String Forma_Farmaceutica = res.getString("Forma_Farmaceutica");
                    String Dosaggio = res.getString("Dosaggio");
                    String Scadenza = res.getString("Scadenza");
                    out.print("<p>ID: "+id+", Nome: "+Nome_Medicinale+", Principio attivo: "+Principio_Attivo+", Forma : "+Forma_Farmaceutica+", Dosaggio: "+Dosaggio+", Scadenza: "+Scadenza+"</p>");
                }
            }

            out.print("<a href='index.jsp'><button>Torna alla homepage</button></a>");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void doPost(HttpServletRequest req, HttpServletResponse resp) {
        try {
            resp.setContentType("text/html");
            PrintWriter out = resp.getWriter();
            out.print("<link rel='stylesheet' type='text/css' href='./css/style.css'>");

            if (req.getParameter("action").equals("Inserisci")) {

                String Nome_Medicinale = req.getParameter("Nome_Medicinale");
                String Principio_Attivo = req.getParameter("Principio_Attivo");
                String Forma_Farmaceutica = req.getParameter("Forma_Farmaceutica");
                String Dosaggio = req.getParameter("Dosaggio");
                String Scadenza = req.getParameter("Scadenza");

                String query = "INSERT INTO Medicinali (Nome_Medicinale, Principio_Attivo, Forma_Farmaceutica, Dosaggio, Scadenza) VALUES (?,?,?,?,?)";
                PreparedStatement stmt = conn.prepareStatement(query);
                stmt.setString(1, Nome_Medicinale);
                stmt.setString(2, Principio_Attivo);
                stmt.setString(3, Forma_Farmaceutica);
                stmt.setString(4, Dosaggio);
                stmt.setString(5, Scadenza);
                stmt.executeUpdate();
                out.print("<p>Inserito correttamente</p>");
            }

            if (req.getParameter("action").equals("Aggiorna")) {

                String Nome_Medicinale = req.getParameter("Nome_Medicinale");
                String Scadenza = req.getParameter("Scadenza");

                String query = "UPDATE Medicinali SET Scadenza = ? WHERE Nome_Medicinale=?";
                PreparedStatement stmt = conn.prepareStatement(query);
                stmt.setString(1, Scadenza);
                stmt.setString(2, Nome_Medicinale);
                stmt.executeUpdate();
                out.print("<p>Aggiornato correttamente</p>");
            }

            if (req.getParameter("action").equals("Rimuovi")) {

                String Nome_Medicinale = req.getParameter("Nome_Medicinale");

                String query = "DELETE FROM Medicinali WHERE Nome_Medicinale=?";
                PreparedStatement stmt = conn.prepareStatement(query);
                stmt.setString(1, Nome_Medicinale);
                stmt.executeUpdate();
                out.print("<p>Rimosso correttamente</p>");
            }

            out.print("<a href='index.jsp'><button>Torna alla homepage</button></a>");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
