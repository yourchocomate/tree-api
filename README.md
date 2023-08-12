# My Tree API

Open source project to create your own portfolio api and backend.

Go to [https://tree.yourchocomate.one](https://tree.yourchocomate.one) to register and create your own portfolio api without doing any coding or hosting.

## About this project

This project is a simple backend and api for your portfolio database. You can add, edit, delete and list your projects and skills. Just clone this repository and follow the instructions below.

## Used technologies

This project was developed using laravel 10 and the following technologies of the laravel ecosystem:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- Fillament PHP Admin Panel.
- Livewire for dynamic components.
- Tailwind CSS for styling.

## Installation

### Requirements

- PHP 8.1 or higher
- Composer
- MySQL 8.0 or higher

### Steps

1. Clone this repository
2. Run `composer install`
3. Create a database for this project
4. Copy the `.env.example` file to `.env` and fill the database information
5. Run migrations with `php artisan migrate`

## Usage

- Run `php artisan serve` to start the server
- Access the admin panel at `http://localhost:8000/admin`
- Register a new user and login

## API Endpoints

- `GET /api/handle/{your-handle}` - Get your profile information with projects and skills

### Api Response

```json
{
  "user": {
    "name": "Your Name",
    "email": "youremail@domain.com",
    "handle": "yourname",
    "bio": "Here is your bio",
    "avater": "https://your-avater.com/avater.png",
  },
  "handles": {
    "skill" : [
        {
            "id": 1,
            "label": "PHP",
            "icon": "https://laravel.com/img/favicon/favicon.ico", // or hero icons name. example: s-arrow-right
            "tooltip": "Click me",
            "description": "<p>PHP is a popular general-purpose scripting language that is especially suited to web development.</p>",
            "created_at": "2023-08-06T14:02:59.000000Z"
        }
    ],
    "social": [
      {
        "id": 1,
        "name": "Twitter",
        "url": "https://twitter.com/username",
        "icon": "s-twitter", // or png,svg url
        "created_at": "2023-08-06T14:02:59.000000Z"
      }
    ],
    "portfolio": [
      {
        "id": 1,
        "label": "Your Project",
        "icon": "https://your-project.com/logo.png", // or hero icons name. example: s-arrow-right
        "tooltip": "Your project motto",
        "description": "<p>Description</p>",
        "url": "https://your-project.com/",
        "created_at": "2023-08-06T14:31:15.000000Z"
      }
    ]
  }
}
```

## License

This project is licensed under the MIT License - see the  [MIT license](https://opensource.org/licenses/MIT) file for details

## Contributing

1. Fork this repository
2. Create a new branch with your changes: `git checkout -b my-feature`
3. Save your changes and create a commit message telling you what you did: `git commit -m "feature: My new feature"`
4. Submit your changes: `git push origin my-feature`
5. Open a pull request

## Contact

- Author: [Habibur Rahman](mailto:yourchocomate@gmail.com)

