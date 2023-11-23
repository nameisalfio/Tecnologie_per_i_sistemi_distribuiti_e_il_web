#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <stdbool.h>
#include <arpa/inet.h>
#include <unistd.h>
#include <sys/socket.h>

void handle(char* msg)
{
    printf("Error %s\n", msg);
    exit(EXIT_FAILURE);
}

const int port = 5533;

int main(int argc, char* argv[])
{
    if (argc < 2) handle("argc");

    int sockfd, n;
    struct sockaddr_in addr;
    socklen_t len = sizeof(struct sockaddr_in);
    char sendline[BUFSIZ], recvline[BUFSIZ], *ip = argv[1];

    memset(&addr, 0, len);
    addr.sin_family = AF_INET;
    inet_pton(AF_INET, ip, &addr.sin_addr);
    addr.sin_port = htons(port);

    if((sockfd = socket(AF_INET, SOCK_STREAM, 0)) < 0) handle("socket");

    if((connect(sockfd, (struct sockaddr*)&addr, len)) < 0) handle("connect");

    while (true)
    {
        printf("Inserisci un messaggio (stop for exit): ");
        fgets(sendline, BUFSIZ, stdin);

        if(!(strcasecmp(sendline, "stop\n"))) break;

        if((send(sockfd, sendline, strlen(sendline), 0)) < 0) handle("send");

        if((n = recv(sockfd, recvline, BUFSIZ, 0)) < 0) handle("recv");
        recvline[n] = 0;
        printf("Server: %s\n", recvline);
    }

    close(sockfd);

    exit(EXIT_SUCCESS);
}
