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

La connexion s'effectue par une requête à une base de donnée MySQL. Pour cela, il va falloir d'abord créer un nouveau profil MySQL puis charger la base de donnée.  

### Création du profil

Tout d'abord il vous faut vous connecter à MySQL, soit avec le profil root :  

```
$ sudo mysql -u root -p
```

Ou avec le profil que vous aviez défini en cours de BDD, en ce qui me concerne la commande était la suivante :  

```
$ sudo mysql -u thomas -p
```

Une fois connecté dans MySQL, utilisez **EXACTEMENT** les commandes suivantes :  

```
CREATE USER 'devweb'@'localhost' IDENTIFIED BY '$iteDeR3nc0ntre';
GRANT ALL PRIVILEGES ON *.* TO 'devweb'@'localhost';
```

Une fois cela fait, quittez le profil courant et relancez MySQL en utilisant le profil nouvellement créé :  

```
$ mysql -u devweb -p
```

Le mot de passe de ce profil est : `$iteDeR3nc0ntre`  
Une fois la connexion effectuée, utiliser la requête suivante :  

```
source rencontre.sql;
```

### Utilisation de la BDD

Le site web va se connecter automatiquement à la base de donnée pour effectuer des requêtes, de ce côté vous n'avez rien à faire.  
Si vous avez besoin de faire des modifications sur les données de la BDD, merci de le faire en écrivant une requête dans le fichier `rencontre.sql`.  
Aussi si vous faites une modification à la BDD, merci de le signaler aux autres afin que l'on puisse mettre à jour la BDD.  
Pour mettre à jour la BDD, connectez vous à MySQL en utilisant le profil `devweb` et utilisez la requête `source rencontre.sql;`.  
