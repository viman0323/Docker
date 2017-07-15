FROM ubuntu:latest

RUN apt-get update

RUN apt-get install -y git vim
RUN apt-get install -y python-pip
RUN apt-get install -y python2.7-dev
RUN apt-get install -y python3-pip
RUN apt-get install -y nginx

ADD imay /home/website

EXPOSE 8002
WORKDIR /home/website
#CMD ["/home/website/run.sh"]
