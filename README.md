Vero PHP
---

# About

I've developed this library because the official Vero library is out of data and doesn't support some stuff.

# Requirements

- PHP 7.1+
- json extension

# Installation

Install this library with composer by running the following command.

`composer require samlittler/vero-php`

# Usage

- Users
    - Identify
    - Unsubscribe
    - Resubscribe
    - Delete
    - Tags
        - Add
        - Remove
- Events
    - Track
    
## Get a Vero instance

```php
$vero  = new \SamLittler\Vero('<your_auth_token>');
```
    
## Users

### Identify

**Standard Identify Usage**

Standard identification usage is simple, and it allows subsequent track events to be collected on the Vero dashboard.

```php
$user = $vero->users()->findOrCreate(123);
$user->identify();
```

**You can also add arbitrary identification information here.**

*Note: Email addresses have a dedicated method, because they're handled differently.*

```php
$user = $vero->users()->findOrCreate(123);
$user->setEmail('john@example.com');
$user->identify([
    'forename' => 'John',
    'surname' => 'Smith',
]);
```

**Push Channels**

You can only register push channels during the identify call.

```php
$user = $vero->users()->findOrCreate(123);
$user->addChannel('push', '<apns_or_fcm_token>', 'ios');
$user->identify();
```

### Unsubscribe

You can programmatically unsubscribe users from Vero marketing.

```php
$user = $vero->users()->findOrCreate(123);
$user->unsubscribe();
```

### Resubscribe

You can programmatically resubscribe users to Vero marketing.

```php
$user = $vero->users()->findOrCreate(123);
$user->unsubscribe();
```

### Delete

You can delete users from Vero. You'll require a new identify call to re-add them.

```php
$user = $vero->users()->findOrCreate(123);
$user->delete();
```

## Tags

### Add

```php
$user = $vero->users()->findOrCreate(123);
$user->addTag('november');
```

### Remove

```php
$user = $vero->users()->findOrCreate(123);
$user->removeTag('november');
```

## Events

   ### Track
   
   You can send track events with arbitrary data.

```php
$user = $vero->users()->findOrCreate(123);
$user->track('User Registered', [
    'referral' => 'app_store',
]);
```
   