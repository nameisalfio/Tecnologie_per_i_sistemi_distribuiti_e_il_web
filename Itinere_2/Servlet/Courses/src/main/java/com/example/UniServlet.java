package com.example;

import java.io.*;
import java.sql.*;
import jakarta.servlet.http.*;
import jakarta.servlet.annotation.*;

@WebServlet("/servlet")
public class UniServlet extends HttpServlet{
    
    Connection conn;

    public void init() {
        try {
            conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/University?user=root&password=root");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) {
        try {
            response.setContentType("text/html");
            PrintWriter out = response.getWriter();

            String query = "SELECT * FROM courses";
            PreparedStatement stmt = conn.prepareStatement(query);
            ResultSet result = stmt.executeQuery();

            if (result.next()) {
                out.println("<h3>Corsi presenti:</h3>");
                do {
                    String codice = result.getString("codice_corso");
                    String nome = result.getString("nome_corso");
                    String descrizione = result.getString("descrizione");
                    String crediti = result.getString("crediti");

                    out.print("<p>Codice: <a href='redirect.jsp?nome="+nome+"'>"+codice+"</a>, Nome: "+nome+", CFU: "+crediti+", Descrizione: "+descrizione+"</p>");
                } while (result.next());
            } else {
                out.println("<h3>Non ci sono corsi presenti</h3>");
            }
                
            out.print("<a href='/index.jsp'><button>Torna alla home page</button></a>");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void doPost(HttpServletRequest request, HttpServletResponse response) {
        try {
            response.setContentType("text/html");
            PrintWriter out = response.getWriter();

            if (request.getParameter("action") != null) {

                if (request.getParameter("action").equals("create")) {

                    String query = "INSERT INTO courses (nome_corso, descrizione, crediti) VALUES (?,?,?)";
                    PreparedStatement stmt = conn.prepareStatement(query);

                    String nome = request.getParameter("nome");
                    String descrizione = request.getParameter("descrizione");
                    String crediti = request.getParameter("crediti");

                    stmt.setString(1, nome);
                    stmt.setString(2, descrizione);
                    stmt.setString(3, crediti);

                    stmt.executeUpdate();

                    out.println("<h3>Corso di "+nome+" inserito con successo</h3><br>");
                }

                else if (request.getParameter("action").equals("update")) {

                    String query = "UPDATE courses SET descrizione=?, crediti=? WHERE nome_corso=?";
                    PreparedStatement stmt = conn.prepareStatement(query);

                    String nome = request.getParameter("nome");
                    String descrizione = request.getParameter("descrizione");
                    String crediti = request.getParameter("crediti");

                    stmt.setString(1, descrizione);
                    stmt.setString(2, crediti);
                    stmt.setString(3, nome);

                    stmt.executeUpdate();

                    out.println("<h3>Corso di "+nome+" aggiornato con successo</h3><br>");
                }

                else if (request.getParameter("action").equals("delete")) {
                    
                    String query = "DELETE FROM courses WHERE nome_corso=(?)";
                    PreparedStatement stmt = conn.prepareStatement(query);

                    String nome = request.getParameter("nome");

                    stmt.setString(1, nome);

                    stmt.executeUpdate();

                    out.println("<h3>Corso di "+nome+" rimosso con successo</h3><br>");
                }
            }

            out.print("<a href='/index.jsp'><button>Torna alla home page</button></a>");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
