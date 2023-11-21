import java.io.*;
import java.net.*;

public class Server 
{
    static final int port = 5533;

    static String processing(String recvline) 
    {
        StringBuilder reversed = new StringBuilder(recvline).reverse();
        return reversed.toString();
    }

    public static void main(String[] args) 
    {
        System.out.println("[+]Server listening on port " + port + "\n");

        try (ServerSocket server = new ServerSocket(port)) 
        {
            while (true) 
            {
                Socket socket = server.accept();
                System.out.println("Client " + socket.getInetAddress() + " connected");
                Thread threadServer = new Thread(() -> 
                {
                    try (PrintWriter out = new PrintWriter(socket.getOutputStream(), true);
                         BufferedReader in = new BufferedReader(new InputStreamReader(socket.getInputStream()))
                        ) 
                    {
                        String sendline = "", recvline = "";
                        while ((recvline = in.readLine()) != null) 
                        {
                            System.out.println("Client " + socket.getInetAddress() + ": " + recvline);
                            sendline = processing(recvline);
                            out.println(sendline);
                            System.out.println(sendline + "\n");
                        }
                    } catch (Exception e) 
                    {
                        e.printStackTrace();
                    }
                    System.out.println("Client " + socket.getInetAddress() + " disconnected");
                });
                threadServer.start();
            }
        } catch (Exception e) 
        {
            e.printStackTrace();
        }
    }
}
