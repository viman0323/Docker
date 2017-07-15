FROM ubuntu:latest

RUN apt-get update

RUN apt-get install -y git vim
RUN apt-get install -y python-pip
RUN apt-get install -y python2.7-dev
RUN apt-get install -y python3-pip

ADD requirements.txt /tmp/requirements.txt
RUN pip install -r /tmp/requirements.txt
RUN pip3 install tornado==4.5.1
RUN pip3 install Tornado-MySQL==0.5.1 

ADD imay /home/website

EXPOSE 8000
EXPOSE 9055
WORKDIR /home/website
CMD ["/home/website/run.sh"]
