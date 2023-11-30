package com.example;

import java.io.*;
import java.sql.*;
import jakarta.servlet.http.*;

public class Library extends HttpServlet 
{
    private static final long serialVersionUID = 1L;
    private Connection conn;

    public void init() 
    {
        try 
        {
            Class.forName("com.mysql.cj.jdbc.Driver");
            conn = DriverManager.getConnection("jdbc:mysql://localhost/Biblioteca", "root", "root");

        } catch (Exception e) 
        {
            e.printStackTrace();
        }
    }

    public void destroy() 
    {
        try 
        {
            if (conn != null && !conn.isClosed()) 
                conn.close();

        } catch (Exception e) 
        {
            e.printStackTrace();
        }
    }

    protected void doPost(HttpServletRequest request, HttpServletResponse response)
    {
        try 
        {
            PrintWriter out = response.getWriter();
            
            if (request.getParameter("action").equals("create")) 
            {
                String title = request.getParameter("title");
                int amount = Integer.parseInt(request.getParameter("amount"));

                String query = "INSERT INTO store (title, amount) VALUES (?, ?)";
                PreparedStatement stmt = conn.prepareStatement(query);
                
                stmt.setString(1, title);
                stmt.setInt(2, amount);
                stmt.executeUpdate();

                if (stmt.getUpdateCount() > 0) 
                    out.println("Libro " + title + " inserito correttamente");
                else
                    out.println("Errore nell'inserimento del libro " + title);

                stmt.close();
            } 
            
            else if (request.getParameter("action").equals("read")) 
            {
                String title = request.getParameter("title");

                String query = "SELECT * FROM store WHERE title = ?";
                PreparedStatement stmt = conn.prepareStatement(query);
                    
                stmt.setString(1, title);
                    
                ResultSet result = stmt.executeQuery();
                if (result.next()) 
                {
                    out.println("Risultati della ricerca per il titolo " + title + ":\n");
                    do 
                        out.println("Titolo: " + result.getString("title") + ", Quantità: " + result.getInt("amount"));
                    while (result.next());

                } else 
                    out.println("Nessun libro trovato con il titolo " + title);

                stmt.close();
            } 
            
            else if (request.getParameter("action").equals("update")) 
            {
                String title = request.getParameter("title");
                int amount = Integer.parseInt(request.getParameter("amount"));

                String query = "UPDATE store SET amount = ? WHERE title = ?";
                PreparedStatement stmt = conn.prepareStatement(query);

                stmt.setInt(1, amount);
                stmt.setString(2, title);
                stmt.executeUpdate();

                if (stmt.getUpdateCount() > 0) 
                    out.println("Libro " + title + " aggiornato correttamente");
                else
                    out.println("Errore nell'aggiornamento del libro " + title);

                stmt.close();            
            } 
            
            else if (request.getParameter("action").equals("delete")) 
            {
                String title = request.getParameter("title");
            
                String query = "DELETE FROM store WHERE title = ?";
                PreparedStatement stmt = conn.prepareStatement(query);
            
                stmt.setString(1, title);
                int rowsAffected = stmt.executeUpdate();
    
                if (rowsAffected > 0) 
                    out.println("Libro " + title + " cancellato correttamente");
                else 
                    out.println("Errore durante la cancellazione del libro " + title);
                
                stmt.close();
            }

        } catch (Exception e) 
        {
            e.printStackTrace();
        }
    }

    protected void doGet(HttpServletRequest request, HttpServletResponse response)
    {
        try 
        {
            PrintWriter out = response.getWriter();
            if (request.getParameter("action").equals("show")) 
            {
                String query = "SELECT * FROM store";
                PreparedStatement stmt = conn.prepareStatement(query);
                ResultSet result = stmt.executeQuery();                
                out.println((result.next()) ? "Libri nella biblioteca:\n" : "Nessun libro trovato nella biblioteca.");
                do 
                    out.println("Titolo: " + result.getString("title") + ", Quantità: " + result.getInt("amount"));
                while (result.next());
            }

        } catch (Exception e) 
        {
            e.printStackTrace();
        }
    }
}
