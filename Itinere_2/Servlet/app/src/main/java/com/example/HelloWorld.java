package com.example;

import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

import java.io.IOException;
import java.io.PrintWriter;

@WebServlet("/hello")
public class HelloWorld extends HttpServlet 
{
    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException 
    {
        response.setContentType("text/html");
        PrintWriter out = null;
        try 
        {
            out = response.getWriter();
        } catch (IOException e) 
        {
            e.printStackTrace();
        }
        out.write("<html>");
        out.write("<head><title></title></head>");
        out.write("<body>");
        out.write("<h1>Hello Servlet World</h1>");
        out.write("</body></html>");
    }
}
