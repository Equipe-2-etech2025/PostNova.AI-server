<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# PostNova.AI Server

Serveur backend Laravel pour la plateforme SaaS PostNova.AI - Transformez un simple prompt en campagne de contenu complète avec l'IA.

## 🚀 Fonctionnalités

- **Génération de contenu IA** : Création automatique de scripts pour TikTok, Reels, Shorts
- **Posts sociaux** : Génération de contenu pour LinkedIn et X (Twitter)
- **Landing pages** : Création de pages de destination clé en main
- **Génération vidéo** : Montage automatique avec IA
- **Gestion d'abonnements** : Système SaaS avec Stripe
- **API REST** : Interface complète pour le frontend React

## 🛠️ Technologies

- **Backend** : Laravel 10.x
- **Base de données** : PostgresSQL
- **Authentification** : Laravel Sanctum
- **Paiements** : Stripe
- **IA** : ...
- **Stockage** : Laravel Storage / AWS S3

## 📁 Structure du projet

```
PostNova.AI-server/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── API/           # Contrôleurs API
│   │   ├── Middleware/        # Middlewares personnalisés
│   │   ├── Requests/          # Form requests
│   │   └── Resources/         # API Resources
│   ├── Models/                # Modèles Eloquent
│   ├── Services/              # Services métier
│   │   ├── AI/               # Services IA
│   │   ├── Content/          # Génération de contenu
│   │   ├── SocialMedia/      # Intégrations réseaux sociaux
│   │   └── Video/            # Génération vidéo
│   ├── Jobs/                 # Jobs en arrière-plan
│   ├── Events/               # Événements
│   ├── Listeners/            # Écouteurs d'événements
│   ├── Policies/             # Politiques d'autorisation
│   └── Traits/               # Traits réutilisables
├── database/
│   ├── migrations/           # Migrations de base de données
│   ├── seeders/              # Seeders
│   └── factories/            # Factories pour les tests
├── routes/
│   ├── api.php              # Routes API
│   └── web.php              # Routes web
├── storage/
│   └── app/
│       └── public/
│           ├── campaigns/    # Fichiers de campagnes
│           ├── videos/       # Vidéos générées
│           ├── audio/        # Fichiers audio
│           └── images/       # Images générées
└── tests/                   # Tests automatisés
```

## 🚀 Installation

### Prérequis

- PHP 8.1+
- Composer
- PostgresSQL
- Node.js (pour les assets)

### Installation rapide

```bash
# Cloner le repository
git clone https://github.com/Equipe-2-etech2025/PostNova.AI-server.git
cd PostNova.AI-server

# Installer les dépendances
composer install

# Configuration initiale
composer run setup

# Ou manuellement :
cp .env.example .env
php artisan key:generate
php artisan storage:link
php artisan migrate
```

### Configuration

1. **Base de données** : Configurez vos paramètres PostgresSQL dans `.env`
2. **Services IA** : Ajoutez vos clés API dans `.env`
3. **Stripe** : Configurez vos clés Stripe pour les abonnements
4. **Réseaux sociaux** : Ajoutez les clés API des plateformes sociales

## 🔧 Configuration des services

### Services IA

```env

GEMINI
HUGGING FACE

```

### Stripe (Abonnements)

```env
STRIPE_KEY=pk_test_...
STRIPE_SECRET=sk_test_...
STRIPE_WEBHOOK_SECRET=whsec_...
```

### Réseaux sociaux

```env
# Twitter/X
TWITTER_API_KEY=your_twitter_key
TWITTER_API_SECRET=your_twitter_secret

# LinkedIn
LINKEDIN_CLIENT_ID=your_linkedin_id
LINKEDIN_CLIENT_SECRET=your_linkedin_secret

# TikTok
TIKTOK_CLIENT_KEY=your_tiktok_key
TIKTOK_CLIENT_SECRET=your_tiktok_secret
```

## 📚 API Documentation

### Authentification

```bash
# Inscription
POST /api/auth/register
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password",
  "password_confirmation": "password"
}

# Connexion
POST /api/auth/login
{
  "email": "john@example.com",
  "password": "password"
}
```

### Génération de campagnes

```bash
# Créer une campagne
POST /api/campaigns
Authorization: Bearer {token}
{
  "prompt": "Créer une campagne pour promouvoir une nouvelle app de fitness",
  "platforms": ["tiktok", "linkedin", "twitter", "landing"]
}

# Lister les campagnes
GET /api/campaigns
Authorization: Bearer {token}
```

### Gestion du contenu

```bash
# Voir le contenu d'une campagne
GET /api/contents?campaign_id=1
Authorization: Bearer {token}

# Publier du contenu
POST /api/contents/{id}/publish
Authorization: Bearer {token}
```

## 🧪 Tests

```bash
# Lancer tous les tests
composer test

# Tests avec couverture
php artisan test --coverage
```

## 🚀 Déploiement

### Développement

```bash
# Serveur de développement
php artisan serve

# Avec Sail (Docker)
./vendor/bin/sail up
```

### Production

1. **Serveur** : Configurez Apache/Nginx
2. **Base de données** : PostgresSQL en production
3. **Queue** : Configurez Redis pour les jobs
4. **Stockage** : Utilisez AWS S3 pour les fichiers

```bash
# Optimisations production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

## 📊 Monitoring

Le projet inclut Laravel Telescope pour le monitoring en développement :

```bash
php artisan telescope:install
php artisan migrate
```

Accédez à `/telescope` pour voir les requêtes, jobs, et performances.

## 🔒 Sécurité

- Authentification via Laravel Sanctum
- Validation des données d'entrée
- Protection CSRF
- Rate limiting sur les API
- Chiffrement des données sensibles

## 🤝 Contribution

1. Fork le projet
2. Créez une branche feature (`git checkout -b feature/AmazingFeature`)
3. Committez vos changements (`git commit -m 'Add AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrez une Pull Request

## 🗺️ Roadmap

- [ ] Génération d'images avec Hugging Face
- [ ] Templates personnalisables
- [ ] Analytics avancées
- [ ] Planification de posts
- [ ] Collaboration en équipe
- [ ] API webhooks
- [ ] Intégration Zapier

---

Développé avec ❤️ par l'Équipe 2 - ETech 2025