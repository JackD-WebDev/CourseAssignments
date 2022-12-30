FROM php:7.4-fpm-alpine3.15

WORKDIR /var/www/html

COPY coursework .

# sendmail config
############################################

RUN apk update && apk add ssmtp

# root is the person who gets all mail for userids < 1000
RUN echo "root=student" >> /etc/ssmtp/ssmtp.conf

# Here is the gmail configuration (or change it to your private smtp server)
RUN echo "mailhub=smtp.gmail.com:587" >> /etc/ssmtp/ssmtp.conf
RUN echo "AuthUser=jackvdaly@gmail.com" >> /etc/ssmtp/ssmtp.conf
RUN echo "AuthPass=tPGN0!z3Myzt!K" >> /etc/ssmtp/ssmtp.conf

RUN echo "UseTLS=YES" >> /etc/ssmtp/ssmtp.conf
RUN echo "UseSTARTTLS=YES" >> /etc/ssmtp/ssmtp.conf

RUN echo "FromLineOverride=YES" >> /etc/ssmtp/ssmtp.conf

# Set up php sendmail config
RUN echo "sendmail_path=sendmail -i -t" >> /usr/local/etc/php/conf.d/php-sendmail.ini

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN echo "file_uploads = On\n" \
         "memory_limit = 1G\n" \
         "upload_max_filesize = 1G\n" \
         "post_max_size = 1G\n" \
         "max_execution_time = 600\n" \
         "upload_tmp_dir = uploads/tmp" \
         > /usr/local/etc/php/conf.d/uploads.ini

RUN addgroup -g 1000 student && adduser -G student -g student -s /bin/sh -D student

USER student