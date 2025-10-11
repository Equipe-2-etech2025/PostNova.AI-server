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

# Migration des données
php artisan db:seed
```
### Installation avec Docker

```bash
# Cloner le repository
git clone https://github.com/Equipe-2-etech2025/PostNova.AI-server.git
cd PostNova.AI-server

# Configuration d'environement
cp .env.example .env

# Construction des images docker
make build 

# Lance les conteneurs
make up

# Migration
make artisan
make migrate

# Creation de Network
make network

# Permission et creation de stockage cache (linux)
make storage

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

Vous pouvez consulter la documentation interactive de l'API via Swagger UI :  
[PostNova.AI API Docs](https://petstore.swagger.io/?url=https://raw.githubusercontent.com/Equipe-2-etech2025/PostNova.AI-server/refs/heads/dev/docs/api-docs.yaml)

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
php artisan telescope:installr
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
