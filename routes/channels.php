<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.Admin.{id}', function ($user, $id) {
    if ((int) $user->id === (int) $id) {
        return true;
    }
}, [
    'guards' => ['admin'],
]);
