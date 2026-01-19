
# 📦 DigitalCMS-lrv12

Application **CMS  avec :
- authentification Breeze (Blade)
- gestion des rôles & permissions
- backend CRUD complet
- frontend Bootstrap 5
- configuration Vite adaptée
- seeders prêts à l’emploi

---

## 📚 Ressources & Documentation

### Laravel
- Documentation officielle : https://laravel.com/docs/12.x  
- Laracasts : https://laracasts.com  
- Forum Laracasts : https://laracasts.com/discuss  

### Packages
- Packagist (PHP) : https://packagist.org  
- NPM Registry : https://www.npmjs.com  

### Communauté
- Laravel News : https://laravel-news.com  
- Laravel Daily : https://laraveldaily.com  

---

## 🚀 Installation Laravel 12

### Création du projet
```bash
composer create-project laravel/laravel cmslarv "12.*"
cd cmslarv
````

### Configuration de l’environnement

```bash
cp .env.example .env
php artisan key:generate
```

Configurer la base de données dans `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_password
```

### Migrations

```bash
php artisan migrate
```

### Serveur de développement

```bash
php artisan serve
```

---

## 📂 Structure d’un projet Laravel 12 vierge

Structure standard Laravel 12 avec :

* `app/` (Models, Controllers, Middleware)
* `database/` (migrations, seeders)
* `resources/` (Blade, JS, CSS)
* `routes/`
* `storage/`
* `public/`

---

## 🎨 Gestion des assets (Vite)

### Dépendances NPM

```bash
npm install
```

### Compilation des assets

```bash
npm run build
```

### Mode développement

```bash
npm run dev
```

---

## ⚙️ Commandes utiles Laravel

```bash
php artisan key:generate
php artisan storage:link

php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

php artisan route:list
```

---

## 📦 Packages Composer

### Production

```bash
composer require barryvdh/laravel-dompdf:^3.1
composer require cviebrock/eloquent-sluggable:^12.0
composer require intervention/image-laravel:^1.5
composer require laracasts/flash:^3.2
composer require laravel/socialite:^5.19
composer require livewire/livewire:^3.4
composer require spatie/laravel-activitylog:^4.10
composer require spatie/laravel-backup:^9.2
composer require spatie/laravel-html:^3.12
composer require spatie/laravel-medialibrary:^11.12
composer require sqids/sqids:^0.5.0
composer require unisharp/laravel-filemanager:^2.0
composer require yajra/laravel-datatables-oracle:^12.0
```

### Développement

```bash
composer require --dev barryvdh/laravel-debugbar:^3.15
composer require --dev laravel/breeze:^2.3
composer require --dev laravel/pail:^1.2
composer require --dev laravel/pint:^1.21
composer require --dev laravel/sail:^1.41
```

---

## 🧩 Dépendances Frontend (NPM)

```bash
npm install --save-dev @coreui/coreui@^5.4.3
npm install --save-dev @fortawesome/fontawesome-free@^6.7.2
npm install --save-dev @popperjs/core@^2.11.8
npm install --save-dev @shufo/prettier-plugin-blade@^1.16.1
npm install --save-dev alpinejs@^3.4.2
npm install --save-dev axios@^1.12.2
npm install --save-dev bootstrap@^5.3.8
npm install --save-dev concurrently@^9.2.1
npm install --save-dev jquery@^3.7.1
npm install --save-dev laravel-mix@^6.0.49
npm install --save-dev prettier@^3.6.2
npm install --save-dev prettier-plugin-blade@^2.1.21
npm install --save-dev resolve-url-loader@^5.0.0
npm install --save-dev sass@^1.92.1
npm install --save-dev sass-loader@^16.0.5
npm install --save-dev simplebar@^6.3.2
```

---

## 🔐 Authentification Breeze (Blade)

```bash
php artisan breeze:install blade
npm install
npm run build
php artisan migrate
```

* Dark mode : ❌ Non
* Tests Pest : ❌ Non

---

## 🗄️ Ordre des migrations principales

```bash
php artisan make:migration create_users_table
php artisan make:migration create_cache_table
php artisan make:migration create_jobs_table
php artisan make:migration add_fields_to_users_table
php artisan make:migration create_roles_table
php artisan make:migration create_permissions_table
php artisan make:migration create_role_user_table
php artisan make:migration create_permission_user_table
php artisan make:migration create_permission_role_table
```

---

## 🧠 Models

```bash
php artisan make:model Role
php artisan make:model Permission
```

---

## 🎮 Controllers

```bash
php artisan make:controller RoleController --resource
php artisan make:controller PermissionController --resource
php artisan make:controller UserController --resource
php artisan make:controller DashboardController
php artisan make:controller ProfileController
php artisan make:controller HomeController
```

Routes configurées dans `routes/web.php`.

---

## 🌱 Seeders

```bash
php artisan make:seeder RoleSeeder
php artisan make:seeder PermissionSeeder
php artisan make:seeder RolePermissionSeeder
php artisan make:seeder UserSeeder
```

`DatabaseSeeder.php` :

```php
RoleSeeder::class,
PermissionSeeder::class,
RolePermissionSeeder::class,
UserSeeder::class,
```

### Exécution

```bash
php artisan db:seed
```

Ou reset complet :

```bash
php artisan migrate:fresh --seed
```

---

## 👤 Comptes de test

| Rôle     | Email                                           | Mot de passe |
| -------- | ----------------------------------------------- | ------------ |
| Admin    | [admin@sport.fr](mailto:admin@sport.fr)         | password     |
| Manager  | [hassan@nataswim.fr](mailto:hassan@nataswim.fr) | password     |
| Editor   | [marie@nataswim.fr](mailto:marie@nataswim.fr)   | password     |
| User MNS | [thomas@athlete.fr](mailto:thomas@athlete.fr)   | password     |
| Agent    | [sophie@agent.fr](mailto:sophie@agent.fr)       | password     |
| Tech     | [julien@tech.fr](mailto:julien@tech.fr)         | password     |
| Amateur  | [lucas@nageur.fr](mailto:lucas@nageur.fr)       | password     |

---

## 🎨 Problème Vite / Tailwind / Bootstrap

### Problème

Laravel Breeze installe Tailwind par défaut, mais l’interface utilise Bootstrap.

### Solution — Configuration Bootstrap

#### Supprimer Tailwind

```bash
rm postcss.config.js
rm tailwind.config.js
```

#### `resources/css/app.css`

```css
@import 'bootstrap/dist/css/bootstrap.min.css';
@import '@fortawesome/fontawesome-free/css/all.min.css';

body {
    font-family: 'Figtree', sans-serif;
}
```

#### `resources/js/app.js`

```js
import './bootstrap';
import 'bootstrap';
```

#### Installer Bootstrap

```bash
npm install bootstrap @fortawesome/fontawesome-free --save
```

#### Recompiler

```bash
rm -rf node_modules/.vite
npm run build
```

---

## 📄 Pagination Bootstrap 5

✔ `Paginator::useBootstrapFive()` dans `AppServiceProvider`
✔ Vue pagination Bootstrap publiée
✔ CSS personnalisé
✔ Assets recompilés

---

## 🎉 Fonctionnalités finales

### Backend

* Base de données relationnelle
* Models : User, Role, Permission
* Seeders : 7 rôles, 32 permissions, 7 utilisateurs
* CRUD complets
* Middleware de permissions
* Authentification Breeze

### Frontend

* Header double niveau
* Footer global
* 15 vues admin
* 5 vues auth
* 5 pages publiques
* Dashboard
* Profil utilisateur
* Bootstrap 5 + Font Awesome
* Pagination corrigée
* Responsive design

---



