
import java.util.Date;
import java.util.Scanner;
import java.net.ServerSocket;
import java.net.Socket;
import java.io.DataOutputStream;
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.IOException;
import java.io.DataOutputStream;
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.IOException;

public class SocketTest
{		
	public static void main(String[] args)
	{
		String hostname = "192.168.0.0";//For "localhost" ;
		int port = 7654 ;
		
		client(hostname, port);
		//server(port);
		
	}
	public static void client(String hostname, int port)
	{
		try
		{
			System.out.println("Connecting to server on port " + port) ;
			
			Socket connectionSock = new Socket(hostname, port) ;
			BufferedReader serverInput = new BufferedReader(new InputStreamReader(connectionSock.getInputStream())) ;
			DataOutputStream serverOutput = new DataOutputStream(connectionSock.getOutputStream()) ;
			
			System.out.println("Connection made, sending name.") ;
			
			serverOutput.writeBytes("Dusty Rhodes\n") ;
			
			System.out.println("Waiting for reply.") ;
			
			String serverData = serverInput.readLine() ;
			
			System.out.println("Received: " + serverData) ;
			
			serverOutput.close() ;
			serverInput.close() ;
			connectionSock.close() ;
		}
		catch (IOException e)
		{
			System.out.println("ERROR: DateClient ==> : " + e.getMessage()) ;
		}
	}
	
	public static void server(int port)
	{
		while(true)
		{
			Date now = new Date() ;
			try
			{
				System.out.println("Waiting for a connection on port " + port + ".") ;

				ServerSocket serverSock = new ServerSocket(port) ;
				Socket connectionSock = serverSock.accept() ;
				BufferedReader clientInput = new BufferedReader(new InputStreamReader(connectionSock.getInputStream())) ;
				DataOutputStream clientOutput = new DataOutputStream(connectionSock.getOutputStream()) ;

				System.out.println("Connection made, waiting for client " + "to send their name.") ;

				String clientText = clientInput.readLine() ;
				String replyText = "Welcome, " + clientText + ", Today is " + now.toString() + "\n" ;
				clientOutput.writeBytes(replyText) ;

				System.out.println("Sent: " + replyText) ;

				clientOutput.close() ;
				clientInput.close() ;
				connectionSock.close() ;
				serverSock.close() ;
			}
			catch (IOException e)
			{
				System.out.println("ERROR: DateServer ==> :" + e.getMessage()) ;
			}
		}
	}
}