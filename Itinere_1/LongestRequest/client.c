#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <stdbool.h>
#include <arpa/inet.h>
#include <unistd.h>

void handle(char* msg)
{
    printf("Error %s\n", msg);
    exit(1);
}

int main()
{
    int sock, n;
    struct sockaddr_in addr;
    socklen_t len = sizeof(addr);
    char buffer[BUFSIZ];

    memset(&addr, 0, len);
    addr.sin_family = AF_INET;
    inet_pton(AF_INET, "localhost", &addr.sin_addr);
    addr.sin_port = htons(3333);

    if((sock = socket(AF_INET, SOCK_STREAM, 0)) < 0) handle("socket");
    if((connect(sock, (struct sockaddr*)&addr, len)) < 0) handle("connect");
    print("=> Connected\n\n");

    printf("Enter a request: ");
    fgets(buffer, BUFSIZ, stdin);

    if((send(sock, buffer, strlen(buffer), 0)) < 0) handle("send");

    if((n = recv(sock, buffer, BUFSIZ, 0)) < 0) handle("send");
    buffer[n] = 0;

    printf("Server: %s", buffer);
    
    if(close(sock)) handle("close");

    return 0;
}