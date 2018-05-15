Run redis-server
## Æô¶¯
docker run -d --name redis -p 6379:6379 dockerfile/redis

Run redis-server with persistent data directory. (creates dump.rdb)

docker run -d -p 127.0.0.1:6379:6379 -v <data-dir>:/data --name redis dockerfile/redis

Run redis-server with persistent data directory and password.

docker run -d -p 127.0.0.1:6379:6379 -v <data-dir>:/data --name redis dockerfile/redis redis-server /etc/redis/redis.conf --requirepass <password>
Run redis-cli

docker run -it --rm --link redis:redis dockerfile/redis bash -c 'redis-cli -h redis'