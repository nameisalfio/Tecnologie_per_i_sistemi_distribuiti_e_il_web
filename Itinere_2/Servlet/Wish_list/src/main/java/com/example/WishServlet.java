package com.example;

import java.io.*;
import java.sql.*;
import jakarta.servlet.http.*;
import jakarta.servlet.annotation.WebServlet;

@WebServlet("/wish")
public class WishServlet extends HttpServlet {

    private Connection conn;
    
    public void init() {
        try {
            conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/Cinema?user=root&password=root"); 
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) {
        try {
            response.setContentType("text/html");
            PrintWriter out = response.getWriter();
            
            out.print("<link rel='stylesheet' type='text/css' href='./css/style.css'>");

                String query = "SELECT * FROM wlist";
                PreparedStatement stmt = conn.prepareStatement(query);
                ResultSet res = stmt.executeQuery();
                
                out.print("<p>La tua wishlist:</p><br>");
                while (res.next()) {
                    out.print("<p>Film: "+res.getString("titolo")+", regista: "+res.getString("regista")+"</p>");
                }

            out.print("<br><a href='index.jsp'><button>Torna alla home page</button></a>");

        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void doPost(HttpServletRequest request, HttpServletResponse response) {
        try {
            response.setContentType("text/html");
            PrintWriter out = response.getWriter();
            
            out.print("<link rel='stylesheet' type='text/css' href='./css/style.css'>");

            String query = "DELETE FROM wlist ";
            PreparedStatement stmt = conn.prepareStatement(query);
            stmt.executeUpdate();

            out.print("<p>Wish list svuotata</p>");
            out.print("<br><a href='index.jsp'><button>Torna alla home page</button></a>");

        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}

