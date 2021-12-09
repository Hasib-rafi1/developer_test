From the root directory run `composer install`
You must have a MySql database running locally
Update the database details in ‘.env’ to match your local setup
Run `php artisan migrate` to setup the database tables
Run `php artisan db:seed` to seed the database with data
make sure you add some data to pivot table `achievement_user`. this is not pre populated as the event supposed to work from the begining and everytime there is a trigger it suuposed to add the achievement under 2 different group lesson and comment. As I assumed the 2 triggers will work as it is mentioned it does not require to omplement the assumed part. 

Thank you.
