import java.io.*;
import java.sql.*;
import jakarta.servlet.http.*;
import jakarta.servlet.annotation.*;

@WebServlet("/book")
public class BookServlet extends HttpServlet{
    Connection conn = null;

    public void init() {
        try {
            conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/Biblioteca?user=root&password=root");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void doGet(HttpServletRequest req, HttpServletResponse resp) {
        try {
            PrintWriter out = resp.getWriter();
            resp.setContentType("text/html");

            if (req.getParameter("action").equals("read")) {
                String query = "SELECT * FROM books";
                PreparedStatement stmt = conn.prepareStatement(query);
                ResultSet res = stmt.executeQuery();
                while (res.next()) {
                    String isbn = res.getString("isbn");
                    String titolo = res.getString("titolo");
                    String autore = res.getString("autore");
                    String prezzo = res.getString("prezzo");
                    out.print("<p>ISBN: <a href='/book?action=form&titolo="+titolo+"&autore="+autore+"&prezzo="+prezzo+"&isbn="+isbn+"'>"+isbn+"</a> | Titolo: "+titolo+" | Autore: "+autore+" | Prezzo: "+prezzo+"</p>");
                }
            } 
            
            if (req.getParameter("action").equals("form")) {
                String isbn = req.getParameter("isbn");
                String titolo = req.getParameter("titolo");
                String autore = req.getParameter("autore");
                String prezzo = req.getParameter("prezzo");
                out.print("<form action='/book' method='POST'>");

                out.print("Titolo:<input type='text' name='titolo' value="+titolo+"><br>");
                out.print("Autore<input type='text' name='autore' value="+autore+"><br>");
                out.print("Prezzo<input type='text' name='prezzo' value="+prezzo+"><br><br>");
                
                out.print("<input type='submit' name='action' value='Aggiorna'>");
                out.print("<input type='submit' name='action' value='Rimuovi'>");
                out.print("<input type='hidden' name='isbn' value="+isbn+">");
                out.print("</form>");
            }
            out.print("<a href='index.jsp'><button>Torna alla homepage</button></a>");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void doPost(HttpServletRequest req, HttpServletResponse resp) {
        try {
            PrintWriter out = resp.getWriter();
            resp.setContentType("text/html");

            if (req.getParameter("action").equals("create")) {
                String titolo = req.getParameter("titolo");
                String autore = req.getParameter("autore");
                String prezzo = req.getParameter("prezzo");

                String query = "INSERT INTO books (titolo, autore, prezzo) VALUES (?,?,?)";
                PreparedStatement stmt = conn.prepareStatement(query);
                stmt.setString(1, titolo);
                stmt.setString(2, autore);
                stmt.setString(3, prezzo);
                stmt.executeUpdate();
                out.print("<p>Libro inserito con successo</p>");
            }

            if (req.getParameter("action").equals("Aggiorna")) {
                String isbn = req.getParameter("isbn");
                String titolo = req.getParameter("titolo");
                String autore = req.getParameter("autore");
                String prezzo = req.getParameter("prezzo");

                String query = "UPDATE books SET titolo=?, autore=?, prezzo=? WHERE isbn=?";
                PreparedStatement stmt = conn.prepareStatement(query);
                stmt.setString(1, titolo);
                stmt.setString(2, autore);
                stmt.setString(3, prezzo);
                stmt.setString(4, isbn);
                stmt.executeUpdate();
                out.print("<p>Libro aggiornato con successo</p>");
            }

            if (req.getParameter("action").equals("Rimuovi")) {
                String isbn = req.getParameter("isbn");

                String query = "DELETE FROM books WHERE isbn=?";
                PreparedStatement stmt = conn.prepareStatement(query);
                stmt.setString(1, isbn);
                stmt.executeUpdate();
                out.print("<p>Libro rimosso con successo</p>");
            }

            out.print("<a href='index.jsp'><button>Torna alla homepage</button></a>");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
