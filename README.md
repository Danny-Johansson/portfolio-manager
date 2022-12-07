# Portfolio, Resume and Job Search System

Built with Laravel 9

## Features
- User & Login System
- Roles & Permission System
- Create Read Update Delete Functionality
- Soft Delete System
- Tagging System
- Translation (Lang) Support
- File Upload
- Managing Projects
- Managing Resume
- Managing Demonstrations
- Banned Phrases system
- Modularity and Scalability

## Demonstrations
### Administration Demonstration
A fully accessible demo version can be found here :
[Demonstration Version](https://portfolio.danny-johansson.online/)

See the Wiki for Login Details:
[Credentials](../../wiki/Credentials)

It has certain limitations, such as not displaying any external emails, phone numbers or links.

It also features a banned phrases system, that will limit most user inputs in what can be written.

These two systems was implemented to prevent spam / advertisments from being posted.
It is mainly there to demonstrate the administration part of the system.

### Live Version

A Live version of the system without the display limitations , but no access to the administration part of the system,
can be found here:
[Live Version](https://danny-johansson.online)

## Installation
1. Install Dependencies
   - Node Modules
    ```
    npm install
    ```
    - Composer Modules
    ```
    composer install
    ```
2. Configure the System
    - Create .env file:
      ```
      copying .env-example and renaming it .env
      ```
    - Edit the .env file:
      ```
      Set the app settings to match your needs
      Set the system settings - found between the log settings and the database settings
      Set the database credentials 
      ```
    - Generate an App key
      ```
       php artisan key:generate
      ```
3. Configure the User Seeder
   ```
    edit the User Seeder - found in database -> seeders -> UserSeeder.php - with your desired user credentials
   ```
4. Setup the Database
   ```
   php artisan migrate
    ```
5. Cache the System
   ```
   php artisan config:cache
   php artisan route:cache
   ```
6. Change the information for the Resume
     ```
    Logging In on the Website and using the Administration Panel
     ```
7. Change the About Me page
    ```
     Changing the text in the about_text div in the About view - found in resources -> views -> pages -> about.blade.php
    ```
8. Start creating Projects and Demonstrations

**Optional**

Modify the Lang translations files found in lang -> en to suit your needs.

More Languages can be supported by copying the en folder and renaming it to a ISO 639-1 name, such as da for Danish.
The files will need to have all the things on the right side in each file replace
```
    changing 
     "certificate" => "Certificate",
    into
     "certificate" => "Certifikat",
```
