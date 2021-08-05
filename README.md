<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>


# Laravel Scheduler - CronJobs
we will create a simple laravel application to demonstrate task scheduling. Create a new Laravel project by running the following command.

# Creating a new Project

`composer create-project --prefer-dist laravel/laravel cronJobs`

After creating simple application, we are going to create command file

# Create New Artisan Command

`php artisan make:command testCronJobs`

The above command will create a new command file, <b>testCronJobs.php</b>, in the <b>app/Console/Commands<b> directory. Open it 

`protected $signature = 'command:name';`

Replace the words <b>command:name<b> with <b>cronJobs:test</b>. This is what we will call this when running the command to perform the task

`protected $description = 'Send a Daily email to all users with a word and its meaning';`

This is where you place the actual description of what this command will do. Description will be shown when the Artisan list command is executed alongside the signature.

Add your logic inside the <b>handle()</b> function

```
	/**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // your logic to perform scheduled task
    }
```

# Registering the Command
Now that you have created the command, you will need to register it in the Kernel. Go to <b>app/Console/Kernel.php</b>

Add your command class file, jusr like below code

```
	/**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\testCronJobs::class,
    ];
```

Add your command inside the <b>schedule</b> funtion, just like below

```
	/**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('cronJobs:test')->everyFiveMinutes();
    }
```

Now, if you run the `php artisan list command` in the terminal, you will see your command has been registered. You will be able to see the command name with the signature and description.

To test in local environment run `php artisan cronJobs:test`

# Starting the Laravel Scheduler on server side

Let’s setup the Cron Jobs to run automatically without initiating manually by running the command. To start the Laravel Scheduler itself, we only need to add one Cron job which executes every minute. Go to your terminal, ssh into your server, cd into your project and run this command.

`crontab -e`

This will open the server Crontab file, paste the code below into the file, save and then exit.

`* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1`

Do not forget to replace <b>'/path/to/artisan'</b> with the full path to the Artisan command of your Laravel Application.

One of the most important advantages of Laravel Task Scheduler is that we can focus on creating commands, writing logic and Laravel will take care of the rest. It is manageable by other co-workers because it is now tracked by version control.