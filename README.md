# fcm - Firebase Cloud Messaging
> A simple driver for connecting the laravel notification system to Firebase cloud messaging

### What's this
fcm provides a very clean and fluent interface for connecting the Laravel 5.3 notification system to Firebase cloud messaging.
This allows you to easily send notifications to websites, Android apps and iOS apps without effort.

### How to install
- Use composer to install the package with `composer require dealloc/fcm`
- Register the service provider `\Dealloc\FCM\NotificationServiceProvider::class` in your service providers
- Create a notification using `php artisan make:notification`
- Implement the `\Dealloc\FCM\Contracts\FirebaseNotification` contract in your notification class
- In the `via` method of your notification return `['fcm']`

### Example
TODO - provide a simple notification class and code to dispatch it, referencing laravel documentation

### License
This project is licensed under the MIT license, see [LICENSE](LICENSE) for full license.