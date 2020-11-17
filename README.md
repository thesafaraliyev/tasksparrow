### TaskSparrow - The simple task-sharing app

TaskSparrow is a mobile-friendly task-sharing app that uses Laravel, Mysql on the back-end, and Jquery, Bootstrap on the front-end. 

Users can add, edit, delete, and read tasks, assign them to other users using email or username. Every task has a title, deadline, and description. Assigned users automatically informed by mail about the deadline before 10 minutes from the deadline. Authors and assigned users are able to add, edit, and delete comments to the task with the help of live updates without refreshing the page. The author can disable adding a comment to the task for a specific user when assigning it, also delete all posted task comments.  


#### Installation
To use TaskSparrow clone it using the command:

`git clone git@github.com:thesafaraliyev/tasksparrow.git`

Once you download it you will need to prepare a few things before you are ready to start. 
Follow these steps to get the app to a workable state. 

1. Run `composer install` from inside the app directory to download PHP dependencies
2. Run `npm install` to download JS dependencies
3. Run `cp .env.example .env` to create .env file
4. Run `php artisan key:generate` to create a new encryption key
5. Create databases for tasks and task comments
6. Edit the `.env` file to add databases, pusher, and mailtrap account settings
7. Back in the terminal, run `php artisan migrate` to migrate databases
8. Run `php artisan db:seed` to seed databases
9. Run `php artisan serve` to start web server

Congratulations! TaskSparrow is ready and waiting for the new tasks.


#### Notes
- Created dummy user accounts use the 'password' phase as a password 
- I have created the same application using python Django and PostgreSQL, check it out from [here](https://github.com/thesafaraliyev/py_todo)
