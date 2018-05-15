docker run --detach --hostname gitlab.game-magic.net --publish 443:443 --publish 10080:80 --publish 10022:22 --name gitlab --restart always --volume /srv/gitlab/config:/etc/gitlab --volume /srv/gitlab/logs:/var/log/gitlab --volume /srv/gitlab/data:/var/opt/gitlab gitlab/gitlab-ce:latest

