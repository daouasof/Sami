# Sami - Exercice de refactoring

## Énoncé

Ce projet Symfony met à disposition une route d'API permettant d'estimer les émissions
de gaz à effet de serre pour une série de trajets effectués en voiture, en TGV ou en
avion.

Le calcul se fait en multipliant une donnée d'activité (ici, la distance parcourue, en
kilomètres) et un facteur d'émission (parfois abrégé "FE") qui varie selon le mode de
transport. Le résultat s'exprime en équivalent CO2 (kgCO2e).

Pour l'avion, le facteur d'émission dépend de la longueur du trajet (un vol
long-courrier consommera en moyenne moins de carburant au kilomètre). Pour la voiture,
il dépend du type de carburant et de la consommation du véhicule. Le calcul tient aussi
compte du nombre de passagers et de la distance totale (aller simple ou aller-retour).

La route d'API est définie dans le fichier `src/Controller/ApiController.php` et permet
déjà de calculer le total des émissions de CO2 pour une liste de trajets. Néanmoins, le
code n'est pas maintenable en l'état et nécessiterait un bon refactoring.

Par ailleurs, cette API doit évoluer pour pouvoir retourner, en plus des émissions
totales :
1. la distance totale parcourue ;
2. les émissions de CO2 et la distance parcourue pour chaque mode de transport.

L'API est accompagnée d'un test fonctionnel (`tests/Controller/ApiControllerTest.php')
qui couvre ces 3 fonctionnalités (calcul des émissions totales, calcul de la distance
totale, calcul des émissions et distance par mode de transport).

Le premier scénario de test passe mais les deux autres échouent.

## Objectif

L'objectif de cet exercice est double :

1. refactorer le fichier `ApiController.php` afin de gagner en lisibilité et mieux
   rendre compte de l'énoncé "métier" ci-dessus.

2. faire passer au vert les deux scénarios de test qui échouent actuellement.

## Consignes

Plus qu'une démonstration technique, c'est la démarche qui importe. Aussi, il est
conseillé de refactorer pas à pas, et idéalement en faisant en sorte que l'historique
git rende compte des améliorations progressives et de la démarche générale.

Notes importantes :
  - il n'y a pas de bug caché (ou alors ce n'est pas volontaire) ;
  - les scénarios de test n'ont pas à être modifiés ;
  - il n'y a pas d'autre contrainte particulière : il est possible de créer d'autres
    fichiers, d'ajouter des librairies tierces, etc.

## Initialisation et lancement des tests

### Avec make (recommandé)

```sh
# installation des dépendances
make install

# lancement des tests
make test
```

### Avec composer et phpunit

```sh
# installation des dépendances
composer install

# lancement des tests
./bin/phpunit --testdox
```
