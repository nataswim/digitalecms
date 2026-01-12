#!/bin/bash

# ==============================================================================
# SCRIPT DE COLLECTE - ANALYSE DESIGN
# ==============================================================================
# Ce script collecte automatiquement tous les fichiers nécessaires
# pour l'analyse du design et du CSS de votre projet Laravel
# ==============================================================================

# Couleurs
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${BLUE}╔════════════════════════════════════════════════════════════╗${NC}"
echo -e "${BLUE}║         COLLECTE AUTOMATIQUE - ANALYSE DESIGN              ║${NC}"
echo -e "${BLUE}╚════════════════════════════════════════════════════════════╝${NC}"
echo ""

# Vérifier qu'on est dans un projet Laravel
if [ ! -f "artisan" ]; then
    echo -e "${RED}❌ Erreur : Ce script doit être exécuté depuis la racine de votre projet Laravel${NC}"
    exit 1
fi

# Créer le dossier de collecte
COLLECT_DIR="design-analysis-$(date +%Y%m%d-%H%M%S)"
mkdir -p "$COLLECT_DIR"

echo -e "${GREEN}✅ Dossier de collecte créé : $COLLECT_DIR${NC}"
echo ""

# ==============================================================================
# 1. COLLECTER LES FICHIERS CSS
# ==============================================================================
echo -e "${BLUE}📦 Collecte des fichiers CSS...${NC}"

if [ -d "public/css" ]; then
    mkdir -p "$COLLECT_DIR/public-css"
    cp -r public/css/* "$COLLECT_DIR/public-css/" 2>/dev/null
    
    CSS_COUNT=$(find public/css -name "*.css" | wc -l)
    CSS_SIZE=$(du -sh public/css 2>/dev/null | cut -f1)
    
    echo -e "${GREEN}   ✓ Fichiers CSS copiés : $CSS_COUNT fichiers ($CSS_SIZE)${NC}"
else
    echo -e "${YELLOW}   ⚠ Dossier public/css/ non trouvé${NC}"
fi

if [ -d "resources/sass" ]; then
    mkdir -p "$COLLECT_DIR/resources-sass"
    cp -r resources/sass/* "$COLLECT_DIR/resources-sass/" 2>/dev/null
    
    SCSS_COUNT=$(find resources/sass -name "*.scss" -o -name "*.sass" | wc -l)
    echo -e "${GREEN}   ✓ Fichiers SCSS/SASS copiés : $SCSS_COUNT fichiers${NC}"
else
    echo -e "${YELLOW}   ⚠ Dossier resources/sass/ non trouvé${NC}"
fi

if [ -d "resources/css" ]; then
    mkdir -p "$COLLECT_DIR/resources-css"
    cp -r resources/css/* "$COLLECT_DIR/resources-css/" 2>/dev/null
    
    RCSS_COUNT=$(find resources/css -name "*.css" | wc -l)
    echo -e "${GREEN}   ✓ Fichiers CSS (resources) copiés : $RCSS_COUNT fichiers${NC}"
fi

echo ""

# ==============================================================================
# 2. COLLECTER LES LAYOUTS
# ==============================================================================
echo -e "${BLUE}📄 Collecte des layouts...${NC}"

if [ -d "resources/views/layouts" ]; then
    mkdir -p "$COLLECT_DIR/layouts"
    cp resources/views/layouts/*.blade.php "$COLLECT_DIR/layouts/" 2>/dev/null
    
    LAYOUT_COUNT=$(find resources/views/layouts -name "*.blade.php" -maxdepth 1 | wc -l)
    echo -e "${GREEN}   ✓ Layouts copiés : $LAYOUT_COUNT fichiers${NC}"
    
    # Copier aussi les partials si ils existent
    if [ -d "resources/views/layouts/partials" ]; then
        mkdir -p "$COLLECT_DIR/layouts/partials"
        cp resources/views/layouts/partials/*.blade.php "$COLLECT_DIR/layouts/partials/" 2>/dev/null
        
        PARTIAL_COUNT=$(find resources/views/layouts/partials -name "*.blade.php" | wc -l)
        echo -e "${GREEN}   ✓ Partials copiés : $PARTIAL_COUNT fichiers${NC}"
    fi
else
    echo -e "${YELLOW}   ⚠ Dossier resources/views/layouts/ non trouvé${NC}"
fi

echo ""

# ==============================================================================
# 3. COLLECTER LES VUES PRINCIPALES
# ==============================================================================
echo -e "${BLUE}📑 Collecte des vues principales...${NC}"

mkdir -p "$COLLECT_DIR/views"

# Dashboard
if [ -f "resources/views/dashboard.blade.php" ]; then
    cp resources/views/dashboard.blade.php "$COLLECT_DIR/views/"
    echo -e "${GREEN}   ✓ dashboard.blade.php${NC}"
fi

# Home
if [ -f "resources/views/home.blade.php" ]; then
    cp resources/views/home.blade.php "$COLLECT_DIR/views/"
    echo -e "${GREEN}   ✓ home.blade.php${NC}"
fi

if [ -f "resources/views/welcome.blade.php" ]; then
    cp resources/views/welcome.blade.php "$COLLECT_DIR/views/"
    echo -e "${GREEN}   ✓ welcome.blade.php${NC}"
fi

# Admin views (si elles existent)
if [ -d "resources/views/admin" ]; then
    mkdir -p "$COLLECT_DIR/views/admin"
    
    # Copier quelques vues admin représentatives
    find resources/views/admin -name "index.blade.php" -o -name "show.blade.php" | head -5 | while read file; do
        REL_PATH=$(echo "$file" | sed "s|resources/views/admin/||")
        mkdir -p "$COLLECT_DIR/views/admin/$(dirname $REL_PATH)"
        cp "$file" "$COLLECT_DIR/views/admin/$REL_PATH"
    done
    
    echo -e "${GREEN}   ✓ Vues admin copiées${NC}"
fi

echo ""

# ==============================================================================
# 4. COLLECTER LES FICHIERS DE CONFIGURATION
# ==============================================================================
echo -e "${BLUE}⚙️  Collecte des fichiers de configuration...${NC}"

mkdir -p "$COLLECT_DIR/config"

# package.json
if [ -f "package.json" ]; then
    cp package.json "$COLLECT_DIR/config/"
    echo -e "${GREEN}   ✓ package.json${NC}"
else
    echo -e "${YELLOW}   ⚠ package.json non trouvé${NC}"
fi

# vite.config.js
if [ -f "vite.config.js" ]; then
    cp vite.config.js "$COLLECT_DIR/config/"
    echo -e "${GREEN}   ✓ vite.config.js${NC}"
fi

# webpack.mix.js
if [ -f "webpack.mix.js" ]; then
    cp webpack.mix.js "$COLLECT_DIR/config/"
    echo -e "${GREEN}   ✓ webpack.mix.js${NC}"
fi

# tailwind.config.js
if [ -f "tailwind.config.js" ]; then
    cp tailwind.config.js "$COLLECT_DIR/config/"
    echo -e "${GREEN}   ✓ tailwind.config.js${NC}"
fi

# postcss.config.js
if [ -f "postcss.config.js" ]; then
    cp postcss.config.js "$COLLECT_DIR/config/"
    echo -e "${GREEN}   ✓ postcss.config.js${NC}"
fi

echo ""

# ==============================================================================
# 5. COLLECTER LE LOGO ET FAVICON
# ==============================================================================
echo -e "${BLUE}🎨 Collecte du logo et favicon...${NC}"

mkdir -p "$COLLECT_DIR/assets"

# Chercher le logo
LOGO_FOUND=0
for logo in public/assets/images/logo.png public/images/logo.png public/logo.png; do
    if [ -f "$logo" ]; then
        cp "$logo" "$COLLECT_DIR/assets/"
        echo -e "${GREEN}   ✓ Logo copié : $logo${NC}"
        LOGO_FOUND=1
        break
    fi
done

if [ $LOGO_FOUND -eq 0 ]; then
    echo -e "${YELLOW}   ⚠ Logo non trouvé (cherché dans public/)${NC}"
fi

# Chercher le favicon
FAVICON_FOUND=0
for favicon in public/assets/images/favicon.ico public/favicon.ico public/images/favicon.ico; do
    if [ -f "$favicon" ]; then
        cp "$favicon" "$COLLECT_DIR/assets/"
        echo -e "${GREEN}   ✓ Favicon copié : $favicon${NC}"
        FAVICON_FOUND=1
        break
    fi
done

if [ $FAVICON_FOUND -eq 0 ]; then
    echo -e "${YELLOW}   ⚠ Favicon non trouvé${NC}"
fi

echo ""

# ==============================================================================
# 6. GÉNÉRER UN RAPPORT D'INFORMATION
# ==============================================================================
echo -e "${BLUE}📋 Génération du rapport d'information...${NC}"

cat > "$COLLECT_DIR/INFO.md" << EOF
# INFORMATIONS DU PROJET

Généré le : $(date '+%Y-%m-%d %H:%M:%S')

## Fichiers collectés

### CSS
- Fichiers CSS (public) : $(find public/css -name "*.css" 2>/dev/null | wc -l)
- Taille CSS (public) : $(du -sh public/css 2>/dev/null | cut -f1 || echo "N/A")
- Fichiers SCSS : $(find resources/sass -name "*.scss" -o -name "*.sass" 2>/dev/null | wc -l)
- Fichiers CSS (resources) : $(find resources/css -name "*.css" 2>/dev/null | wc -l)

### Layouts
- Layouts principaux : $(find resources/views/layouts -name "*.blade.php" -maxdepth 1 2>/dev/null | wc -l)
- Partials : $(find resources/views/layouts/partials -name "*.blade.php" 2>/dev/null | wc -l)

### Configuration
- package.json : $([ -f "package.json" ] && echo "✓" || echo "✗")
- vite.config.js : $([ -f "vite.config.js" ] && echo "✓" || echo "✗")
- webpack.mix.js : $([ -f "webpack.mix.js" ] && echo "✓" || echo "✗")
- tailwind.config.js : $([ -f "tailwind.config.js" ] && echo "✓" || echo "✗")

## Informations Laravel

- Version PHP : $(php -v | head -n 1)
- Version Laravel : $(php artisan --version)
- Version Node : $(node -v 2>/dev/null || echo "Non installé")
- Version npm : $(npm -v 2>/dev/null || echo "Non installé")

## Dépendances CSS détectées

EOF

# Ajouter les dépendances CSS de package.json si disponible
if [ -f "package.json" ]; then
    echo "### Depuis package.json" >> "$COLLECT_DIR/INFO.md"
    echo '```json' >> "$COLLECT_DIR/INFO.md"
    
    # Extraire les dépendances liées au CSS
    cat package.json | grep -E "(bootstrap|tailwind|sass|css|postcss|autoprefixer)" >> "$COLLECT_DIR/INFO.md" 2>/dev/null || echo "Aucune dépendance CSS détectée" >> "$COLLECT_DIR/INFO.md"
    
    echo '```' >> "$COLLECT_DIR/INFO.md"
fi

cat >> "$COLLECT_DIR/INFO.md" << EOF

## TODO - À compléter manuellement

### Palette de couleurs
- Couleur primaire : #________
- Couleur secondaire : #________
- Couleur accent : #________

### Typographie
- Police principale : _____________
- Source : □ Google Fonts  □ CDN  □ Locale

### Framework CSS actuel
- □ Bootstrap 5
- □ Bootstrap 4
- □ Tailwind CSS
- □ Pure CSS personnalisé
- □ Autre : _____________

### Outil de build
- □ Vite (Laravel 10+)
- □ Laravel Mix (Laravel 9-)
- □ Aucun (CDN)

### Problèmes actuels
- □ Chargement lent
- □ Conflits CSS
- □ Design incohérent
- □ Autre : _____________

### Objectifs
- Taille CSS cible : ______ KB (actuellement: $(du -sh public/css 2>/dev/null | cut -f1 || echo "N/A"))
- Temps de chargement cible : ______ secondes

## Notes additionnelles

[Ajoutez ici toute information supplémentaire utile]
EOF

echo -e "${GREEN}   ✓ Rapport INFO.md créé${NC}"
echo ""

# ==============================================================================
# 7. CRÉER UN QUESTIONNAIRE
# ==============================================================================
echo -e "${BLUE}❓ Création du questionnaire...${NC}"

cat > "$COLLECT_DIR/QUESTIONNAIRE.md" << 'EOF'
# QUESTIONNAIRE - ANALYSE DESIGN

Merci de remplir ce questionnaire pour une analyse optimale.

## 1. Framework CSS actuel

Quel framework CSS utilisez-vous actuellement ?
- [ ] Bootstrap 5
- [ ] Bootstrap 4
- [ ] Tailwind CSS
- [ ] Bulma
- [ ] Foundation
- [ ] Pure CSS personnalisé
- [ ] Autre : _________________

## 2. Bibliothèques UI supplémentaires

Utilisez-vous des bibliothèques UI additionnelles ?
- [ ] jQuery UI
- [ ] AdminLTE
- [ ] CoreUI
- [ ] Material Design
- [ ] Font Awesome (version : _____)
- [ ] Autre : _________________

## 3. Outil de build

Quel outil de build utilisez-vous ?
- [ ] Vite (Laravel 10+)
- [ ] Laravel Mix (Laravel 9-)
- [ ] Aucun (liens CDN)
- [ ] Webpack custom
- [ ] Autre : _________________

## 4. Palette de couleurs

Quelle est votre palette de couleurs principale ?
- Couleur primaire : #________ (exemple: #00acc0)
- Couleur secondaire : #________
- Couleur accent : #________
- Couleur texte : #________
- Couleur fond : #________

## 5. Typographie

Quelle typographie utilisez-vous ?
- Police principale : _________________ (exemple: Inter, Roboto)
- Police secondaire : _________________
- Source : 
  - [ ] Google Fonts
  - [ ] CDN
  - [ ] Fichiers locaux

## 6. Composants les plus utilisés

Quels composants utilisez-vous fréquemment ?
- [ ] Cards
- [ ] Tables (DataTables ?)
- [ ] Formulaires
- [ ] Modals
- [ ] Dropdowns
- [ ] Tooltips
- [ ] Charts (Chart.js ? ApexCharts ?)
- [ ] Calendriers
- [ ] Autre : _________________

## 7. Logo et branding

- Avez-vous un logo ? [ ] Oui [ ] Non
- Avez-vous un favicon ? [ ] Oui [ ] Non
- Avez-vous une charte graphique ? [ ] Oui [ ] Non

## 8. Performance actuelle

- Taille totale CSS : ______ KB (vérifier avec: du -sh public/css/)
- Temps de chargement page d'accueil : ______ secondes (F12 > Network)
- Nombre de fichiers CSS chargés : ______

## 9. Problèmes actuels

Quels problèmes rencontrez-vous ?
- [ ] Chargement trop lent
- [ ] Conflits CSS entre frameworks
- [ ] Design incohérent entre les pages
- [ ] CSS qui ne s'applique pas correctement
- [ ] Trop de dépendances
- [ ] Code CSS difficile à maintenir
- [ ] Autre : _________________

## 10. Objectifs

Quels sont vos objectifs ?
- Taille CSS cible : ______ KB (idéal: < 100KB)
- Temps de chargement cible : ______ secondes (idéal: < 2s)
- Framework(s) à conserver : _________________
- Responsive : [ ] Oui [ ] Non
- Support navigateurs : _________________

## 11. Pages à analyser en priorité

Listez 3-5 pages qui représentent bien votre design :
1. _________________
2. _________________
3. _________________
4. _________________
5. _________________

## 12. Notes additionnelles

[Ajoutez ici toute information supplémentaire utile pour l'analyse]

---

**Merci d'avoir complété ce questionnaire !**
EOF

echo -e "${GREEN}   ✓ Questionnaire QUESTIONNAIRE.md créé${NC}"
echo ""

# ==============================================================================
# 8. CRÉER LE README
# ==============================================================================
cat > "$COLLECT_DIR/README.md" << EOF
# COLLECTE DESIGN - README

Ce dossier contient tous les fichiers nécessaires pour l'analyse du design.

## Contenu

- \`public-css/\` - Fichiers CSS de public/css/
- \`resources-sass/\` - Fichiers SCSS de resources/sass/
- \`resources-css/\` - Fichiers CSS de resources/css/
- \`layouts/\` - Fichiers de layout Blade
- \`views/\` - Vues principales
- \`config/\` - Fichiers de configuration (package.json, vite.config.js, etc.)
- \`assets/\` - Logo et favicon
- \`INFO.md\` - Informations du projet
- \`QUESTIONNAIRE.md\` - Questionnaire à remplir

## Prochaines étapes

1. **Compléter INFO.md** avec les informations manquantes
2. **Remplir QUESTIONNAIRE.md** pour fournir le contexte
3. **Ajouter des screenshots** dans un dossier \`screenshots/\`
   - Page d'accueil (desktop + mobile)
   - Dashboard admin
   - Page avec formulaire
   - Page avec tableau
   - Navigation
   - Footer

4. **Compresser le dossier**
   \`\`\`bash
   zip -r design-analysis.zip $COLLECT_DIR/
   \`\`\`

5. **Envoyer le fichier** design-analysis.zip pour l'analyse

## Screenshots recommandés

Créez un dossier \`screenshots/\` et ajoutez :

- \`01-home-desktop.png\` - Page d'accueil (1920x1080)
- \`02-home-mobile.png\` - Page d'accueil mobile (375x812)
- \`03-dashboard.png\` - Dashboard admin
- \`04-form.png\` - Page avec formulaire
- \`05-table.png\` - Page avec tableau de données
- \`06-navigation.png\` - Header/Navigation
- \`07-footer.png\` - Footer

## Informations collectées

Voir \`INFO.md\` pour le détail des fichiers collectés.

---

Généré le : $(date '+%Y-%m-%d %H:%M:%S')
EOF

# ==============================================================================
# 9. RÉSUMÉ
# ==============================================================================
echo ""
echo -e "${BLUE}╔════════════════════════════════════════════════════════════╗${NC}"
echo -e "${BLUE}║                    COLLECTE TERMINÉE                       ║${NC}"
echo -e "${BLUE}╚════════════════════════════════════════════════════════════╝${NC}"
echo ""

echo -e "${GREEN}✅ Tous les fichiers ont été collectés dans : ${YELLOW}$COLLECT_DIR/${NC}"
echo ""

echo -e "${BLUE}📋 PROCHAINES ÉTAPES :${NC}"
echo ""
echo -e "1. ${YELLOW}Compléter les fichiers :${NC}"
echo -e "   - Éditer $COLLECT_DIR/INFO.md"
echo -e "   - Remplir $COLLECT_DIR/QUESTIONNAIRE.md"
echo ""
echo -e "2. ${YELLOW}Ajouter des screenshots :${NC}"
echo -e "   mkdir $COLLECT_DIR/screenshots"
echo -e "   # Puis ajoutez vos captures d'écran"
echo ""
echo -e "3. ${YELLOW}Compresser le dossier :${NC}"
echo -e "   zip -r design-analysis.zip $COLLECT_DIR/"
echo ""
echo -e "4. ${YELLOW}Envoyer le fichier :${NC}"
echo -e "   design-analysis.zip"
echo ""

echo -e "${GREEN}🎉 C'est prêt pour l'analyse !${NC}"
echo ""
