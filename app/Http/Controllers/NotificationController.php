<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    # Show all notifications
    public function allNotification()
    {
        return NotificationResource::collection(auth()->user()->notifications);
    }


    # Show users UnreadNotifications
    public function unreadNotification()
    {
        return NotificationResource::collection(auth()->user()->unreadNotifications);
    }

    # Mark all unread Notifications as read
    public function markAllRead()
    {
        $user = auth()->user();

        foreach ($user->unreadNotifications as $notification) {
            return $notification->markAsRead();
        }
    }
}
