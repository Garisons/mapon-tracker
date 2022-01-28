
### Requirements:
* Database: PostgreSQL
* PHP: 8.0+

### SQL Setup
Run query in database

```sql
create table users
(
    id       serial
        primary key,
    login    varchar(255) not null,
    password varchar(255) not null
);

alter table users
    owner to postgres;
```

### Setup environment

Copy `.env.example` to `.env`, setup missing keys, database DSN url

### Run project

In project root run command: `php -S localhost:8000 -t public`
