<?php

    namespace App;
    use App\admin_notification;
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
            return $this->morphMany(admin_notification::class, 'notifiable')->where('read_at',NULL)->orderBy('created_at', 'desc');
        }
        public function markAsRead()
        {
            $listNotif = admin_notification::all()->where('read_at',NULL);
            foreach($listNotif as $notifUnread)
            {
                $notifUnread->read_at = now();
                $notifUnread->save();
            }
        }
    }
?>