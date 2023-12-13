<%@page import="model.Tavolo"%>
<%@page import="java.util.List"%>
<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
	pageEncoding="ISO-8859-1"%>
<!DOCTYPE html>
<html>

<head>
<meta charset="ISO-8859-1">
<title>Area Cameriere</title>
<link rel="shortcut icon" href="sources/ristorante.ico" type="image/x-icon">
<link href="css/tavolo.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/menu.css" rel="stylesheet">
</head>

<body>
	<%
	String nome = (String) session.getAttribute("nome");
	int id_cameriere = (int) session.getAttribute("id_cameriere");
	String cognome = (String) session.getAttribute("cognome");
	List<Tavolo> list = (List<Tavolo>) session.getAttribute("list");
	%>
	<header>
		<span onclick="openMenu()" class="menu">&#9776;</span>
		<div id="myNav" class="overlay">
			<a href="javascript:void(0)" class="Xbtn" onclick="closeMenu()">&times;</a>
			<div class="ContenutoMenu">
	   		        <a href="logout.jsp">Logout</a>
			</div>
			<div id="blocco" class="blocco"></div>
		</div>
	</header>
		
	<h1>
		Benvenuto
		<%=nome + " " + cognome%></h1>

	<%
	for (Tavolo ta : list) {
	%>
	<div class="tavolo">
		<a href="login?id=<%=ta.getId_tavolo()%>&id_cameriere=<%=id_cameriere%>"> Tavolo <%=ta.getId_tavolo()%>
        	<span class="stato">
        		<%=ta.getStato()%>
        	</span>
        </a>
	
	</div>
	<%
	}
	%>

	<script src="js/menu.js"></script>
</body>

</html>