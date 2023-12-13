<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
    pageEncoding="ISO-8859-1"%>
<%@page import="java.util.List"%>
<%@page import="model.Tavolo"%>
<!DOCTYPE html>
<html>

<head>
<meta charset="ISO-8859-1">
<title>Prenotazione</title>
<link rel="shortcut icon" href="sources/ristorante.ico" type="image/x-icon">
<link href="css/style.css" rel="stylesheet">
<link href="css/prenotazione.css" rel="stylesheet">
</head>

<body>
<div class="freccia">
	<a href="javascript: window.history.go(-1)"> 
		<img src="sources/frecciasinistra.png" alt="Icona" width="30" height="30" class="logo">
	</a>
</div>
	<%
	List<Tavolo> tavoli_liberi = (List<Tavolo>) request.getAttribute("tavoli_liberi");
	String esito = (String) request.getAttribute("esito");
	%>
	
	<%
	if(!tavoli_liberi.isEmpty())
	{
	%>
	<div class="form">
		<form action="Prenota" method="post" class="Prenota">
			<h1>Prenotazione</h1>
			<h3>Nome</h3>
			<input type="text" name="nome" id="nome" class="nome">
			<h3>Cognome</h3>
			<input type="text" name="cognome" id="cognome" class="nome">
			<h3 for="table">Scegli un tavolo per </h3>
			<select id="table" name="id_tavolo">
			<%
			for (Tavolo t : tavoli_liberi){
			%>
			<option value="<%=t.getId_tavolo()%>"><%=t.getNum_posti()%> persone</option>
			<%
			}
			%>
			</select>
			<button type="submit" value="prenota" id="submit" class="button">Prenota</button>
		</form>
	</div>
	<%
	if(esito != null)
	{
	%>
	<p class="message_succ"> <%=esito%> </p>
	<%
	}
	%>
	<%
	}else{
	%>
	<p class="message_err">Siamo spiacenti, al momento non ci sono tavoli liberi</p>
	<%
	}
	%>
</body>

</html>