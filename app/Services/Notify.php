<?php

namespace App\Services;


class Notify{

    // Created Notification
    static function createdNotification(){
        return notify()->success('Created successfully.', 'Success');
    }

    // Updated Notification
    static function updatedNotification(){
        return notify()->success('Updated successfully.', 'Success');
    }

    // Deleted Notification
    static function deletedNotification(){
        return notify()->success('Deleted successfully.', 'Success');
    }
}
