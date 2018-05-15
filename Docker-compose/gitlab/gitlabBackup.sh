#!/bin/sh
## Name:
## Date:
## History

## 数据挂载目录为 /srv/gitlab/data/backups/


DockerName="gitlab_gitlab_1"
docker exec -t ${DockerName} gitlab-rake gitlab:backup:create
