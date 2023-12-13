import java.io.*;
import java.sql.*;
import jakarta.servlet.http.*;
import jakarta.servlet.annotation.*;

@WebServlet("/store")
public class StoreServlet extends HttpServlet{
    Connection conn = null;

    public void init() {
        try {
            conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/Magazine?user=root&password=root");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void doGet(HttpServletRequest req, HttpServletResponse resp) {
        try {
            resp.setContentType("text/html");
            PrintWriter out = resp.getWriter();
            out.print("<link rel='stylesheet' href='css/style.css'>");
            String query = "SELECT * FROM prodotti WHERE giacenza > 0";
            PreparedStatement stmt = conn.prepareStatement(query);
            ResultSet res = stmt.executeQuery();

            if (res.next()) {
                out.print("<h3>Magazzino:</h3>");
                do {
                    out.println("<form action='/store' method='POST'>");
                    out.println("<p>Nome: " + res.getString("nome_prodotto") + ", giacenza: " + res.getString("giacenza") + ", prezzo: " + res.getString("prezzo") +
                            "<input type='hidden' name='id' value='" + res.getInt("id") + "'>" +
                            "<input type='number' name='amount'>"+
                            "<button type='submit' name='action' value='update'>Compra</button>" +
                            "<button type='submit' name='action' value='delete'>Rimuovi</button></p>");
                    out.println("</form>");           
                } while (res.next());
            } else {
                out.print("<h3>Magazzino vuoto</h3>");
            }
            out.print("<a href='index.jsp'><button>Torna alla home</button></a>");
        } catch (Exception e) {
           e.printStackTrace();
        }
    }

    public void doPost(HttpServletRequest req, HttpServletResponse resp) {
        try {
            resp.setContentType("text/html");
            PrintWriter out = resp.getWriter();
            out.print("<link rel='stylesheet' href='css/style.css'>");

            if (req.getParameter("action") != null) {

                if (req.getParameter("action").equals("create")) {
                    String query = "INSERT INTO prodotti (nome_prodotto, giacenza, prezzo) VALUES (?,?,?)";
                    PreparedStatement stmt = conn.prepareStatement(query);
                    stmt.setString(1, req.getParameter("nome"));
                    stmt.setString(2, req.getParameter("giacenza"));
                    stmt.setString(3, req.getParameter("prezzo"));
                    stmt.executeUpdate();
                    out.print("<p>Prodotto inserito con successo</p>");
                }

                if (req.getParameter("action").equals("update")) {
                    String query = "UPDATE prodotti SET giacenza=giacenza-? WHERE id=?";
                    PreparedStatement stmt = conn.prepareStatement(query);
                    stmt.setString(1, req.getParameter("amount"));
                    stmt.setString(2, req.getParameter("id"));
                    stmt.executeUpdate();
                    out.print("<p>Prodotto acquistato con successo</p>");
                }

                if (req.getParameter("action").equals("delete")) {
                    String query = "DELETE FROM prodotti WHERE id=?";
                    PreparedStatement stmt = conn.prepareStatement(query);
                    stmt.setString(1, req.getParameter("id"));
                    stmt.executeUpdate();
                    out.print("<p>Prodotto rimosso con successo dal magazzino</p>");
                }
            }
            out.print("<a href='index.jsp'><button>Torna alla home</button></a>");
        } catch (Exception e) {
           e.printStackTrace();
        }
    }
}


