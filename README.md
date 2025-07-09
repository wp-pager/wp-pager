# WP Pager plugin for WordPress
WP Pager is a WordPress plugin for displaying images in a form of a restaurant menu. The main advantage of such plugin is that you can turn pages of the menu by swiping on mobile and desktop devices.

The main purpose of this plugin is to give users a filling of a real restaurant menu where they can turn pages and see the whole menu.

## Development
This project is a Dockerized WordPress installation with WP Pager plugin installed. You can use it to test the plugin or to develop it. To get started, you need to have [🦦 Podman](https://podman.io/) or [🐳 Docker](https://app.docker.com/) installed on your machine. Then you can follow the instructions below.

### Build the Image
For Docker, run this:
```bash
docker compose build
```
For Podman, run this:
```bash
podman-compose build
```

### Start a Container
For Docker, run this:
```bash
docker compose up -d
```
For Podman, run this:
```bash
podman-compose up -d
```

Wait until all containers will be up and running. Visit `http://localhost:8080`. If you see the WordPress installation page, you are good to go. If you see an error, wait a bit more

### Enter Running Container
To enter the running container you can use this command for Docker:
```bash
docker compose exec app bash
```
For Podman, run this:
```bash
podman-compose exec app bash
```

### Copy `vendor` and `node_modules`
If you don't have NPM and Composer installed on your machine (like myself), you can copy `vendor` and `node_modules` from the running container to get proper intellisense to your editor. For Docker run this:

```bash
docker cp wp-pager-app:/var/www/html/wp-content/plugins/wp-pager/vendor plugin/ && \
docker cp wp-pager-app:/var/www/html/wp-content/plugins/wp-pager/node_modules plugin/
```
For Podman, run this:
```bash
podman cp wp-pager-app:/var/www/html/wp-content/plugins/wp-pager/vendor plugin/ && \
podman cp wp-pager-app:/var/www/html/wp-content/plugins/wp-pager/node_modules plugin/
```

### Destroy Container
After you are done working on a project, you can remove networks and running containers by running this Docker command:
```bash
docker compose down
```
For Podman, run this:
```bash
podman-compose down
```

## Admin Panel Info
- Login: `admin`
- Password: `password`

## Database Info
- Host: `pager_db`
- User: `pager`
- Password: `111111`
- Database Name: `pager`

## License
The WP Pager project is licensed under the [MIT License](https://github.com/wp-pager/wp-pager/blob/master/LICENCE)

> I'm keeping the project with PSR-12 code style, so please, make sure that you are using the same code style. For convenience, there is a Laravel Pint formatter that formats your code automatically. You can read more about Laravel Pint [here](https://laravel.com/docs/pint)
