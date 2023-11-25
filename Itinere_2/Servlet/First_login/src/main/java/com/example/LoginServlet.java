package com.example;

import jakarta.servlet.http.*;
import java.sql.*;

public class LoginServlet extends HttpServlet 
{
    public void doPost(HttpServletRequest request, HttpServletResponse response) 
    {
        try 
        {
            response.setContentType("text/html");

            // Ottieni i parametri dalla richiesta
            String email = request.getParameter("email");
            String password = request.getParameter("password");

            String hostname = "localhost";
            String username_db = "root";
            String password_db = "root";
            String name_db = "Database";

            // Creazione della connessione al database
            Connection conn = DriverManager.getConnection("jdbc:mysql://" + hostname + "/" + name_db, username_db, password_db);
    
            String query = "SELECT * FROM utenti WHERE email = ? AND password = ?";
            
            PreparedStatement stmt = conn.prepareStatement(query);
            stmt.setString(1, email);   // bind_param
            stmt.setString(2, password);

            ResultSet result = stmt.executeQuery();

            if (result.next()) 
            {
                String username = result.getString("username");
                int age = result.getInt("age");

                HttpSession session = request.getSession();
                session.setAttribute("username", username);
                session.setAttribute("age", age);

                stmt.close();
                conn.close();

                response.sendRedirect("welcome.jsp");
            } else 
            {
                HttpSession session = request.getSession();
                session.setAttribute("message", "Login account non riuscito. Verifica le tue credenziali");

                stmt.close();
                conn.close();

                response.sendRedirect("error.jsp");
            }

        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
