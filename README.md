<!-- Improved compatibility of back to top link: See: https://github.com/othneildrew/Best-README-Template/pull/73 -->
<a name="readme-top"></a>
<!--
*** Thanks for checking out the Best-README-Template. If you have a suggestion
*** that would make this better, please fork the repo and create a pull request
*** or simply open an issue with the tag "enhancement".
*** Don't forget to give the project a star!
*** Thanks again! Now go create something AMAZING! :D
-->



<!-- PROJECT SHIELDS -->
<!--
*** I'm using markdown "reference style" links for readability.
*** Reference links are enclosed in brackets [ ] instead of parentheses ( ).
*** See the bottom of this document for the declaration of the reference variables
*** for contributors-url, forks-url, etc. This is an optional, concise syntax you may use.
*** https://www.markdownguide.org/basic-syntax/#reference-style-links
-->
[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]


<!-- ABOUT THE PROJECT -->
## About The Project
# Laravel Starter Template Auth

<!-- [![Product Name Screen Shot][product-screenshot]](https://example.com) -->

Laravel starter template dashboard and auth dibuat dengan menggunakan laravel versi 10 dan tailwindcss  

<p align="right">(<a href="#readme-top">back to top</a>)</p>



### Built With

This section should list any major frameworks/libraries used to bootstrap your project. Leave any add-ons/plugins for the acknowledgements section. Here are a few examples.

* [![Laravel][Laravel.com]][Laravel-url]
* [![TailwindCSS]][Tailwindcss-url]
* [![Vite]][Vite-url]

<p align="right">(<a href="#readme-top">back to top</a>)</p>



<!-- GETTING STARTED -->
## Getting Started
## Installation

_Below is an example of how you can instruct your audience on installing and setting up your app. This template doesn't rely on any external dependencies or services._

1. Clone the repo
```sh
git clone https://github.com/suterlan/laravel-starter-auth.git your_project
```

2. Navigate to the cloned project folder:
```shell
cd your_project
```

3. Install the dependencies:
```shell
composer install
```

4. copy `.env.example` file and rename the copy to `.env`. This file is not in the repo because it is sensitive:
```shell
cp .env.expample .env
```

5. Configure the database information in the `.env` file (`DB_*`).
```js
DB_DATABASE=yourdatabase_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Sets the `APP_KEY` value in your `.env` file:
```shell
php artisan key:generate
```

7. Create the `database/migrations` schema:
```shell
php artisan migrate
//OR to drop all existing tables
php artisan migrate:fresh
```

8. Seed the database with fake data. 
Note: there will be a user with email of `superadmin@gmail.com` and password of `password`, you can login directly with it. 
```bash
php artisan db:seed
```

9. Generate a link folder (shortcut) on the public directory to serve the client with files that located on a private directory.
```bash
php artisan storage:link
```

10. Install all dependencies:
```shell
npm install
```

11. Run Vite, to hot module reloading (HMR):
```shell
npm run dev
```

12. In a separate terminal run the Laravel app:
```shell
php artisan serve
```

<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE.txt` for more information.

<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/othneildrew/Best-README-Template.svg?style=for-the-badge
[contributors-url]: https://github.com/suterlan/laravel-starter-auth/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/othneildrew/Best-README-Template.svg?style=for-the-badge
[forks-url]: https://github.com/suterlan/laravel-starter-auth/forks
[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com
[TailwindCSS]: https://img.shields.io/badge/tailwindcss-%2338B2AC.svg?style=for-the-badge&logo=tailwind-css&logoColor=white
[Tailwindcss-url]: https://tailwindcss.com
[Vite]: https://img.shields.io/badge/vite-%23646CFF.svg?style=for-the-badge&logo=vite&logoColor=white
[Vite-url]: https://vitejs.dev

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
