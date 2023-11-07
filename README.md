## Docker install on Ubuntu system:
```console
sudo apt-get install docker docker-compose  
```

## Important!
After docker build, please migrate schema and add fixtures:
```console
php bin/console doctrine:migrations:migrate
```
```console
php bin/console doctrine:fixtures:load
```

### Add Aliases to /etc/hosts
Add the following lines to `/etc/hosts`:
```console
172.20.120.2 dev.local
```
```console
172.20.120.3 dev.pma.local
```

## Make commands:

### Build and Run:
```console
make up
```

### Shutdown:
```console
make down
```

### SSH connection:
```console
make ssh
```