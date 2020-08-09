# Tribe

## Running project
1. You have to have installed docker on your machine
2. Run `docker-compose up --build`
3. After docker containers are built you need to connect to mysql container via command `docker exec -it tribe-mysql bash`
4. Once you're in the mysql container import database sql file via command `mysql -u root -p tribe < /var/www/dump/init.sql` (password: rootPassword)
5. Go to 'http://localhost:8080' and you should see "Hello world on the screen"

## About project
1. There are only two tables `users` and `actions`
2. Roles are hardcoded values and for now there are 3 roles:ROLE_ADMIN = 1 ROLE_MANAGER = 2 ROLE_USER = 4
3. Actions and users can belong to many roles.
4. I created an API which has ability to create/view/update users and same for actions.
5. There is an endpoint `localhost:8080/permissions/granted` to view if user has access to a certain action.
6. Detailed API spec written here: https://documenter.getpostman.com/view/12314573/T1LJkoYH?version=latest