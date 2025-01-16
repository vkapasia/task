<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Prerequisites

1. Ensure you have PHP version min 8 or above ,Composer.

## Installation Steps

1. Clone the repository:
    - git clone [<repository-url>](https://github.com/vkapasia/task.git)
    - cd task
2. Install dependencies:
    - composer install
3. Set up the environment:
    - Copy the .env.example file to .env:
        cp .env.example .env
    - Configure database credentials and other environment variables in the .env file.

4. Run migrations to set up the database schema:
    - php artisan migrate
5. Seed the database
    - php artisan db:seed

6. Start the development server:
    - php artisan serve


## Testing the Application

1.	Access the application at http://127.0.0.1:8000 in your web browser.
2.	Test authentication:
    - Register a new user.
    - Log in with the registered account. That is created from the seeders.
    Credentials:
        Email: vivek@gmail.com
        Password: password
    - Log out and test re-login functionality.
3.	Test CRUD operations:
    - Add new leads and verify their details in the lead list.
    - Edit lead details and check for successful updates.
    - Delete a lead and verify its removal and soft deletion is implemented.
4.	Test filters:
    - Use the dropdown filter to view leads by status.
5.	Validate server-side validation:
    - Try creating a lead with duplicate or invalid email addresses.
    - Submit forms with missing required fields.
6.	Test bonus features:
    - Delete a lead and attempt to restore it by clicking the button on the top right Restore Deleted Leads.
    - Check the activity log for accurate records of user actions.
        You can check it in the databse table “activity_logs”
