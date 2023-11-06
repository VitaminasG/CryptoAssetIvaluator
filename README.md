## Docker install on Ubuntu system:
```console
sudo apt-get install docker docker-compose  
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