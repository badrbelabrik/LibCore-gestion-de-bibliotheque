# 📚 LibCore - Système de Gestion de Bibliothèque

## 📖 Description du Projet

LibCore est une application console développée en PHP orienté objet avec MySQL permettant la gestion d’une bibliothèque.

Le système est composé de deux espaces principaux :

* 👨‍💼 Dashboard Bibliothécaire
* 👨‍🎓 Dashboard Membre

L’objectif principal est de faciliter :

* la gestion des livres,
* la gestion des membres,
* le suivi des emprunts et des retours,
* ainsi que la disponibilité des ouvrages.

---

# 🏗️ Architecture du Projet

```bash
LibCore/
│
├── src/
│   ├── Entities/
│   │   ├── User.php
│   │   ├── Member.php
│   │   ├── Librarian.php
│   │   └── Book.php
│   │
│   └── Services/
│       ├── Connection.php
│       └── Library.php
│
├── docs/
│   ├── use-case.png
│   ├── class-diagram.png
│   └── er-diagram.png
│
├── mainAdmin.php
├── mainMember.php
├── README.md
└── .gitignore
```

---

# ⚙️ Technologies Utilisées

* PHP 8
* MySQL
* PDO
* PhpMyAdmin
* Git & GitHub
* UML

---

# 🧠 Concepts POO Utilisés

## 🔹 Encapsulation

Toutes les propriétés des classes sont définies en `private` avec utilisation des Getters et Setters.

## 🔹 Héritage

Les classes :

* `Member`
* `Librarian`

héritent de la classe mère `User`.

## 🔹 Composition

La classe `Library` contient et gère :

* les livres,
* les membres,
* les emprunts.

## 🔹 Séparation des responsabilités

* `Entities` → représentent les données.
* `Services` → contiennent la logique métier et l’accès à la base de données.

---

# 👨‍💼 Fonctionnalités Bibliothécaire

Le bibliothécaire peut :

✅ Ajouter un livre
✅ Afficher tous les livres
✅ Changer le statut d’un livre
✅ Supprimer un livre
✅ Ajouter des membres

---

# 👨‍🎓 Fonctionnalités Membre

Le membre peut :

✅ Se connecter avec son nom et email
✅ Rechercher un livre par titre
✅ Emprunter un livre disponible
✅ Retourner un livre
✅ Voir la liste de ses livres empruntés

---

# 🗄️ Base de Données

## Tables principales

### 📘 books

Contient les informations des livres.

### 👤 members

Contient les informations des membres.

### 👨‍💼 librarians

Contient les informations des bibliothécaires.

### 🔁 borrows

Gère les emprunts et retours des livres.

### 🛡️ roles

Contient les rôles des utilisateurs.

---

# 🔗 Relations Base de Données

* Un membre peut emprunter plusieurs livres.
* Un livre peut être emprunté plusieurs fois.
* Les relations sont gérées avec des clés étrangères (Foreign Keys).

---

# 🔐 Authentification

Le système contient un login simple pour les membres via :

* nom,
* email.

Une vérification est effectuée dans la base de données avant l’accès au dashboard membre.

---

# ▶️ Lancer le Projet

## 1️⃣ Créer la base de données

Importer le script SQL dans PhpMyAdmin.

## 2️⃣ Configurer la connexion

Modifier les informations dans :

```php
src/Services/Connection.php
```

## 3️⃣ Exécuter le projet

Pour le dashboard membre :

```bash
php mainMember.php
```

Pour le dashboard administrateur :

```bash
php mainAdmin.php
```

---

# 📌 User Stories Implémentées

## 📚 Bibliothécaire

* Gestion des livres
* Gestion des membres
* Gestion des statuts

## 👨‍🎓 Membre

* Recherche de livres
* Emprunt
* Retour
* Suivi personnel

---




# 👥 Réalisé Par

Projet réalisé dans le cadre d’un projet académique en développement web et mobile.
