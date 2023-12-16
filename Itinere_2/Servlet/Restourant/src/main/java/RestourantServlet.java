import java.io.*;
import java.sql.*;
import jakarta.servlet.http.*;
import jakarta.servlet.annotation.WebServlet;

@WebServlet("/servlet")
public class RestourantServlet extends HttpServlet {

    Connection conn;

    public void init() {
        try {
            conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/ristorante?user=root&password=root");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    protected void doGet(HttpServletRequest req, HttpServletResponse resp) {
        try {
            resp.setContentType("text/html");
            PrintWriter out = resp.getWriter();

            if (req.getParameter("action") != null) {
                if (req.getParameter("action").equals("read_table")) {
                    String query = "SELECT * FROM tavolo";
                    PreparedStatement stmt = conn.prepareStatement(query);
                    ResultSet res = stmt.executeQuery();    
        
                    out.print("<h2>Tavoli presenti</h2>");
                    while (res.next()) {
                        String id = res.getString("id");
                        String id_cameriere = res.getString("id_cameriere");
                        String num_posti = res.getString("num_posti");
                        String stato = res.getString("stato");

                        out.print("<form action='/servlet' method='POST'>");
                        out.print("<p>ID: "+id+", Cameriere: "+id_cameriere+", Posti: "+num_posti+", Stato: "+stato+"</p>");
                        out.print("<input type='hidden' name='id' value='"+id+"'>");

                        if (stato.equals("occupato"))
                            out.print("<button type='submit' name='action' value='update_libera'> Libera </button>");
                        else if (stato.equals("libero")) {
                            out.print("<label for='id_cameriere'>ID Cameriere: </label>");
                            out.print("<input type='text' name='id_cameriere'>");
                            out.print("<button type='submit' name='action' value='update_occupa'> Occupa </button>");
                        }

                        out.print("</form>");
                    }
                }

                if (req.getParameter("action").equals("read_waiter")) {
                    String query = "SELECT * FROM cameriere";
                    PreparedStatement stmt = conn.prepareStatement(query);
                    ResultSet res = stmt.executeQuery();    
        
                    out.print("<h2>Camerieri presenti</h2>");
                    while (res.next()) {
                        String id = res.getString("id");
                        String nome = res.getString("nome");
                        String cognome = res.getString("cognome");
                        String username = res.getString("username");
                        String password = res.getString("password");

                        out.print("<form action='/servlet' method='POST'>");
                        out.print("<p>ID: "+id+", Nome: "+nome+", Cognome: "+cognome+", Username: "+username+", Password: "+password+"</p>");
                        out.print("<input type='hidden' name='id' value='" + id + "'>");
                        out.print("<button type='submit' name='action' value='delete'> Elimina </button>");
                        out.print("</form>");
                    }
                }
            }
            out.print("<a href='index.jsp'><button>Torna alla homepage</button></a>");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    protected void doPost(HttpServletRequest req, HttpServletResponse resp) {
        try {
            resp.setContentType("text/html");
            PrintWriter out = resp.getWriter();

            if (req.getParameter("action") != null) {

                if (req.getParameter("action").equals("create")) {
                    String query = "INSERT INTO cameriere (nome, cognome, username, password) VALUES (?,?,?,?)";
                    PreparedStatement stmt = conn.prepareStatement(query);
                    stmt.setString(1, req.getParameter("nome"));
                    stmt.setString(2, req.getParameter("cognome"));
                    stmt.setString(3, req.getParameter("username"));
                    stmt.setString(4, req.getParameter("password"));
                    stmt.executeUpdate();    
                    out.print("<p>Cameriere inserito correttamente</p>");
                }

                if (req.getParameter("action").equals("update_libera")) {
                    String query = "UPDATE tavolo SET id_cameriere=?, stato='libero' WHERE id=?";
                    PreparedStatement stmt = conn.prepareStatement(query);
                    stmt.setString(1, null);
                    stmt.setString(2, req.getParameter("id"));
                    stmt.executeUpdate();    
                    out.print("<p>Tavolo aggiornato correttamente</p>");
                }

                if (req.getParameter("action").equals("update_occupa")) {
                    String query = "UPDATE tavolo SET id_cameriere=?, stato='occupato' WHERE id=?";
                    PreparedStatement stmt = conn.prepareStatement(query);
                    stmt.setString(1, req.getParameter("id_cameriere"));
                    stmt.setString(2, req.getParameter("id"));
                    stmt.executeUpdate();    
                    out.print("<p>Tavolo aggiornato correttamente</p>");
                }

                if (req.getParameter("action").equals("delete")) {
                    String query = "DELETE FROM cameriere WHERE id=?";
                    PreparedStatement stmt = conn.prepareStatement(query);
                    stmt.setString(1, req.getParameter("id"));
                    stmt.executeUpdate();    
                    out.print("<p>Cameriere rimosso correttamente</p>");
                }
            }
            out.print("<a href='index.jsp'><button>Torna alla homepage</button></a>");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
    
}
