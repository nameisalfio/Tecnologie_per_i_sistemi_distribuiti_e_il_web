import java.io.*;
import java.net.*;

public class Server
{
    static final int port = 9999;

    static String processing(String recvline)
    {
        boolean outcome = true;
        for (int i = 0; i < recvline.length(); i++)
        {
            char c = recvline.charAt(i);
            if (c != 'v' && c != 'V') outcome = false;
        }
        return "Outcome is " + outcome;
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
            System.out.println("=> Client connected\n");
            String sendline = "", recvline = "";
            while((recvline = in.readLine()) != null) 
            {
                System.out.println("Client: " + recvline);
                sendline = processing(recvline);
                System.out.println(sendline + "\n");
                out.println(sendline);
            }
        } 
        catch (Exception e) 
        {
            e.printStackTrace();
        }
        System.out.println("[+]Connection closed...");
    }
}