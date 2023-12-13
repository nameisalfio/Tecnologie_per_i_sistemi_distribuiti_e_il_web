package control;

import java.io.BufferedReader;
import java.io.IOException;
import java.lang.reflect.Type;
import java.math.BigDecimal;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

import com.google.gson.Gson;
import com.google.gson.reflect.TypeToken;

import metodi.OrdineDao;
import metodi.PagamentoDao;
import metodi.Query;
import model.Pagamento;

@WebServlet("/elimina")
public class Elimina extends HttpServlet {
	private static final long serialVersionUID = 1L;

	protected void doGet(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
		// TODO Auto-generated method stub
		response.getWriter().append("Served at: ").append(request.getContextPath());
	}

	protected void doPost(HttpServletRequest request, HttpServletResponse response)
			throws ServletException, IOException {
		// Leggi i dati JSON dalla richiesta
		OrdineDao order = new OrdineDao();
		Query query = new Query();
		PagamentoDao payment = new PagamentoDao();
		String totale = "";
		List<Map<String, String>> resultList = new ArrayList<>();
		BufferedReader reader = request.getReader();
		StringBuilder requestBody = new StringBuilder();
		String line;
		
		
		while ((line = reader.readLine()) != null) {
			requestBody.append(line);
		}

		// Converti i dati JSON in un array Java
		Gson gson = new Gson();
		Type tipoLista = new TypeToken<List<Map<String, String>>>() {
		}.getType();
		
		int id_ordine = 0;
		int n_tavolo = 0;
		List<Map<String, String>> elimina = gson.fromJson(requestBody.toString(), tipoLista);
		for (Map<String, String> elim : elimina) {
			id_ordine = Integer.parseInt(elim.get("id_ordine"));
			n_tavolo = Integer.parseInt(elim.get("id_tavolo"));
		}

		order.elimina(id_ordine);
		
		ResultSet rs3 = query
				.getResult("select sum(costo) from piatto inner join ordine on piatto.id = id_piatto where id_tavolo='"
						+ n_tavolo + "'");
		BigDecimal di = null;
		try {
			if (rs3.next()) {

				di = rs3.getBigDecimal(1);

			}
		} catch (Exception e) {
			// TODO: handle exception
			System.out.println(e);
		}
		for (Pagamento toSubstitute : payment.lista()) {
			if (toSubstitute.getId_tavolo() == n_tavolo) {
				toSubstitute.setCosto_totale(di);
				payment.modifica(toSubstitute);

			}
		}
		ResultSet rs = query.getResult(
				"SELECT p.nome, p.descrizione, ordine.stato,  COUNT(*) as amount, p.costo*COUNT(*) as totale, ordine.id\n"
						+ "FROM tavolo\n" + "INNER JOIN ordine ON tavolo.id = ordine.id_tavolo\n"
						+ "INNER JOIN piatto p ON ordine.id_piatto = p.id\n" + "WHERE tavolo.id ='" + n_tavolo + "'\n"
						+ "GROUP BY p.nome, p.descrizione, p.costo, ordine.stato, ordine.id;");

		ResultSet rs_2 = query
				.getResult("SELECT costo_totale, id\n" + "FROM pagamento\n" + "WHERE id_tavolo ='" + n_tavolo + "'\n");

		try {

			if (rs_2.next()) {
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
		BigDecimal costo_totale = ((totale.equals("")) ? new BigDecimal("0.00") : new BigDecimal(totale));
		
		request.getSession().setAttribute("resultList", resultList);
		request.getSession().setAttribute("totale", costo_totale);
		response.setStatus(HttpServletResponse.SC_OK);
		

		
	}

}
