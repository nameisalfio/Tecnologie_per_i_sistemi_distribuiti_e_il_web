package com.example;

import java.io.*;
import java.sql.*;
import jakarta.servlet.http.*;
import jakarta.servlet.annotation.WebServlet;

@WebServlet("/hello")
public class HelloWorld extends HttpServlet {
    Connection conn; 
    final String connectionString = "jdbc:mysql://localhost:3306/students?user=root&password=root";

    public void init() {
        System.out.println("Servlet " + this.getServletName() + " has started");
        try {
             conn = DriverManager.getConnection(connectionString);
        } catch (Exception e) {
            e.printStackTrace();
        }
        System.out.println("Connection Successfull");
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) {
        try {
            response.setContentType("text/html");
            PrintWriter out = response.getWriter();

            out.write("<html>");
            out.write("<head><title></title></head>");
            out.write("<body>");
            out.write("<h1>Hello Servlet World</h1>");
            out.write("</body></html>");

            Statement stmt = conn.createStatement();
            String query = "SELECT * from student";
            ResultSet res = stmt.executeQuery(query);
            while (res.next()) {
                out.write("<p>Name: " + res.getString("name") + ", Age: " + res.getString("age") + "</p>");
            }

        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    public void doPost(HttpServletRequest request, HttpServletResponse response) {
        try {
            response.setContentType("text/html");
            PrintWriter out = response.getWriter();

            String name = request.getParameter("name");
            Integer age = Integer.parseInt(request.getParameter("age"));

            String query = "INSERT INTO student (name, age) VALUES (?, ?)";
            PreparedStatement stmt = conn.prepareStatement(query);
            stmt.setString(1, name);
            stmt.setInt(2, age);

            stmt.executeUpdate();
            out.println("Studente " + name + " inserito correttamente");

        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}
