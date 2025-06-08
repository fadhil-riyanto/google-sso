# How to run

- run `git clone https://github.com/fadhil-riyanto/google-sso`
- rename & edit `docker-compose.yml.example`, and change <YOUR_DB_PASSWORD> with output of `openssl rand -hex 32`, this is will your db password
- run `docker compose up --build`
- run migration by doing
        - identify your running containe manually by `docker ps`
        - run bash `docker exec -it <your_container_id> bash
        - run migration by type `php artisan migrate`

open: https://localhost:10302

# Production
WIP

# License
GPL 2.0