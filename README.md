# Cross Site Scripting (XSS) Demonstration and Detection
#### A Docker-based approach to demonstrating XSS vulnerabilities using NGINX, MYSQL, and PHP (NMP)

### Components
1. `docker-compose.yaml` file: this file defines three (3) containers:
  1. an `nginx` server container
  2. a `php` container with an `app` volume containing the web-app's code
  3. a `db` MYSQL container with a volume to store the web-app's MySQL database
2. `./php/Dockerfile` file: initiates the PHP container on build
  1. sets the PHP working directory to `/var/www/app/`
  2. copies the db password from `./db/password.txt` into /etc/db-password.php for use in the PHP PDO db connection
3. `./nginx/default.conf` file: NGINX configuration
  1. passes .php requests to the PHP container via port 9000
  2. sets the public web root directory to `/var/www/app/public`
4. `./initdb/dbappsetup.sql` file: defines a MYSQL database for use by the web-app
5. `./db/password.txt`: stores the MYSQL root password used by MYSQL and PHP
6. `./app/` stores the web-app's code; shared directory with PHP `/var/www/app`
  * `./app/public/` is the web app's 'public' root
  * `./app/config` and `./app/templates` are not publicly accessible but are accessed via PHP `includes()`

### Usage
1.
```Shell
git clone https://github.com/covespy/xssdemo.git
cd [project]
```
2. **[_Critical_]** Modify `./app/config/config.inc.php` line 19

  `define('BASE_URL', 'http://172.16.86.135/');`

  with your server's base URL
3. **[_Optional_]** Update `./db/password.txt` with desired MYSQL password
4.
```Docker
docker compose up --build -d
```
5. Point web browser to your server's base URL

### XSS Demo Instructions
See [`./app/public/instructions/index.php`](./app/public/instructions/index.php)

(best viewed in the running webserver at BASE_URL/instructions/)
