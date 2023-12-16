<!--
    Nella tabella 'fumetti' | il campo 'autore' riporta il nome e il cognome dell'autore del fumetto. 
    Dopo aver aggiunto i campi 'autore_nome' e 'autore_cognome', deve aggiornare questi campi per ogni 
    record estrapolando il nome e il cognome, che nel campo 'autore' sono scritti usando il carattere 
    separatore '-' (dash).
-->

<html>
    <body>
        <%@ page import="java.sql.*"%>
        <% 
            Connection conn = DriverManager.getConnection("jdbc:mysql://localhost:3306/journal?user=root&password=root");

            String query = "SELECT * FROM fumetti"; 
            PreparedStatement stmt = conn.prepareStatement(query);
            ResultSet res = stmt.executeQuery();

            out.print("<h2>Fumetti</h2>");
            while(res.next()) {
                String id = res.getString("id");
                String titolo = res.getString("titolo");
                String genere = res.getString("genere");
                String testata = res.getString("testata");
                String autore = res.getString("autore");
                String autore_nome = res.getString("autore_nome");
                String autore_cognome = res.getString("autore_cognome");
                String anni = res.getString("anni");

                out.print("<form action='/journal' method='POST'>");
                out.print("<p>ID: "+id+" | Titolo: "+titolo+" | Genere: "+genere+" | Testata: "+testata+
                " | Autore: "+autore+" | Autore_nome: "+autore_nome+" | Autore_cognome: "+autore_cognome+" | Anni: "+anni);
                out.print("<input type='hidden' name='id' value='"+id+"'>");
                out.print("<input type='hidden' name='autore' value='"+autore+"'>");
                if (autore_nome == null)
                    out.print("<input type='submit' name='action' value='Correggi'>");
                out.print("<input type='submit' name='action' value='Rimuovi'>");
                out.print("</p></form>");
            }
        %>
    </body>
</html>
