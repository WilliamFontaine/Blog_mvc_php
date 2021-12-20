# Blog_mvc_php

## Configuration:

* Dans un premier temps, il faut exécuter le fichier `projet_blog.sql` dans wamp/xamp/mamp pour insérer la base de données du blog.  
 
* Dans un second temps, on exécute le fichier `utilisateur.sql` pour ajouter l'utilisateur qui se connecte la base de données. 

* Ensuite, il suffit de lancer wamp/xamp/mamp et de lancer le fichier index.php pour faire fonctionner le site. Ce dernier fonctionne intégralement depuis le fichier index.php grâce au routeur.  


## Différents utilisateurs:  

* Sur le site, il y a différents types d'utilisateurs, on a d'abord les **visiteurs**, les **utilisateurs**, les **écrivains**, les **administrateurs** et les **super-admin**.  

1. Les visiteurs:  
Un visiteur est une personne visitant le site sans se connecter, il peut consulter le site et commenter des articles.  

2. Les utilisateurs:  
Un utilisateur dispose des droits du visiteur, il peut modifier en plus ses identifiants et aussi modifier ses commentaires.  

3. Les écrivains:  
Un écrivain peut en plus écrire des articles, les modifier et les supprimer, mais uniquement les siens.  

4. Les administrateurs:  
Un administrateur peut en plus supprimer tous les articles et commentaires.   
Il peut aussi créer des visiteurs, des utilisateurs, des écrivains et des administrateurs.  

5. Les super-administrateurs:  
Un super-administrateur dispose des mêmes droits qu'un utilisateur et peut aussi créer d'autres super-administrateurs.   
Il ne peut pas supprmier son compte.  


## Identifiants:  

> Utilisateur:  
username: user  
password: user  

> Ecrivain:  
username: ecrivain  
password: ecrivain  

> Admin:  
username: admin  
password: admin  

> Super-admin:  
username: super-admin  
password: super-admin
