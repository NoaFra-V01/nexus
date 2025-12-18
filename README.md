# 🚀 Nexus - Système de Gestion de Tickets

Nexus est une application web de **gestion de support client (Ticketing)** développée avec le framework **Symfony 7**.
Ce projet a été réalisé dans le cadre d'un apprentissage approfondi de l'architecture MVC, de la sécurité et des services Symfony.

## ✨ Fonctionnalités

### 👤 Partie Utilisateur
* **Authentification complète :** Système de Connexion / Déconnexion sécurisé.
* **Tableau de bord :** Visualisation de la liste des tickets avec indicateurs visuels d'état (Ouvert/Terminé).
* **Création de tickets :** Formulaire sécurisé accessible uniquement aux utilisateurs connectés.
* **Modification :** Édition des tickets existants.
* **Feedback :** Notifications flash (messages de succès) après chaque action importante.

### ⚙️ Backend & Logique
* **Service Mailer Automatisé :** Envoi automatique d'un email à l'administrateur dès la création d'un nouveau ticket.
* **Sécurité (Vigile) :** Protection des routes sensibles via `Access Control` et attributs `#[IsGranted]`.
* **Données de test (Fixtures) :** Génération automatique d'un jeu de données (Utilisateurs et Tickets) pour le développement.
* **Design Responsive :** Interface moderne utilisant **Bootstrap 5**.

---

## 🛠️ Stack Technique

* **Langage :** PHP 8.2+
* **Framework :** Symfony 7
* **Base de données :** MySQL (via Doctrine ORM)
* **Moteur de template :** Twig
* **Frontend :** Bootstrap 5 (CDN)
* **Outils :** Symfony CLI, Composer, Maker Bundle

---

## 🚀 Installation et Démarrage

Suivez ces étapes pour lancer le projet en local :

### 1. Prérequis
Assurez-vous d'avoir installé :
* PHP 8.2 ou supérieur
* Composer
* Symfony CLI
* Un serveur MySQL (WAMP, XAMPP, ou Docker)

### 2. Cloner le projet
```bash
git clone [https://github.com/VOTRE_PSEUDO/nexus.git](https://github.com/VOTRE_PSEUDO/nexus.git)
cd nexus
