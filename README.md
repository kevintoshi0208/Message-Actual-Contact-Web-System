# Message Actual Contact Web System

## Installation

```
$ cd docker-compose

$ docker-compose up -d

$ docker exec -it php74-container /bin/bash

root#  php bin/console doctrine:database:create

root#  php bin/console doctrine:migration:migrate

```