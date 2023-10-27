import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.net.ServerSocket;
import java.net.Socket;
import java.util.Random;

/*
 * 1­Socket 
 
Implementare un server, in C o Java, che risponde sul port 7777. 
 
Il server mantiene un vettore V con le ultime dieci richieste (stringhe di 10 
caratteri) ricevute. 
 
Le richieste a cui il server deve rispondere sono: 
1. la stringa "LIST", a cui il server risponde inviando al client tutte le 
risposte finora memorizzate in V, separate da '\n'; 
2. qualsiasi altra stringa viene trattata come messaggio da inserire nel 
vettore V: 
2.1 se la stringa è già presente in V, il server risponde con "presente"; 
2.2 se la stringa non è ancora presente in V, il server la aggiunge a V, 
eventualmente sovrascrivendone una a caso tra quelle già esistenti, 
e risponde "inserita" al client. 
 
Dopo avere risposto, il server chiude la connessione con il client e torna in 
attesa di richieste. 
 
Facoltativo per la prova in itinere, obbligatorio per l’esame completo : 
Implementare un client per testare il server. 
 */

public class Server
{
    static final int port = 7777;

    static String[] createVector(int n)
    {
        String[] V = new String[n];
        for(int i=0; i<n; i++)
            V[i] = new String("");
        return V;
    }

    static void printVector(String[] V)
    {
        System.out.println("Vector\n");
        for(int i=0; i<V.length; i++)
            System.out.println(i+1 + ") " + V[i]);
        System.out.println("-------------------------------------------------");
    }

    public static void main(String[] args) 
    {
        String[] V = createVector(10);

        System.out.println("Server listening on port " + port + "\n");
        try ( ServerSocket server = new ServerSocket(port);
              Socket socket = server.accept();
              PrintWriter out = new PrintWriter(socket.getOutputStream(), true);
              BufferedReader in = new BufferedReader(new InputStreamReader(socket.getInputStream())))
        {   
            System.out.println("[+] Client " + socket.getInetAddress() + " connected\n");
            
            String recvline = "", sendline = "";
            while((recvline = in.readLine()) != null)
            {
                System.out.println("Client: " + recvline);
                if (recvline.equalsIgnoreCase("LIST"))
                {
                    for (String str : V)
                        sendline.concat(str + "\n");

                    out.print(sendline);
                    sendline = "";
                    printVector(V);
                }
                else
                {
                    for (int i=0; i<V.length; i++)
                    {
                        if (V[i].equals(recvline))
                        {
                            sendline = "Presente";
                            out.print(sendline);
                            sendline = "";
                            printVector(V);
                            break;
                        }
    
                        if (V[i].equals("")) 
                        {
                            V[i] = recvline;
                            System.out.println("V[i] = " + V[i]);  
                            sendline = "Inserita";
                            out.print(sendline);
                            sendline = "";
                            i = 0;
                            printVector(V);
                            break;
                        }
                        
                        else 
                        {
                            V[new Random().nextInt(V.length)] = recvline;
                            sendline = "Inserita";
                            out.print(sendline);
                            sendline = "";
                            i = 0;
                            printVector(V);
                            break;
                        }
                    }
                }
            }
            System.out.println("[+]Connection closed\n");
        } 
        catch (Exception e) 
        {
            e.printStackTrace();
        }
    }
}