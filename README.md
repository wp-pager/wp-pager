# WP Pager plugin for WordPress
WP Pager is a WordPress plugin for displaying images in a form of a restaurant menu. The main advantage of such plugin is that you can turn pages of the menu by swiping on mobile and desktop devices.

The main purpose of this plugin is to give users a filling of a real restaurant menu where they can turn pages and see the whole menu.

## Development
This project is a Dockerized WordPress installation with WP Pager plugin installed. You can use it to test the plugin or to develop it. To get started, you need to have [🦦 Podman](https://podman.io/) or [🐳 Docker](https://app.docker.com/) installed on your machine. Then you can follow the instructions below.

1. Run `docker compose build` or `podman-compose build` to build images
1. Run `docker compose up -d` or `podman-compose up -d` to start containers
1. Wait until all containers will be up and running
1. Visit **http://localhost:8888**. If you see the WordPress installation page, you are good to go. If you see an error, wait a bit more
1. To enter the running container you can use `docker compose exec app bash` or `podman-compose exec app bash` command

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
