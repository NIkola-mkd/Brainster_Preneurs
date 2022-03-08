# Brainster Preneurs

#### To setup the project please follow this instructions:

1. Clone this repo:

```
cd/destination_folder (on your local machine)
git clone {repo_rul}
```

2. Create a database on your local machine

3. Generate key:

```
php artisan key:generate
```

4. Rename `.env.example` file to `.env`

5. Open `.env` file and setup the following variables:

```
DB_DATABASE= {your database name}
DB_USERNAME= {db username}
DB_PASSWORD= {db password}
```

6. Create a profile on `https://mailtrap.io/`

7. Create new project and inbox

8. In `Integrations` select `Laravel 7+` and copy values

9. Paste values in `.env`

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME= {generated username}
MAIL_PASSWORD= {generated password}
MAIL_ENCRYPTION=tls
```

10. In order to create db tables, run this command:

```
php artisan migrate
```

11. Seed data (academies, skills) running this command:

```
php artisan db:seed
```

12. Run the following commands to optimize the asset:

```
npm install
npm run dev
```

13. Star application using this command:

```
php artisan serve
```

14. Follow the generated link and start using application

<hr>

##### Notes

-   The initial page is `login` page
-   To create a new account please folow the `register here` link
-   All inputs are required
-   Once you create a new user, please complete your profile (add image an skills)
-   You can not acces other routes, if your profile is not completed
-   Projects on `dasborad` page are generated via API, so be aware that `ajax.js` is included
-   On `dasborad` page, only projects that are not assembled are listed
-   You can see your own projects in `My Projects`
-   You can see youar applications and status in `My applications`
-   You can delete only denied projects
-   On `my-applications` page, you can see your applicants by clicking on the right applicant circle
-   Before you apply for project, enter message as messages are required
