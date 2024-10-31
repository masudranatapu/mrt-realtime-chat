<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('chat.{id}', function (User $user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('chat.{receiverId}.{senderId}', function (User $user, $receiverId, $senderId) {
    return (int) $user->id === (int) $receiverId || (int) $user->id === (int) $senderId;
});
