import java.io.*;
import java.sql.*;
import jakarta.servlet.http.*;
import jakarta.servlet.annotation.*;

@WebServlet("/journal")
public class JournalServlet extends HttpServlet {
    Connection conn = null;

    public void init() {
        try {
            conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/journal?user=root&password=root");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void doPost(HttpServletRequest req, HttpServletResponse resp) {
        try {
            resp.setContentType("text/html");
            PrintWriter out = resp.getWriter();

            if (req.getParameter("action").equals("Correggi")) {
                String id = req.getParameter("id");
                String autore = req.getParameter("autore");

                String[] fields = autore.split("-");
    
                String query = "UPDATE fumetti SET autore_nome=?, autore_cognome=? WHERE id=?"; 
                PreparedStatement stmt = conn.prepareStatement(query);
                stmt.setString(1, fields[0]);
                stmt.setString(2, fields[1]);
                stmt.setString(3, id);

                stmt.executeUpdate();
                out.print("<p>Autore aggiornato correttamente</p>");
            }

            if (req.getParameter("action").equals("Rimuovi")) {
                String id = req.getParameter("id");    
                String query = "DELETE FROM fumetti WHERE id=?"; 
                PreparedStatement stmt = conn.prepareStatement(query);
                stmt.setString(1, id);

                stmt.executeUpdate();
                out.print("<p>Fumetto rimosso correttamente</p>");
            }

            out.print("<a href='index.jsp'><button>Torna alla homepage</button></a>");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
