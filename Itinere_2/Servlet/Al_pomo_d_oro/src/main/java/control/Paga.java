package control;

import java.io.IOException;
import java.math.BigDecimal;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import jakarta.servlet.RequestDispatcher;
import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

import metodi.OrdineDao;
import metodi.PagamentoDao;
import metodi.Query;
import model.Pagamento;
import metodi.TavoloDao;

@WebServlet("/Pagamento")
public class Paga extends HttpServlet {
	private static final long serialVersionUID = 1L;

	protected void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
		response.getWriter().append("Served at: ").append(request.getContextPath());
	}

	@SuppressWarnings("unused")
	protected void doPost(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {

		RequestDispatcher rd = null;
		Query query = new Query();
		String id = request.getParameter("id");
		String ordine = request.getParameter("ordine");
		OrdineDao order = new OrdineDao();
		PagamentoDao payment = new PagamentoDao();
		List<Map<String, String>> resultList = new ArrayList<>();
		String totale = "", id_p ="", cognome ="";

		if (id != null) {
			Integer id_pagamento = Integer.parseInt(id);
			Pagamento toSubstitute = payment.cerca(id_pagamento);
			toSubstitute.setStato("pagato");
			toSubstitute.setCosto_totale(new BigDecimal("0.00"));
			payment.modifica(toSubstitute);
			TavoloDao daoT = new TavoloDao();

			request.getSession().setAttribute("list", daoT.lista());
			rd = request.getRequestDispatcher("cameriere.jsp");
			rd.forward(request, response);
		} else if (ordine.equals("ordine")) {
			
			String id_ord = request.getParameter("id_ordine");
			String n_t = request.getParameter("n_tavolo");
			

			if (id_ord != null) {
				
				int id_ordine = Integer.parseInt(id_ord);
				int n_tavolo = Integer.parseInt(n_t);
                order.elimina(id_ordine);
				ResultSet rs3=query.getResult("select sum(costo) from piatto inner join ordine on piatto.id = id_piatto where id_tavolo='"+n_tavolo+"'");
				BigDecimal di=null;
				try {
					if(rs3.next()) {
						
						di = rs3.getBigDecimal(1);

					}
				} catch (Exception e) {
					// TODO: handle exception
					System.out.println(e);
				}
				for(Pagamento toSubstitute:payment.lista()) {
					if(toSubstitute.getId_tavolo()==n_tavolo) {
						toSubstitute.setCosto_totale(di);
						payment.modifica(toSubstitute);

					}
				}
				ResultSet rs = query.getResult(
						"SELECT p.nome, p.descrizione, ordine.stato,  COUNT(*) as amount, p.costo*COUNT(*) as totale, ordine.id\n"
								+ "FROM tavolo\n" + "INNER JOIN ordine ON tavolo.id = ordine.id_tavolo\n"
								+ "INNER JOIN piatto p ON ordine.id_piatto = p.id\n" + "WHERE tavolo.id ='" + n_tavolo
								+ "'\n" + "GROUP BY p.nome, p.descrizione, p.costo, ordine.stato, ordine.id;");

				ResultSet rs_2 = query.getResult("SELECT costo_totale, id\n"
						+ "FROM pagamento\n"
						+ "WHERE id_tavolo ='"+n_tavolo+"'\n");

				try {

					if (rs_2.next()) 
					{
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
				BigDecimal costo_totale =  ((totale.equals("")) ? new BigDecimal("0.00") : new BigDecimal(totale));
		
				request.getSession().setAttribute("resultList", resultList);
				request.getSession().setAttribute("totale", costo_totale);
				rd = request.getRequestDispatcher("tavolo.jsp");
				rd.forward(request, response);
			}
		}

		doGet(request, response);
	}

}
