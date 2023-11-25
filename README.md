# Rapid Ranker

## Introduction

**Rapid Ranker** is a Laravel package designed to enable users to level up through an accumulative point system. This tool is perfect for platforms looking to encourage user engagement and participation through a gamification scheme. Levels are achieved by reaching a specific amount of points within a set period, such as 7 days.

## Installation

To install Rapid Ranker, you will need Composer. Install Rapid Ranker using the following command:

```bash
composer require hammam-zarefa/rapid-ranker
```
After installing the package, publish the necessary migrations with:
```bash
php artisan vendor:publish --tag=migrations
```

## Usage
```php
use HasLevel;
```
### Add Level to user model

### Get Current Level
To get the current level of a user:
```php
$user->currentLevel();
```

### Progress to Next Level
To view the user's progress towards the next level, including remaining points, remaining duration, and progress percentage:
```php
$user->nextLevel();
```

### Get User Points
To get the current points of the user:
```php
$user->nextLevel();
```

### Add Points
To add points to the user:
```php
$user->addPoints(10.3);
```

### Deduct Points
To deduct points from the user:
```php
$user->deductPoints(3.2);
```

### Lock User Level
To lock a user at a specific level:
```php
$user->lockLevel(2);
```

### Unlock User Level
To unlock a user's level (the level parameter is optional if you wish to assign a new level to the user):
```php
$user->unlockLevel(2);
```

## Contributions
Contributions are welcome. If you have any suggestions for improving Rapid Ranker, please open an issue in our GitHub repository.

## License
Rapid Ranker is distributed under the MIT License. See the LICENSE file in the repository for more details.
