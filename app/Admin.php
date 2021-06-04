<?php

    namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;

    class Admin extends Authenticatable
    {
        use Notifiable;

        protected $guard = 'admin';

        protected $fillable = [
            'name', 'username', 'password',
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
        public function notifications()
        {
            return $this->morphMany(admin_notification::class, 'notifiable')->orderBy('created_at', 'desc');
        }

        public function unreadNotifications()
        {
            return $this->morphMany(admin_notification::class, 'notifiable')->where('read_at',null)->orderBy('created_at', 'desc');
        }
    }
?>