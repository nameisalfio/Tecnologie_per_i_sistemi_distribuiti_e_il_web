<%@page import="model.Piatto"%>
<%@page import="java.util.List"%>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
	pageEncoding="ISO-8859-1"%>
<!DOCTYPE html>
<html>

<head>
<meta charset="ISO-8859-1">

<title>Ordine</title>
<link rel="shortcut icon" href="sources/ristorante.ico" type="image/x-icon">
<link href="css/style.css" rel="stylesheet">
<link href="css/menu.css" rel="stylesheet">
<link href="css/ordine.css" rel="stylesheet">
<link href="css/piatti.css" rel="stylesheet">
</head>

<body>
	<%
	List<Piatto> lista_piatti = (List<Piatto>) session.getAttribute("lista_piatti");
	String id_tavolo = (String) request.getAttribute("id_tavolo");
	String tipo = (String) request.getAttribute("tipo");
	%>
	<div class="freccia">
		<a href="javascript: window.history.go(-2)"> <img
			src="sources/frecciasinistra.png" alt="Icona" width="30" height="30"
			class="logo">
		</a>
	</div>
	
	<div id="notifica" class="message_succ" style="display: none;"></div>
	<div id="notifica_err" class="message_err" style="display: none;"></div>
	<div class="menu">
		<h2 class="menu-group-heading">Menù bevande</h2>

		<div class="menu-group">
			<%
			for (Piatto p : lista_piatti) {
				if (p.getTipo().equals("bevanda")) {
			%>
			<!-- Item -->
			<div class="menu-item">
				<img src="sources/<%=p.getImmagine()%>.png" alt="Black Placeholder Image"
					class="menu-item-img" />
				<div class="menu-item-text">
					<h3 class="menu-item-heading">
						<span class="menu-item-name"><%=p.getNome_piatto()%></span> 
						<span class="menu-item-price">&euro;<%=p.getCosto()%></span>
					</h3>
					<p class="menu-item-desc"><%=p.getDescrizione()%></p>
				</div>
				<input type="button" value="Aggiungi" class="button"
					onclick="aggiungiPiatto('<%=p.getId_piatto()%>', '<%=p.getNome_piatto()%>','<%=id_tavolo%>', <%=p.getCosto()%>)" />

			</div>
			<%
			}
			}
			%>
		</div>
	</div>
	
	
	<h2 class="titolo-tabella">Ordini Aggiunti</h2>
	<div class="table-container">
	<table id="ordiniAggiunti" >
		<!-- Qui verranno visualizzati i dati aggiunti tramite JavaScript -->
	</table>
	</div>
	<div class="table-container">
	<button id="inviaOrdiniButton" class="button" onclick="inviaOrdini()">
		Invia Ordini
	</button>
</div>
	<script src="js/aggiungiordine.js">

	</script>
</body>

</html>