# ⚡ COMMANDES GITHUB

**Copier-coller ces commandes dans l'ordre**

---

## 📍 ÉTAPE 1 : CONFIGURER GIT (PREMIÈRE FOIS SEULEMENT)

```bash
git config --global user.name "xxcxcxcx"
git config --global user.email "votre.email@example.com"
```

---

## 📍 ÉTAPE 2 : PRÉPARER LE PROJET

```bash
# Aller dans le projet
cd ~/Sites/digital-sos  # ← ADAPTER VOTRE CHEMIN

# Créer .env.example (si n'existe pas)
cp .env .env.example

# Vérifier .gitignore contient .env
cat .gitignore | grep "\.env"
```

**⚠️ IMPORTANT :** Éditer `.env.example` pour retirer DB_PASSWORD, JWT_SECRET, etc.

---

## 📍 ÉTAPE 3 : CRÉER LE DÉPÔT GITHUB

**Sur GitHub.com (interface web) :**

1. Cliquer `+` → `New repository`
2. Nom : `digital-sos`
3. Description : `Digital’SOS (Digital Sport Organisation System) est la plateforme tout-en-un`
4. Public ou Private
5. **NE PAS** cocher "Add a README"
6. **NE PAS** cocher "Add .gitignore"
7. Créer → **COPIER L'URL** du dépôt

---

## 📍 ÉTAPE 4 : COMMANDS GIT (TERMINAL)

```bash
# Init Git
git init

# Premier commit
git add .
git commit -m "Initial commit:  Laravel 12 with API"

# Ajouter remote GitHub
git remote add origin https://xxxxxx
# ↑ REMPLACER VOTRE_USERNAME !

# Renommer branche
git branch -M main

# Push vers GitHub
git push -u origin main
```

**🔐 Authentification :**
- Username : Votre username GitHub
- Password : **Token personnel** (pas votre mot de passe !)

---

## 🎯 CRÉER UN TOKEN GITHUB

**Si demandé lors du push :**

1. GitHub.com → Settings
2. Developer settings
3. Personal access tokens → Tokens (classic)
4. Generate new token (classic)
5. Nom : `digis`
6. Cocher : `repo` (toutes les sous-cases)
7. Generate → **COPIER LE TOKEN**
8. Utiliser le token comme mot de passe lors du push

---

## ✅ VÉRIFICATION

```bash
# Vérifier remote
git remote -v

# Voir les commits
git log --oneline

# Voir la branche actuelle
git branch
```

**Sur GitHub :** Aller sur `https://github.com/VOTRE_USERNAME/sos`

---

## 🔄 FUTURES MODIFICATIONS

```bash
# 1. Modifier vos fichiers

git status
git add .
git commit -m "Description de vos changements"
git push



---

## 🚀 WORKFLOW COMPLET (TOUTES LES COMMANDES)

```bash
# ============================================
# COPIER-COLLER TOUTES CES COMMANDES
# ============================================

# 1. Aller dans le projet
cd ~/Sites/digital-sos  # ← ADAPTER

# 2. Vérifier qu'on est au bon endroit
pwd
ls | grep artisan

# 3. Init Git
git init

# 4. Commit
git add .
git commit -m "Initial commit: SportCMS Laravel 12 with API"

# 5. Ajouter remote (REMPLACER VOTRE_USERNAME)
git remote add origin https://github.com/VOTRE_USERNAME/digital-sos.git

# 6. Renommer branche
git branch -M main

# 7. Push
git push -u origin main

# 8. Vérifier
git remote -v
```

**Entre étape 4 et 5 :** Créer le dépôt sur GitHub.com

---

## 📝 COMMANDES UTILES

```bash
# Voir l'état
git status

# Voir l'historique
git log --oneline

# Voir les différences
git diff

# Récupérer depuis GitHub
git pull

# Annuler modifications non commitées
git checkout .
```

---

## 🎉 C'EST FAIT !

Votre projet est sur GitHub : `https://github.com/VOTRE_USERNAME/digital-sos`

**Prochaine étape :** Développer et push régulièrement avec `git add . && git commit -m "..." && git push`
