FROM php:8.0-apache

# Making app folder, copy everything to it, and set working directory
RUN mkdir -p /var/www/html
COPY . /var/www/html
WORKDIR /var/www/html

# Update debian and install tools for easy debugging.
RUN apt update 

# Run nano for easier debug inside container.
RUN apt install nano 

# Delete existing database.
RUN rm -rf ./db/dorayaki.sqlite

# Make file accessable by everyone (this command will make huge security hole in system, but idc)
RUN chmod -R 777 ./

EXPOSE 8080