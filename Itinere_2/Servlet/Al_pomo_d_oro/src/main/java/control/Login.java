package control;

import java.util.concurrent.Executors;
import java.util.concurrent.ScheduledExecutorService;
import java.util.concurrent.TimeUnit;

import java.io.IOException;
import java.math.BigDecimal;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;
import java.util.HashMap;
import java.util.Map;
import java.util.Random;

import jakarta.servlet.RequestDispatcher;
import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

import metodi.CameriereDao;
import metodi.ClienteDao;
import metodi.LoginDao;
import metodi.OrdineDao;
import metodi.Query;
import metodi.TavoloDao;
import model.Cameriere;
import model.Ordine;

@WebServlet("/login")
public class Login extends HttpServlet {

	private static final long serialVersionUID = 1L;
	Random rand = new Random();
	OrdineDao order = new OrdineDao();
	Integer n_tavolo = null;
	
    Runnable task = () -> {
        int delay = (new Random().nextInt(91) + 10) * 1000;
        try {
            Thread.sleep(delay);
        } catch (InterruptedException e) {
            Thread.currentThread().interrupt();
        }
        
        for(Ordine o : order.lista())
        {
        	if(o.getId_tavolo() == n_tavolo && o.getStato().equals("in preparazione"))
        	{
        		o.setStato("consegnato");
        		order.modifica(o);
        		System.out.println("["+o.getId_piatto()+"] Lavoro completato dopo " + delay + " millisecondi");
        	}
        }
 
    };

	protected void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
		
		Query query = new Query();
		RequestDispatcher rd = null;
		ClienteDao cli = new ClienteDao();
		TavoloDao table = new TavoloDao();
		CameriereDao waiter = new CameriereDao();
		List<Map<String, String>> resultList = new ArrayList<>();
		
		String totale = "", id_pagamento ="", cognome ="";
		String id_tavolo = request.getParameter("id");
		String id_cameriere = request.getParameter("id_cameriere");
		Integer cam=null;
        ScheduledExecutorService executor = Executors.newScheduledThreadPool(1);
		
		if(id_tavolo!=null) {
			
			// Lista ordine
			ResultSet rs = query.getResult("SELECT p.nome, p.descrizione, ordine.stato,  COUNT(*) as amount, p.costo*COUNT(*) as totale, ordine.id\n"
					+ "FROM tavolo\n"
					+ "INNER JOIN ordine ON tavolo.id = ordine.id_tavolo\n"
					+ "INNER JOIN piatto p ON ordine.id_piatto = p.id\n"
					+ "WHERE tavolo.id ='"+id_tavolo+"'\n"
					+ "GROUP BY p.nome, p.descrizione, p.costo, ordine.stato, ordine.id;");
			
			// Costo totale e id pagamento
			ResultSet rs_2 = query.getResult("SELECT costo_totale, id\n"
					+ "FROM pagamento\n"
					+ "WHERE id_tavolo ='"+id_tavolo+"'\n");
			
			try {
				
				if (rs_2.next()) 
				{
					id_pagamento = rs_2.getString("id");
					totale = rs_2.getString("costo_totale");
				}
				
				while (rs.next()) {
					Map<String, String> map = new HashMap<>();
					map.put("nome", rs.getString(1));
					map.put("descrizione", rs.getString(2));
					map.put("stato", rs.getString(3));
					map.put("quantita", rs.getString(4));
					map.put("costo", String.valueOf(rs.getBigDecimal(5)));
					map.put("id_ordine", rs.getString(6));
					resultList.add(map);
				}
				
			} catch (SQLException e) {
				e.printStackTrace();
			}
					
			n_tavolo = Integer.parseInt(id_tavolo);
			cam = table.cerca(n_tavolo).getId_camerie();
			
			if(cam == 0) {
				cognome = "Prendi in carico";}
			else {
				cognome = waiter.cerca(cam).getCognome();
			}
			BigDecimal costo_totale =  ((totale.isEmpty()) ? new BigDecimal("0.00") : new BigDecimal(totale));
			request.getSession().setAttribute("cliente", cli.cerca_tavolo(n_tavolo));
			request.getSession().setAttribute("n_tavolo", n_tavolo);
			request.getSession().setAttribute("resultList", resultList);
			request.getSession().setAttribute("id_pagamento", id_pagamento);
			request.getSession().setAttribute("totale", costo_totale);
			request.getSession().setAttribute("cognome", cognome);
			request.getSession().setAttribute("idCameriere", id_cameriere);
			
			rd = request.getRequestDispatcher("tavolo.jsp");
			rd.forward(request, response);
		}
      
        executor.schedule(task, 0, TimeUnit.MILLISECONDS);
        executor.shutdown();
		response.getWriter().append("Served at: ").append(request.getContextPath());
	}

	protected void doPost(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
		
		RequestDispatcher rd = null;
		LoginDao dao = new LoginDao();
		String username = request.getParameter("user");
		String password = request.getParameter("password");

		if (dao.cameriere(username, password) != null) 
		{
			Cameriere cam = dao.cameriere(username, password);
			TavoloDao daoT = new TavoloDao();
			request.getSession().setAttribute("list", daoT.lista());
			request.getSession().setAttribute("nome", cam.getNome());
			request.getSession().setAttribute("cognome", cam.getCognome());
			request.getSession().setAttribute("id_cameriere", cam.getId_cameriere());
			rd = request.getRequestDispatcher("cameriere.jsp");
			
			rd.forward(request, response);
		}
		else
		{	

			RequestDispatcher rd3 = request.getRequestDispatcher("index.jsp");
			String messaggio = "username e password non sono presenti";
			request.setAttribute("messaggio", messaggio);
			rd3.forward(request, response);
		}

		doGet(request, response);
	}

}

