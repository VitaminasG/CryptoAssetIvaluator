## HTTP API for Asset Management
### Overview
This project implements an HTTP API for managing and tracking the value 
of digital assets, specifically cryptocurrencies. It allows users to perform 
CRUD operations on their assets and view their values in USD. This API 
is particularly useful for users who wish to maintain a detailed portfolio 
of their digital currencies.

### Technical Stack

* **Framework**: Developed using Symfony 6.3, leveraging the robust features and modern practices of this framework.
* **Language**: The API is written in PHP 8.1, ensuring up-to-date syntax and performance optimizations.
* **Data Storage**: Redis is used for efficient data caching and storage, enhancing the API's performance.
* **Containerization**: Docker is utilized to containerize the application, making it easy to set up and deploy in any environment.

### Features

### User Entity
* The User entity is provided statically in this version, focusing on the 
asset management functionalities.

### Asset Entity

* **CRUD Operations**: Users can create, read, update, and delete their assets.
* **Attributes**:
  * **Label**: Assets can be labeled (e.g., 'binance').
  * **Supported Currencies**: Includes BTC, ETH, and IOTA.
  * **Value Constraints**: Ensures asset values are never negative.
  * **Multiple Instances**: Allows holding multiple instances of the same currency with distinct labels.

### Value Tracking and Exchange Rates
* The API enables users to view the value of their assets in USD, including both individual and total portfolio values.
* Exchange rates are fetched from api.coinpaprika.com, ensuring accurate and current financial data for conversions.
  
### Implementation
* The API is implemented using Symfony 6.3 and PHP 8.1, following best practices for efficient and scalable application design.
* Detailed setup and usage instructions are provided, including Docker configurations for easy deployment.

## Docker install on Ubuntu system:
```console
sudo apt-get install docker docker-compose  
```

### Code Fixer:
* friendsofphp/php-cs-fixer - [PHPStorm documentation](https://www.jetbrains.com/help/phpstorm/using-php-cs-fixer.html#installing-configuring-php-cs-fixer)

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