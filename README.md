# Blog_MVC_MongoDB

La liste des fonctionnalités réalisées :

* Inscription (vérification que pseudo unique, hashage des mots de passe)
* Connexion
* Rédaction d'un article (Titre, sous-titre, contenu)
* Affichage de tous les articles écrits par les utilisateurs
* Pour chaque article, on peut commenter et répondre à un commentaire, et ce, de manière récursive (sans fin)
* Ajout d'un What You see Is What You Get (WYSIWYG) Permettant de donner du 'style' au message du blog


Remarques :

Pour lancer la base de données, mettez vous à la racine du projet (dans le dossier blog), et lancez cette commande : 

'mongod --dbpath data/db' (linux/macOS)
'mongod.exe --dbpath data\db' (windows)


Une base de données pré-rempli sera prise en compte.

Les utilisateurs "Raimy", "BastienLcs" et "PatrickNollet" sont déjà créés, le mot de passe est le même pour les 3 comptes: c'est "popo".

Les fichiers sources se trouvent dans le dossier 'app'.


Si jamais la base de données ne fonctionne pas pour X ou Y raison: voici la structure a reproduire :

dbname : 'blog'
collections : 'articles', 'commentaires', 'users'
