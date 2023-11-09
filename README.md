## Docker install on Ubuntu system:
```console
sudo apt-get install docker docker-compose  
```

## Code Fixer:
* friendsofphp/php-cs-fixer - [PHPStorm documentation]((https://www.google.com)https://www.jetbrains.com/help/phpstorm/using-php-cs-fixer.html#installing-configuring-php-cs-fixer)

## Important!
After docker build, please migrate schema and add fixtures:
```console
make migrate
```
```console
make load_fixtures
```

### Add Aliases to /etc/hosts:
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

### Available app API list:

| Name            | Method | Scheme | Host |                     Path |
|-----------------|:------:|-------:|-----:|-------------------------:|
| _preview_error  |  ANY   |    ANY |  ANY | /_error/{code}.{_format} |
| app.swagger     |  GET   |    ANY |  ANY |            /api/doc.json | 
| app_asset_index |  GET   |    ANY |  ANY |     /api/user/{id}/asset |  
| default         |  GET   |    ANY |  ANY |                        / |  
| app.swagger_ui  |  GET   |    ANY |  ANY |                 /api/doc |

More details: http://dev.local/api/doc