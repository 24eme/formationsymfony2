# Formation Symfony 2

## Présentation de la partie théorique

Récupérer le projet via GIT

    git clone https://github.com/24eme/formationsymfony2.git

Ouvrir dans son navigateur la page          

    formationsymfony2/presentation/index.html

## Déployer le projet sur les postes via Ansible

[Déployer via ansible](ansible)

## Installation manuel du projet/TP symfony

Récupérer le projet via GIT

    git clone https://github.com/24eme/formationsymfony2.git

Aller dans le répértoire de symfony

    cd formationsymfony2/symfony

Installation des librairies via composer (https://getcomposer.org/download/)

    composer install

Lors du "composer install" les paramètres de connexion à la base de donnée seront demandées et seront enregistré dans le fichiers

    cat app/config/parameters.yml

Initialiser les données de BDD préchargés (la liste des matchs)

    php app/console doctrine:fixtures:load

Le projet peut être lancé via le serveur web php :

    php app/console server:start

Il sera accessible via l'adresse http://localhost:8000

Pour une utilisation avec Apache configurer les droits d'accès aux dossiers cache et log

    HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
    sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var
    sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var

## Projets / TP terminées :

### Session Juin 2016

- Formateur (Vincent) : https://github.com/24eme/formationsymfony2/tree/formateur
- Didier : https://github.com/24eme/formationsymfony2/tree/201606_didier
- Loic : https://github.com/24eme/formationsymfony2/tree/201606_loic
- Mohan : https://github.com/24eme/formationsymfony2/tree/201606_mohan
- Sylvia : https://github.com/24eme/formationsymfony2/tree/201606_sylvia
