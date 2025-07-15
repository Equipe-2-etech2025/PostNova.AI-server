# API d'Authentification PostNova.AI

## Endpoints d'authentification

### Inscription
```http
POST /api/auth/register
Content-Type: application/json

{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

**Réponse de succès (201):**
```json
{
    "success": true,
    "message": "Inscription réussie. Veuillez vérifier votre email.",
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "role": "user",
            "initials": "JD",
            "avatar_url": "https://ui-avatars.com/api/?name=John+Doe&color=7F9CF5&background=EBF4FF",
            "email_verified_at": null,
            "created_at": "2024-01-01T00:00:00.000000Z",
            "updated_at": "2024-01-01T00:00:00.000000Z"
        },
        "token": "1|abcdef123456...",
        "token_type": "Bearer"
    }
}
```

### Connexion
```http
POST /api/auth/login
Content-Type: application/json

{
    "email": "john@example.com",
    "password": "password123",
    "remember": true
}
```

**Réponse de succès (200):**
```json
{
    "success": true,
    "message": "Connexion réussie.",
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "role": "user",
            "initials": "JD",
            "avatar_url": "https://ui-avatars.com/api/?name=John+Doe&color=7F9CF5&background=EBF4FF",
            "email_verified_at": "2024-01-01T00:00:00.000000Z",
            "created_at": "2024-01-01T00:00:00.000000Z",
            "updated_at": "2024-01-01T00:00:00.000000Z"
        },
        "token": "1|abcdef123456...",
        "token_type": "Bearer"
    }
}
```

### Déconnexion
```http
POST /api/auth/logout
Authorization: Bearer {token}
```

**Réponse de succès (200):**
```json
{
    "success": true,
    "message": "Déconnexion réussie."
}
```

### Profil utilisateur
```http
GET /api/auth/me
Authorization: Bearer {token}
```

**Réponse de succès (200):**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "role": "user",
        "initials": "JD",
        "avatar_url": "https://ui-avatars.com/api/?name=John+Doe&color=7F9CF5&background=EBF4FF",
        "email_verified_at": "2024-01-01T00:00:00.000000Z",
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
    }
}
```

### Rafraîchir le token
```http
POST /api/auth/refresh
Authorization: Bearer {token}
```

**Réponse de succès (200):**
```json
{
    "success": true,
    "message": "Token rafraîchi avec succès.",
    "data": {
        "token": "2|newtoken123456...",
        "token_type": "Bearer"
    }
}
```

## Réinitialisation de mot de passe

### Demander un lien de réinitialisation
```http
POST /api/auth/forgot-password
Content-Type: application/json

{
    "email": "john@example.com"
}
```

**Réponse de succès (200):**
```json
{
    "success": true,
    "message": "Lien de réinitialisation envoyé par email."
}
```

### Réinitialiser le mot de passe
```http
POST /api/auth/reset-password
Content-Type: application/json

{
    "token": "reset_token_here",
    "email": "john@example.com",
    "password": "newpassword123",
    "password_confirmation": "newpassword123"
}
```

**Réponse de succès (200):**
```json
{
    "success": true,
    "message": "Mot de passe réinitialisé avec succès."
}
```

## Vérification d'email

### Renvoyer l'email de vérification
```http
POST /api/auth/email/verification-notification
Authorization: Bearer {token}
```

**Réponse de succès (200):**
```json
{
    "success": true,
    "message": "Email de vérification envoyé."
}
```

### Vérifier l'email
```http
POST /api/auth/email/verify/{id}/{hash}
Authorization: Bearer {token}
```

**Réponse de succès (200):**
```json
{
    "success": true,
    "message": "Email vérifié avec succès."
}
```

## Gestion des utilisateurs (Admin uniquement)

### Lister les utilisateurs
```http
GET /api/users?search=john&role=user&verified=true&sort_by=created_at&sort_order=desc&per_page=15
Authorization: Bearer {admin_token}
```

### Créer un utilisateur
```http
POST /api/users
Authorization: Bearer {admin_token}
Content-Type: application/json

{
    "name": "Jane Doe",
    "email": "jane@example.com",
    "password": "password123",
    "role": "user"
}
```

### Voir un utilisateur
```http
GET /api/users/{id}
Authorization: Bearer {admin_token}
```

### Mettre à jour un utilisateur
```http
PUT /api/users/{id}
Authorization: Bearer {admin_token}
Content-Type: application/json

{
    "name": "Jane Smith",
    "email": "jane.smith@example.com",
    "role": "admin"
}
```

### Supprimer un utilisateur
```http
DELETE /api/users/{id}
Authorization: Bearer {admin_token}
```

## Codes d'erreur

- **400**: Requête invalide
- **401**: Non authentifié
- **403**: Accès interdit
- **404**: Ressource non trouvée
- **422**: Erreurs de validation
- **500**: Erreur serveur

## Rôles utilisateur

- **user**: Utilisateur standard
- **admin**: Administrateur