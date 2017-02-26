# Installation des dépendances

Pour installer les dépendances, vous devez installer yarn (https://yarnpkg.com/en/docs/install)

Utiliser ensuite la commande 'yarn install'.

# Documentation technique

Cette partie a été créée en utilisant le packet npm "create-react-app", pour mieux comprendre l'organisation des dossiers, vous pouvez vous référer à la documentation officielle : https://github.com/facebookincubator/create-react-app

Le code source de l'application est situé dans le dossier src.
Il se décompose de la manière suivante:

src/
  - actions/
      element.js
      index.js
  - components/
      - App/
      - BlackCircle/
      - Circle/
      - Factory/
      - Form/
      - iRectangle/
      - Node/
      - Rectangle/
      - Svg/
      - Text/
  - reducers/
      element.js
      index.js
  index.css
  index.js

Cette partie utilise entre autre les technologies react.js et redux.js pour fonctionner (vous trouverez le reste des dépendances dans le fichier package.json à la racine).
Pour comprendre ce code il est important d'acquérir les compétences minimum des technologies react et redux.

Le fichier index.js à la racine du dossier src est le fichier principale.
C'est lui qui inclut le reste des fichiers (via l'instruction import définie à partir de la version es6 de javascript).

Le dossier reducers contient comme son nom l'indique les reducers de redux utilisés dans cette application.
Le dossier actions contient quand à lui les actions utilisées pour l'application.
Le dossier components contient l'ensemble des composants react utilisés.

Vous pouvez tester cette partie de l'application en utilisant la commande 'npm start'.
Pour créer des fichiers javascript et css minifier, vous pouvez utiliser la commande 'npm run build'.
Vous devez ensuite récupérer le contenu des fichiers dans build/static/js/ et build/static/css/ et le copier dans :
/src/HillsModeling/FrontEndBundle/Resources/public/js/transitions.js et /src/HillsModeling/FrontEndBundle/Resources/public/css/transitions.css

