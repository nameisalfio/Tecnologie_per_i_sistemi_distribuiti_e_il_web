import java.io.*;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import jakarta.servlet.*;

public class MyServlet implements Servlet 
{
    ServletConfig config = null;

    public void init(ServletConfig config) 
    {
        this.config = config;
        System.out.println("Servlet is initialized");
    }

    @Override
    public void service(ServletRequest req, ServletResponse res) throws ServletException, IOException 
    {
        res.setContentType("text/html");
        PrintWriter out = res.getWriter();

        String email = req.getParameter("mail");
        String password = req.getParameter("password");

        String jdbcUrl = "jdbc:mysql://localhost:3306/Database";
        String dbUser = "root";
        String dbPassword = "root";

        try 
        {
            Class.forName("com.mysql.cj.jdbc.Driver");
            Connection conn = DriverManager.getConnection(jdbcUrl, dbUser, dbPassword);

            String query = "SELECT * FROM utenti WHERE email = ? AND password = ?";
            try (PreparedStatement pstmt = conn.prepareStatement(query)) 
            {
                pstmt.setString(1, email);
                pstmt.setString(2, password);

                ResultSet resultSet = pstmt.executeQuery();

                if (resultSet.next()) 
                {
                    out.println("Login riuscito!");
                } else 
                {
                    out.println("Login fallito. Controlla le credenziali.");
                }
            }
        } catch (ClassNotFoundException | SQLException e) 
        {
            e.printStackTrace();
        }
    }

    public void destroy() 
    {
        System.out.println("Servlet is destroyed");
    }

    public ServletConfig getServletConfig() 
    {
        return config;
    }

    public String getServletInfo() 
    {
        return "Servlet Info";
    }
}
