import java.io.*;
import java.net.*;

public class Server_A
{
    static final int port = 3333;
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

                String recvline = in.readLine();
                System.out.println("Client: " + recvline);
                
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