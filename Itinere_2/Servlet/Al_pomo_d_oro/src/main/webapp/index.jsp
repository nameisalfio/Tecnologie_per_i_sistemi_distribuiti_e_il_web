<%@ page language="java" contentType="text/html; charset=ISO-8859-1"
	pageEncoding="ISO-8859-1"%>

<!DOCTYPE html>
<html>

<head>
<meta charset="ISO-8859-1">
<link rel="shortcut icon" href="sources/ristorante.ico" type="image/x-icon">
<link href="css/index.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/prenotazione.css" rel="stylesheet">
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<title>Benvenuto al pomo d'oro!</title>

<link href="https://fonts.googleapis.com/css?family=Open+Sans"
	rel="stylesheet">
<link
	href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
	rel="stylesheet"
	integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
	crossorigin="anonymous">
</head>
<%
String messaggio = (String) request.getAttribute("messaggio");
String esito = (String) session.getAttribute("esito");
%>
<body>
	<%
	if(esito != null)
	{
	
	%>
	<p class="message_succ"> <%=esito%> </p>

	<%
	Thread.sleep(1000);
        session.invalidate(); 
	}
	%>
	<div class="box-form">
		<div class="left">
			<div class="overlay">
				<h1>Al pomo d'oro</h1>
				<p>Benvenuti nel cuore della nostra cucina, dove ogni piatto e'
					creato con passione e dedizione. Al Pomo d'oro, crediamo che il
					cibo non sia solo una necessita', ma un'esperienza da gustare con
					tutti i sensi.
				</p>
				<br/>
				<a href="Prenota" class="button">Prenota ora</a> 
			</div>
		</div>
		<form action="login" method="POST">
			<div class="right">
				<h5 class="flex-text">Login</h5>
				<div class="inputs">
					<input type="text" placeholder="user name" name="user"> <br>
					<input type="password" placeholder="password" name="password">
				</div>
				<br>
				<br> <br>
				<button type="submit">Login</button>
				<span class="errore" id="errore">
					
					<% 
					if(messaggio!=null){%>   
						<p ><%out.print("Username o Password non sono corretti");%></p>
					<%} %>
				</span>
			</div>
		</form>
	</div>

	<footer class="footer mt-3" id="Contatti">
		<div class="grid2">
			<div class="col reveal">
				<h4 class="flex-text2 tw">Contatti</h4>
				<p class="normal-text tw">
					<img src="sources/cornetta_telefonica.png" alt="icona"
						style="vertical-align: middle;"> <a href="tel:+393487678837"
						style="font-size: 15px">+39 </a>
				</p>
				<p class="normal-text tw">
					<img src="sources/mail.png" alt="icona"
						style="vertical-align: middle;"> <a
						href="mailto:nome.cognome@mail.it" style="font-size: 14px">nome.cognome@mail.it</a>
				</p>
			</div>

			<div class="col reveal">
				<h4 class="flex-text2 tw">Social</h4>
				<p class="normal-text tw">
					<img src="sources/insta.png" alt="icona"
						style="vertical-align: middle;"> <a href=""
						style="font-size: 14px">@nome_instagram</a>
				</p>
				<p class="normal-text tw">
					<img src="sources/facebook.png" alt="icona"
						style="vertical-align: middle; margin-right: 20px;"> <a
						href="" style="font-size: 14px">nome_facebook</a>
				</p>
			</div>

			<div class="col reveal">
				<h4 class="flex-text2 tw">Orari servizio</h4>
				<p class="pw" style="color: white;">Aperti tutti i giorni dal
					Martedi alla Domenica</p>
				<p class="pw" style="color: white;">Pranzo: 12:00-15:00</p>
				<p class="pw" style="color: white;">Cena: 20:00-00:00</p>
			</div>

			<div class="col reveal">
				<h4 class="flex-text2 tw">Partita IVA</h4>
				<p class="pw" style="color: white;">IVA</p>
			</div>

		</div>
	</footer>


</body>
<script src="./js/obbligo_accesso.js"></script>

</html>