# Shopify API testing

## Install and configure

Requirements:
- php >= 7.4
- composer

```bash
cp .env.dist .env
composer install
```

- Create a shopify domain
- Create an app (see https://your_domain.myshopify.com/admin/apps)
- In the app, allow the read scopes and create an access token
- edit the `.env` file

## Run a query

```bash
php bin/console shopify:products:fetch
```
