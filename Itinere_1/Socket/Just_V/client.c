#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <arpa/inet.h>
#include <unistd.h>

const int port = 7777;

void handle(char* msg)
{
    printf("Error %s\n", msg);
    exit(1);
}

int main(int argc, char* argv[])
{
    int sock, n;
    struct sockaddr_in addr;
    socklen_t len = sizeof(addr);
    char *ip = argv[1], sendline[BUFSIZ], recvline[BUFSIZ];

    memset(&addr, 0, len);
    addr.sin_family = AF_INET;
    inet_pton(AF_INET, ip, &addr.sin_addr);
    addr.sin_port = htons(port);

    if((sock = socket(AF_INET, SOCK_STREAM, 0)) < 0) handle("socket");

    if((connect(sock, (struct sockaddr*)&addr, len)) < 0) handle("connect");
    printf("=> Client connected\n\n");

    while (1)
    {
        printf("Enter an input (stop): ");
        fgets(sendline, BUFSIZ, stdin);

        if(!strcmp(sendline, "stop\n")) break;

        if((send(sock, sendline, strlen(sendline), 0)) < 0) handle("send");

        if((n = recv(sock, recvline, BUFSIZ, 0)) < 0) handle("recv");
        recvline[n] = 0;

        printf("Server: %s\n", recvline);
    }

    if(close(sock)) handle("close");
    printf("\n[+]Connection closed\n");

    exit(EXIT_SUCCESS);
}