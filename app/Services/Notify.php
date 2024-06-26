<?php

namespace App\Services;


class Notify
{

    // Created Notification
    static function createdNotification()
    {
        return notyf()->addSuccess('Created successfully.', 'Success');
    }

    // Updated Notification
    static function updatedNotification()
    {
        return notyf()->addSuccess('Updated successfully.', 'Success');
    }

    // Deleted Notification
    static function deletedNotification()
    {
        return notyf()->addSuccess('Deleted successfully.', 'Success');
    }

    // Error Notification
    static function errorNotification(string $error)
    {
        return notyf()->addError($error, 'Error');
    }

    // Success Notification
    static function successNotification()
    {
        return notyf()->addSuccess('Success');
    }
}
