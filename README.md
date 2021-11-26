# PROJET-PHP
Ceci est un repo gitHub visant à faciliter le travail autour d'un projet universitaire de création de site avec PHP.

### Sujet du site: Vente de répliques (Air-soft/Paintball/Nerf...)

[Critères de notation](https://docs.google.com/spreadsheets/d/1oUd7fe0K8WZhI2TPRRvgZ2xPZf5H22CUvlpcXEMD3Ao/edit#gid=0)

- Afficher les critères
    
    ### Front-office
    
    - [ ]  HTML/CSS valide
    - [ ]  Formulaires (create, update ...) : Sécurité (vérification des données (ex email) côté client & serveur) + En cas d'erreur, on revient sur le formulaire prérempli avec les mauvaises données
    - [ ]  Inscription :Par adresse mail et activation du compte par mail
    
    ### Back-office
    
    - [ ]  Sessions : Sécurisation toutes les pages pour l'utilisateur et l'admin
    - [ ]  CRUD : Create / read/ readall / update / delete
    - [ ]  Modèle générique : Fonctions générique : select, delete, create/save, update
    - [ ]  Routeur : Contrôleur + action par défaut + Gestion des cas d'erreurs (action/contrôleur inexistant)
    - [ ]  MVC : MVC pour chaque controlleur + vue générique view.php + vue commune pour update et create
    - [ ]  Sécurité : Mot de passe chiffré dans la BD et résistant aux attaques par dictionnaire
    - [ ]  Portabilité du site : Chemin de fichier absolu & URL relatives
    - [ ]  Echappement des vues : échappement URL + HTML
    - [ ]  SQL : Requete preparee PDO +  Contrainte de cle etrangere
    
    ### Autre
    
    - [ ]  Historique des commandes : table d'association, requête avec jointures, plusieurs produits par commande
    - [ ]  Panier courant :  Panier dans les cookies/sessions avec quantité pour les produits + Panier possible pour un visiteur non identifié
    - [ ]  Démo : Impression générale, BDD préparée avec des utilisateurs admin/ pas admin, des produits, des commandes
    
    ### Non noté
    
    - [ ]  try/catch autour du code PDO
    - [ ]  cookie session pas accessible depuis autre site sur infolimon
