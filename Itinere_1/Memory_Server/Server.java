import java.io.*;
import java.net.*;
import java.util.ArrayList;
import java.util.List;

/* Server Socket con Storico

    Implementa un server, usando il linguaggio di programmazione di tua scelta (come Python, C o Java), che risponde sulla porta 8888. 
    Il server deve mantenere un registro delle richieste effettuate dai client. Il registro può essere implementato come una lista o un array.

    Il server deve gestire le seguenti richieste:

    - GET: Quando il server riceve la stringa "GET", deve rispondere inviando al client tutto l'elenco delle richieste memorizzate nel registro, separato 
           da virgole.

    - ADD <testo>: Quando il server riceve una richiesta in formato "ADD <testo>", deve aggiungere il testo al registro delle richieste e rispondere 
                   con "Richiesta aggiunta con successo."

    - COUNT: Quando il server riceve la stringa "COUNT", deve rispondere con il numero totale di richieste memorizzate nel registro.
    
    - CLEAR: Quando il server riceve la stringa "CLEAR", deve cancellare tutte le richieste dal registro e rispondere con "Registro svuotato con successo."
    
    Dopo aver elaborato la richiesta, il server deve chiudere la connessione con il client e tornare in attesa di ulteriori richieste.

    Implementa anche un client per testare il server. Il client dovrebbe consentire all'utente di inviare comandi al server e visualizzare le risposte.

    Assicurati che il server sia in grado di gestire più client contemporaneamente usando thread o processi, se necessario.

    Facoltativo per la prova in itinere, obbligatorio per l'esame completo: implementa una funzione di registrazione delle richieste su disco in modo 
    che il registro sia persistente tra riavvii del server. 
*/

public class Server
{
    static final int port = 8888;

    static List<String> register = new ArrayList<>();

    static String GET() 
    {
        String sendline = String.join(", ", register);
        return sendline;
    }

    static String ADD(String recvline)
    {
        register.add(recvline);
        return "Richiesta aggiunta con successo";
    }

    static String COUNT()
    {
        return "Il registro contiene " + register.size() + " richieste";
    }

    static String CLEAR()
    {
        register.clear();        
        return "Registro svuotato con successo";
    }
    
    public static void main(String[] args) 
    {
        System.out.println("[+]Server listening on port " + port + "\n");
        try ( ServerSocket server = new ServerSocket(port);
              Socket socket = server.accept();
              PrintWriter out = new PrintWriter(socket.getOutputStream(), true);
              BufferedReader in = new BufferedReader(new InputStreamReader(socket.getInputStream()));
            ) 
        {
            String sendline="", recvline="";
            while((recvline = in.readLine()) != null)
            {
                System.out.println("Client: " + recvline);
                if (recvline.equalsIgnoreCase("GET"))
                {
                    sendline = GET();
                    System.out.println(sendline + "\n");
                    out.println(sendline);
                }
                else if (recvline.startsWith("ADD") || recvline.startsWith("add"))
                {
                    recvline = recvline.substring(4);
                    sendline = ADD(recvline);
                    System.out.println(sendline + "\n");
                    out.println(sendline);
                }
                else if (recvline.equalsIgnoreCase("COUNT"))
                {
                    sendline = COUNT();                    
                    System.out.println(sendline + "\n");
                    out.println(sendline);
                }
                else if (recvline.equalsIgnoreCase("CLEAR"))
                {
                    sendline = CLEAR();
                    System.out.println(sendline + "\n");
                    out.println(sendline);
                }
                else
                {
                    sendline = "Bad Request";
                    System.out.println(sendline + "\n");
                    out.println(sendline);
                }
            }
            
        } catch (Exception e) 
        {
            e.printStackTrace();
        }
        System.out.println("[+]Connection on port " + port + "closed");
    }
}