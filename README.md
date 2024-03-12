# projet-devweb

## Ouvrir le site web

Pour pouvoir ouvrir le site web (et les pages php) vous devez ouvrir un serveur php.  
Normalement les installations nécessaires sont déjà faites sur vos machines, vous n'avez juste qu'à suivre les instruction suivantes.  
Déplacez vous dans le répertoire qui contient le site web (typiquement `projet-devweb`) et lancez la commande suivante :  
```
php -S localhost:8000
```
La commande va ouvrir un serveur php local sur le port 8000.  
Vous devriez normalement être en mesure de voir tout ce qui se passe aux niveaux des actions php sur la page (ce qui est assez utile si vous avez des problèmes avec la page web).  
Si vous interrompez le serveur, la page web ne fonctionnera plus.  
Pour vous rendre sur la page web, utilisez l'adresse suivante dans votre navigateur :  
```
localhost:8000/index.html
```

## Connexion

Pour réussir à vous connecter, vous devez créer (dans le répertoire du projet) un fichier `temp.csv` qui va servir de base de donnée temporaire en stockant les informations des utilisateurs sous cette forme :  

```
login;mdp;profil;nom;prenom
```

Un exemple que vous pouvez utiliser :  

```
admin;admin;admin;admin;admin
oliviertamon;testmdp;utilisateur;tamon;olivier
llaserathomas;testmdp;abonne;llasera;thomas
```

**Attention**, ne pushez pas le fichier `temp.csv` quand vous voulez commit vos modifications sur Github (n'incluez donc pas le fichier quand vous utilisez git add)  
