# ✅ CHECKLIST PREMIER PUSH GITHUB

**Cocher chaque étape au fur et à mesure**

---

## 🔧 PRÉPARATION (5 min)

- [ ] Git est installé (`git --version`)
- [ ] Git configuré (nom + email)
- [ ] Je suis dans le bon dossier (`cd digital-sos`)
- [ ] Le projet fonctionne (`php artisan --version`)

---

## 📝 FICHIERS (3 min)

- [ ] `.env.example` existe
- [ ] `.env.example` sans secrets (DB_PASSWORD vide, JWT_SECRET vide)
- [ ] `.gitignore` existe
- [ ] `.gitignore` contient `.env`
- [ ] `.gitignore` contient `/vendor`
- [ ] `.gitignore` contient `/node_modules`

---

## 💻 COMMANDES GIT LOCAL (2 min)

- [ ] `git init` exécuté
- [ ] `git add .` exécuté
- [ ] `git status` → fichiers en vert
- [ ] `git commit -m "Initial commit: SportCMS Laravel 12"` exécuté
- [ ] Commit créé (voir message avec nombre de fichiers)

---

## 🌐 GITHUB WEB (3 min)

- [ ] Connecté sur github.com
- [ ] Cliqué sur `+` → `New repository`
- [ ] Nom du dépôt : `digital-sos`
- [ ] Description ajoutée
- [ ] Visibilité choisie (Public ou Private)
- [ ] **PAS** de README coché
- [ ] **PAS** de .gitignore coché
- [ ] Dépôt créé
- [ ] URL copiée 

---

## 🔗 CONNEXION GITHUB (2 min)

- [ ] `git remote add origin URL` exécuté (avec VOTRE URL)
- [ ] `git remote -v` → affiche l'URL correcte
- [ ] `git branch -M main` exécuté
- [ ] `git branch` → affiche `* main`

---

## 🚀 PUSH (2 min)

- [ ] `git push -u origin main` exécuté
- [ ] Token GitHub créé (si demandé)
- [ ] Authentification réussie
- [ ] Message "Branch 'main' set up to track..." affiché
- [ ] Aucune erreur

---

## ✅ VÉRIFICATION (1 min)

- [ ] Page GitHub actualisée 
- [ ] Tous les fichiers visibles sur GitHub
- [ ] README affiché (si vous en avez un)
- [ ] Commit visible avec le message "Initial commit..."
- [ ] Nombre de commits = 1

---

## PROCHAINES FOIS

Commandes à répéter pour chaque modification :

```bash
git add .
git commit -m "Description du changement"
git push
```

Cocher à chaque push :
- [ ] Modifications faites
- [ ] `git add .`
- [ ] `git commit -m "..."`
- [ ] `git push`
- [ ] Vérification sur GitHub

---

## 🆘 EN CAS DE PROBLÈME

**Erreur commune :** "remote origin already exists"
```bash
git remote remove origin
git remote add origin https://github.com/username/digital-sos.git
```

**Erreur commune :** "Support for password authentication was removed"
→ Créer un token personnel sur GitHub (Settings → Developer settings)

**Erreur commune :** "failed to push"
```bash
git pull origin main --rebase
git push
```

**Fichier sensible commité par erreur (.env) :**
```bash
git rm --cached .env
git commit -m "Remove .env"
git push
```

---

**✅ CHECKLIST COMPLÉTÉE LE : ___/___/______**

**🎊 FÉLICITATIONS ! VOTRE PROJET EST SUR GITHUB ! 🎊**
