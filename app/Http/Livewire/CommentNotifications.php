<?php

namespace App\Http\Livewire;

use Livewire\Component;


class CommentNotifications extends Component
{
    const NOTIFICATION_THRESHOLD = 5;
    public $notifications;
    public $notificationCount;
    public $isLoading;


    protected $listeners = ['getNotifications'];

    public function mount(){
        $this->notifications = collect([]);
        $this->getNotificationCount();
        $this->isLoading = true;
    }

    public function getNotificationCount(){
        $this->notificationCount = auth()->user()->unreadNotifications->count();

        if($this->notificationCount > self::NOTIFICATION_THRESHOLD){
            $this->notificationCount = self::NOTIFICATION_THRESHOLD.'+';
        }
    }

    public function getNotifications(){
        // sleep(5);
        $this->notifications = auth()->user()
            ->unreadNotifications()
            ->latest()
            ->take(self::NOTIFICATION_THRESHOLD)
            ->get();

        $this->isLoading = false;
    }



    public function render()
    {
        return view('livewire.comment-notifications');
    }
}
