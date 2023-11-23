#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <stdbool.h>
#include <arpa/inet.h>
#include <sys/socket.h>
#include <unistd.h>

void handle(char* msg)
{
    printf("[-]Error %s\n", msg);
    exit(EXIT_FAILURE);
}

const int port = 8888;

int main(int argc, char* argv[])
{
    if (argc < 2) handle("argc");

    int sock, n;
    struct sockaddr_in addr;
    socklen_t len = sizeof(struct sockaddr);
    char sendline[BUFSIZ], recvline[BUFSIZ], *ip = argv[1];

    memset(&addr, 0, len);
    addr.sin_family = AF_INET;
    inet_pton(AF_INET, ip, &addr.sin_addr);
    addr.sin_port = htons(port);

    if((sock = socket(AF_INET, SOCK_STREAM, 0)) < 0) handle("socket");    
    if((connect(sock, (struct sockaddr*)&addr, len)) < 0) handle("connect");
    printf("[+]Client connected\n\n");

    while(true)
    {
        printf("Inserisci una stringa (exit): ");
        fgets(sendline, BUFSIZ, stdin);

        if (!strcmp(sendline, "exit\n")) break;

        if((send(sock, sendline, strlen(sendline), 0)) < 0) handle("send");
        if((n = recv(sock, recvline, BUFSIZ, 0)) < 0) handle("recv");
        recvline[n] = 0;

        printf("Server: %s\n", recvline);
    }

    if((close(sock)) < 0) handle("close");
    printf("\n[+]Client disconnected\n");

    exit(EXIT_SUCCESS);
}