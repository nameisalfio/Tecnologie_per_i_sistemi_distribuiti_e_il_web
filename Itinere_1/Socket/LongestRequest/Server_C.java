import java.io.*;
import java.net.*;
import java.util.*;

public class Server_C
{
    static final int port = 3333; 

    static List<String> requests = new ArrayList<>();

    static String getLongestRequest()
    {
        return requests.stream()
                        .max(Comparator.comparing(x -> x.length()))
                        .orElse("");
    }

    public static void main(String[] args) 
    {
        System.out.println("[+]Server listening on port " + port + "\n");
        try 
        {
            ServerSocket server = new ServerSocket(port);
            Socket socket = null;
            while((socket = server.accept()) != null)
            {
                System.out.println("=> Client connected\n");
                PrintWriter out = new PrintWriter(socket.getOutputStream(), true);
                BufferedReader in = new BufferedReader(new InputStreamReader(socket.getInputStream()));

                String recvline = in.readLine(), sendline = "";

                System.out.println("Client: " + recvline);
                requests.add(recvline);
                
                sendline = getLongestRequest();
                System.out.println("Longest String: " + sendline + "\n");
                out.println(sendline);
                
                socket.close();
                in.close();
                out.close();
                System.out.println("\n[+]Connection closed");
            }
        } catch (Exception e) 
        {
            e.printStackTrace();
        }
    }
}