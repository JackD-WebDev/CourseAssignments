FROM composer:latest

WORKDIR /var/www/html

RUN addgroup -g 1000 student && adduser -G student -g student -s /bin/sh -D student
 
USER student

ENTRYPOINT [ "composer" ]