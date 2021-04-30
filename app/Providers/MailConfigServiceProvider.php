<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Modules\Setting\Model\Email;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        if (Schema::hasTable('settings')) {
            $settings = DB::table('settings')->get();

            $mail = [];
            foreach ($settings as $item) {
                $mail[$item->key] = $item->value;
            }

            if ($mail) //checking if table is not empty
            {
                $config = array(
                    'driver'     => $mail[Email::MAIL_DRIVER] ?? 'smtp',
                    'host'       => $mail[Email::MAIL_HOST] ?? 'smtp.gmail.com',
                    'port'       => $mail[Email::MAIL_PORT] ?? 587,
                    'from'       => [
                        'address' => $mail[Email::MAIL_ADDRESS] ?? 'example@gmail.com',
                        'name'    => $mail[Email::MAIL_NAME] ?? 'example',
                    ],
                    'encryption' => $mail[Email::PROTOCOL] ?? 'tls',
                    'username'   => $mail[Email::MAIL_USERNAME] ?? NULL,
                    'password'   => $mail[Email::MAIL_PASSWORD] ?? NULL,
                    'sendmail'   => '/usr/sbin/sendmail -bs',
                    'pretend'    => false,
                );
                Config::set('mail', $config);
            }
        }
    }
}
