# Lancement Local

Le projet peut maintenant tourner en local avec une configuration dédiée dans `includes/config.local.php`.

## Ce qui est déjà prêt

- `includes/config.php` charge automatiquement `includes/config.local.php` si le fichier existe.
- `includes/config.local.php` est déjà créé pour un setup WAMP/MariaDB local classique.
- En local, les pages publiques peuvent s'ouvrir même si la base n'est pas encore prête.
- Les zones admin et l'envoi du formulaire de contact continuent, eux, d'exiger une base fonctionnelle.

## Réglages locaux

Le fichier `includes/config.local.php` contient par défaut :

```php
return [
    'db_host' => '127.0.0.1',
    'db_port' => '3307',
    'db_name' => 'horo6346_robin_portfolio',
    'db_user' => 'root',
    'db_pass' => '',
    'site_url' => 'http://127.0.0.1:8080/',
    'cookie_secure' => false,
    'allow_local_without_db' => true,
];
```

Si tu utilises MySQL local sur le port standard, remplace simplement `3307` par `3306`.

## Base de données

1. Crée une base nommée `horo6346_robin_portfolio`.
2. Importe le fichier `database.sql`.
3. Connecte-toi à l'admin avec :

```text
Identifiant : admin
Mot de passe : admin123
```

## Lancer le site

Depuis la racine du projet :

```powershell
php -S 127.0.0.1:8080 -t public
```

Puis ouvre :

```text
http://127.0.0.1:8080
```

## Notes utiles

- Si la base n'est pas prête, `index.php`, `about.php` et le reste du front public s'ouvrent quand même pour du test visuel.
- `projects.php` affichera simplement une liste vide sans base.
- `admin/login.php` affichera une erreur claire tant que la base n'est pas disponible.
