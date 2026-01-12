# WP Pager plugin for WordPress
WP Pager is a WordPress plugin for displaying images in a form of a restaurant menu. The main advantage of such plugin is that you can turn pages of the menu by swiping on mobile and desktop devices.

The main purpose of this plugin is to give users a filling of a real restaurant menu where they can turn pages and see the whole menu.

## Development

### Build the Image
With Podman:
```bash
podman-compose build
```

With Docker:
```bash
docker compose build
```

#### Create `node_modules`
Run this command to install npm packages and generate a `node_modules` directory on your local machine if you don't have it. With Podman:
```bash
podman-compose run --rm app bash -c "cd wp-content/plugins/wp-pager && npm i"
```

With Docker:
```bash
docker compose run --rm app bash -c "cd wp-content/plugins/wp-pager && npm i"
```

#### Create `vendor` directory
Run this command to install php packages and generate a `vendor` directory on your local machine if you don't have it:

```bash
podman-compose run --rm app bash -c "cd wp-content/plugins/wp-pager && composer install"
```

With Docker:
```bash
docker compose run --rm app bash -c "cd wp-content/plugins/wp-pager && composer install"
```

### Start a Container
With Podman:
```bash
podman-compose up -d
```

With Docker:
```bash
docker compose up -d
```

Wait until all containers will be up and running. Visit `http://localhost:8080`. If you see the WordPress installation page, you are good to go. If you see an error, wait a bit more until database will spin up.

### Enter Running Container
To enter the running container you can use this command. With Podman:
```bash
podman-compose exec app bash
```

With Docker:
```bash
docker compose exec app bash
```

Inside the container, you can navigate to `/var/www/html/wp-content/plugins/wp-pager` directory to run `npm` and `composer` commands.

### Destroy Container
After you are done working on a project, you can remove networks and running containers by running this command. With Podman:
```bash
podman-compose down
```

With Docker:
```bash
docker compose down
```

## Admin Panel Info
- Login: `admin`
- Password: `password`

## Database Info
- Host: `db`
- User: `pager`
- Password: `111111`
- Database Name: `pager`

## License
The WP Pager project is licensed under the [MIT License](https://github.com/wp-pager/wp-pager/blob/master/LICENCE)

> I'm keeping the project with PSR-12 code style, so please, make sure that you are using the same code style. For convenience, there is a Laravel Pint formatter that formats your code automatically. You can read more about Laravel Pint [here](https://laravel.com/docs/pint)
