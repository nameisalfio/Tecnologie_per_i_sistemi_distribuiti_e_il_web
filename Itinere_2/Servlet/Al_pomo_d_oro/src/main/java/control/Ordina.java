package control;

import java.io.BufferedReader;
import java.io.IOException;
import java.util.List;
import java.util.Map;

import jakarta.servlet.RequestDispatcher;
import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

import java.lang.reflect.Type;

import metodi.OrdineDao;
import metodi.PiattoDao;
import model.Ordine;


@WebServlet("/Ordina")
public class Ordina extends HttpServlet {
	private static final long serialVersionUID = 1L;

	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		String id =request.getParameter("id_tavolo");
		String tipo =request.getParameter("tipo");
		PiattoDao pd = new PiattoDao();
		RequestDispatcher rd = null;
		if(id!=null) {
			request.setAttribute("id_tavolo", id);	
		}
		request.getSession().setAttribute("lista_piatti", pd.lista());
		if(tipo!=null) {
		if(tipo.equals("cibo")) {
			rd = request.getRequestDispatcher("cibo.jsp");
			rd.forward(request, response);
		}else {
			rd = request.getRequestDispatcher("bevanda.jsp");
			rd.forward(request, response);
		}
		}
		response.getWriter().append("Served at: ").append(request.getContextPath());
	}

	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		doGet(request, response);
		
		OrdineDao order = new OrdineDao();
		
		 // Leggi i dati JSON dalla richiesta
        BufferedReader reader = request.getReader();
        StringBuilder requestBody = new StringBuilder();
        String line;
        while ((line = reader.readLine()) != null) {
            requestBody.append(line);     
        }

        // Converti i dati JSON in un array Java
        Gson gson = new Gson();
        Type tipoLista = new TypeToken<List<Map<String, String>>>() {}.getType();
        List<Map<String, String>> ordini = gson.fromJson(requestBody.toString(), tipoLista);
        if(ordini!=null) {
	        for (Map<String, String> ordine : ordini) {
	        	int id_tavolo = Integer.parseInt(ordine.get("id_tavolo"));
	        	int id_piatto = Integer.parseInt(ordine.get("id_piatto"));
	        	Ordine o = new Ordine(0, id_tavolo, id_piatto);
	        	order.inserire(o);
	        }
        }
        response.setStatus(HttpServletResponse.SC_OK);
    }

}
