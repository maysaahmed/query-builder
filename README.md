# Dynamic Query Builder to Filter Users

## Installation

Please check the official laravel installation guide for server requirements before you start. [Laravel Documentation](https://laravel.com/docs/8.x/installation)

Clone the repository

    git clone https://github.com/maysaahmed/query-builder.git

Switch to the repo folder

    cd query-builder

Install all the dependencies using composer

    composer install

Generate a new application key

    php artisan key:generate


Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate


## Fill Users

Fill users table with 1000 records of fake data
run this command


    php artisan tinker
    
Then run this inside Psy shell to generate random 1000 users 
    
    User::factory()->count(1000)->create();


## Filter Users
You can filter users using (id, first_name, last_name, full_name, age, gender, num of messages, creation_date) and show all data in datatable, pie and bar charts 

    {base_url}/users



