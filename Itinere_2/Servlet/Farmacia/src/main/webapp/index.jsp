<%@ page import="java.sql.*" %>
<%@ page import="java.util.*" %>

<%
    Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/Farmacia?user=root&password=root");
    String query = "SELECT Principio_Attivo, Nome_Medicinale FROM Medicinali";
    PreparedStatement stmt = conn.prepareStatement(query);
    ResultSet res = stmt.executeQuery();
    
    List<String> Principi_Attivi = new ArrayList<>();
    List<String> Nomi_Medicinali = new ArrayList<>();
    
    while(res.next()) {
        Principi_Attivi.add(res.getString("Principio_Attivo"));
        Nomi_Medicinali.add(res.getString("Nome_Medicinale"));
    }
%>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
    </head>
    <body>
        <h1>Farmacia</h1>
        <h3>Inserimento di un record</h3>
        <form action="/farmacia" method="POST">
            Nome medicinale:<input type="text" name="Nome_Medicinale"><br>
            Principio attivo:
            <select name="Principio_Attivo">
                <% for (String principioAttivo : Principi_Attivi) { %>
                    <option value="<%= principioAttivo %>"><%= principioAttivo %></option>
                <% } %>
            </select><br>
            Forma farmaceutica:<input type="text" name="Forma_Farmaceutica"><br>
            Dosaggio:<input type="text" name="Dosaggio"><br>
            Scadenza:<input type="date" name="Scadenza"><br><br>
            <input type="submit" name="action" value="Inserisci">
        </form>

        <h3>Ricerca di un record</h3>
        <form action="/farmacia" method="GET">
            Principio attivo:
            <select name="Principio_Attivo">
                <% for (String principioAttivo : Principi_Attivi) { %>
                    <option value="<%= principioAttivo %>"><%= principioAttivo %></option>
                <% } %>
                <option value='Vedi tutti'>Vedi tutti</option>
            </select>
            <input type="submit" name="action" value="Ricerca">
        </form>

        <h3>Aggiornamento di un record</h3>
        <form action="/farmacia" method="POST">
            Nome medicinale:
            <select name="Nome_Medicinale">
                <% for (String nomeMedicinale : Nomi_Medicinali) { %>
                    <option value="<%= nomeMedicinale %>"><%= nomeMedicinale %></option>
                <% } %>
            </select>
            Scadenza:<input type="date" name="Scadenza">
            <input type="submit" name="action" value="Aggiorna">
        </form>

        <h3>Rimozione di un record</h3>
        <form action="/farmacia" method="POST">
            Nome medicinale:
            <select name="Nome_Medicinale">
                <% for (String nomeMedicinale : Nomi_Medicinali) { %>
                    <option value="<%= nomeMedicinale %>"><%= nomeMedicinale %></option>
                <% } %>
            </select>
            <input type="submit" name="action" value="Rimuovi">
        </form>

    </body>
</html>
