# Pour développer une fonctionnalité,

## Comment procéder (workflow)

1. Créer une nouvelle branche (brouillon)
    - ```git branch nom-de-la-branche```

2. Se positionner sur la branche
    - ```git switch nom-de-la-branche```

3. Développer la fonctionnalité


## Comment livrer notre code après avoir développé une fonctionnalité?

1. Vérifier la syntaxe du code
    - ```php vendor/bin/php-cs-fixer fix src```

2. Vérifier la logique
    - ```php vendor/bin/phpstan analyse```
    - Ignorer les erreurs qui en réalité ne le sont pas, dans le fichier de configuration de php stan
        - ```
            parameters:
                level: 6
                paths:
                    - src/
                    - tests/
                ignoreErrors:
                    - '#Call to function method_exists\(\) with .*Symfony\\\\Component\\\\Dotenv\\\\Dotenv.*bootEnv.*will always evaluate to true#'
                    - '#Property App\\Entity\\User::\$id \(int\|null\) is never assigned int so it can be removed from the property type#'```

3. Vérifier les linters
    - ```symfony console lint:twig```
    - ```symfony console lint:container```
    - ```symfony console lint:yaml config```

4. Sauvegarder et envoyer le code sur GitHub
    - Ajouter le code dans la zone de transit
        - ```git add .```
    - Sauvegarder l'application
        - ```git commit -m "Message du commit"```
    - Envoyer le code sur la branche créée
        - ```git push --set-upstream origin nom-de-la-branche```
    - Proposer ce code pour la fusion 
        - (Pull Request)
    - Après la revue de code, fusionner le brouillon (branche) au main 
        - (Merge Request) 
    - En local,
        - Switcher sur la branche `main`
        - Le mettre à jour cette branche: `git pull origin main`

# Projet de Blog avec Symfony

## Procédure de récupération du projet

### 1. Vérifier les outils dans votre terminal
- Une version de PHP >= 8.2 ```php -v```
- Composer, le gestionnaire de paquet ```composer -v```
- Symfont CLI, le client de symfony ```symfony -v```
- Symfont CLI, le client de symfony ```node -v```
- Symfont CLI, le client de symfony ```npm -v```

### 2. Clone le repository
- En local sur votre machine
    - ```git clone https://github.com/jc-aziaha/dwwm22-symfony-blog.git```

### 3. Installation des dépendances necessaires
- Installer les dépendances de php
    - ```composer install```
- Installer les dépendances de javascript
    - ```npm install```
    - ```npm run dev``` ou ```npm run watch```

### 4. Création du .env.dev.local
- ```symfony console app:generate-local-secret-key```
- Si vous souhaitez changer de fuseau horaire, 
    - Rajouter au .env.dev.local ```APP_TIME_ZONE="..."```
- Rajouter les autres variables d'environnement en s'inspirant du .env
- Configurer le ````MAILER_DSN=...``` pour l'envoi d'email

### 5. Préparer la base de données
- ```DATABASE_URL=...```
- ```symfony console doctrine:database:create```
- ```symfony console doctrine:migrations:migrate```


### 6. Démarrer le serveur
- ```symfony server:start```

<!-- End -->