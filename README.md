Ressources & Documentation
Laravel

Documentation : https://laravel.com/docs/12.x
Laracasts : https://laracasts.com
Forums : https://laracasts.com/discuss

Packages

Packagist (PHP) : https://packagist.org
NPM Registry : https://www.npmjs.com

Communauté

Laravel News : https://laravel-news.com
Laravel Daily : https://laraveldaily.com


# Installation Laravel 12
composer create-project laravel/laravel cmslarv "12.*"
cd cmslarv


# Configurer l'environnement
cp .env.example .env
php artisan key:generate

# Configurer la base de données dans .env
# DB_CONNECTION=mysql 


# migrations
php artisan migrate

# serveur de développement
php artisan serve


###  Structure d'un projet Laravel 12 vierge


# dépendances NPM
npm install

# Compile les assets
npm run build

# serveur de développement avec Vite
npm run dev

# clé d'application
php artisan key:generate

# lien symbolique pour le storage
php artisan storage:link

# Vide cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# routes disponibles
php artisan route:list


# Packages de production
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

# Packages de développement
composer require --dev barryvdh/laravel-debugbar:^3.15
composer require --dev laravel/breeze:^2.3
composer require --dev laravel/pail:^1.2
composer require --dev laravel/pint:^1.21
composer require --dev laravel/sail:^1.41


# Dépendances de développement
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





# Installer Breeze
php artisan breeze:install blade

# Publier les migrations
npm install && npm run build
php artisan migrate




# Ordre des tables Migration
php artisan make:migration create_users_table.php
php artisan make:migration reate_cache_table.php
php artisan make:migration create_jobs_table.php
php artisan make:migration add_fields_to_users_table.php
php artisan make:migration create_roles_table.php
php artisan make:migration create_permissions_table.php
php artisan make:migration create_role_user_table.php
php artisan make:migration create_permission_user_table.php
php artisan make:migration create_permission_role_table.php




# Creation Models
php artisan make:model Role
php artisan make:model Permission


# 1. Installer Breeze avec Blade
php artisan breeze:install blade

# 2. Installer les dépendances NPM
npm install

# 3. Compiler les assets
npm run build

# 4. Exécuter les migrations Breeze (si nécessaire)
php artisan migrate

Dark mode support ? No
Pest tests ? No (ou Yes selon préférence)

# Creation Controllers
php artisan make:controller RoleController --resource
php artisan make:controller PermissionController --resource
php artisan make:controller UserController --resource
php artisan make:controller DashboardController
php artisan make:controller ProfileController
php artisan make:controller HomeController

Mise à jour du contenu de routes/web.php


php artisan make:seeder RoleSeeder
php artisan make:seeder PermissionSeeder
php artisan make:seeder RolePermissionSeeder
php artisan make:seeder UserSeeder

Modification DatabaseSeeder.php avec ( RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,)




# Exécution  des seeders
php artisan db:seed

# OU tout réinitialiser et re-seeder
php artisan migrate:fresh --seed


Les comptes créés :

admin@sport.fr / password (Admin)
hassan@nataswim.fr / password (Manager)
marie@nataswim.fr / password (Editor)
thomas@athlete.fr / password (User MNS)
sophie@agent.fr / password (Agent)
julien@tech.fr / password (Tech)
lucas@nageur.fr / password (Amateur)



# Cre&tion pages




# #  Problème : Configuration Vite/Tailwind vs Bootstrap
Explication : Laravel Breeze installe par défaut Tailwind CSS, mais nous avons créé toutes nos vues avec Bootstrap. Vite essaie de charger Tailwind qui n'est pas correctement configuré.
Solution : Configurer pour Bootstrap
# Étape 1 : Supprimer la config Tailwind
Supprimer le fichier : postcss.config.js
bashrm postcss.config.js
Supprimer le fichier : tailwind.config.js
bashrm tailwind.config.js
# Étape 2 : Modifier resources/css/app.css
Remplacer le contenu de resources/css/app.css :
/* Bootstrap */
@import 'bootstrap/dist/css/bootstrap.min.css';

/* Font Awesome */
@import '@fortawesome/fontawesome-free/css/all.min.css';

/* Styles personnalisés */
body {
    font-family: 'Figtree', sans-serif;
}

.bg-primary-subtle {
    background-color: rgba(13, 110, 253, 0.1) !important;
}

.bg-success-subtle {
    background-color: rgba(25, 135, 84, 0.1) !important;
}

.bg-info-subtle {
    background-color: rgba(13, 202, 240, 0.1) !important;
}

.bg-warning-subtle {
    background-color: rgba(255, 193, 7, 0.1) !important;
}

.bg-danger-subtle {
    background-color: rgba(220, 53, 69, 0.1) !important;
}

.bg-secondary-subtle {
    background-color: rgba(108, 117, 125, 0.1) !important;
}

.text-primary-subtle {
    color: #0d6efd !important;
}

.text-success-subtle {
    color: #198754 !important;
}

.text-info-subtle {
    color: #0dcaf0 !important;
}

.text-warning-subtle {
    color: #ffc107 !important;
}

.text-danger-subtle {
    color: #dc3545 !important;
}

.text-secondary-subtle {
    color: #6c757d !important;
}

# Étape 3 : Modifier resources/js/app.js
Remplacer le contenu de resources/js/app.js :
jsimport './bootstrap';
import 'bootstrap';
# Étape 4 : Installer Bootstrap
bashnpm install bootstrap @fortawesome/fontawesome-free --save
# Étape 5 : Recompiler
bash# Nettoyer le cache
rm -rf node_modules/.vite

# Recompiler
npm run build

# Ou pour le mode développement
npm run dev



Récapitulatif de la solution pour la pagination

✅ Ajout de Paginator::useBootstrapFive(); dans AppServiceProvider
✅ Publication et personnalisation de la vue Bootstrap 5
✅ Ajout des styles CSS personnalisés
✅ Compilation des assets avec npm run build


🎉 application CMS Laravel 12 avec
Backend

✅ Base de données (migrations, relations)
✅ Models (User, Role, Permission)
✅ Seeders (7 rôles, 32 permissions, 7 utilisateurs)
✅ Controllers CRUD complets
✅ Middleware de permissions
✅ Système d'authentification Breeze

Frontend

✅ Layout avec Header à 2 niveaux (navigation globale + contextuelle)
✅ Footer général
✅ 15 vues admin (users, roles, permissions)
✅ 5 vues authentification (login, register, forgot, reset, verify)
✅ 5 pages publiques (home, about, contact, privacy, terms)
✅ Page profil utilisateur
✅ Dashboard
✅ Design Bootstrap 5 + Font Awesome
✅ Pagination Bootstrap 5 corrigée
✅ Responsive design

