import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/custom-app.css',  // CSS personnalisés compilés
                'resources/js/app.js'             // JavaScript
            ],
            refresh: true,  // Hot reload des Blade templates
        }),
    ],
    
    // Configuration du build pour la production
    build: {
        // Minification
        minify: 'terser',  // Utiliser terser pour une meilleure compression
        
        // Options terser
        terserOptions: {
            compress: {
                drop_console: true,  // Supprimer les console.log en production
                drop_debugger: true,
            },
        },
        
        // Taille des chunks
        rollupOptions: {
            output: {
                // Ne pas créer de chunks séparés
                manualChunks: undefined,
                
                // Nommage des fichiers
                assetFileNames: 'assets/[name]-[hash][extname]',
                chunkFileNames: 'assets/[name]-[hash].js',
                entryFileNames: 'assets/[name]-[hash].js',
            },
        },
        
        // Taille maximale des chunks (warning)
        chunkSizeWarningLimit: 1000,  // 1000kb
        
        // Source maps pour le debug (désactiver en production)
        sourcemap: false,
        
        // Répertoire de sortie
        outDir: 'public/build',
        
        // Vider le répertoire avant chaque build
        emptyOutDir: true,
    },
    
    // Configuration du serveur de développement
    server: {
        hmr: {
            host: 'localhost',
        },
        watch: {
            usePolling: false,  // Désactiver le polling (meilleure performance)
        },
    },
    
    // Optimisation des dépendances
    optimizeDeps: {
        include: [
            'bootstrap',
            '@popperjs/core',
        ],
    },
    
    // Résolution des alias (optionnel)
    resolve: {
        alias: {
            '~bootstrap': 'node_modules/bootstrap',
            '~@fortawesome': 'node_modules/@fortawesome',
        },
    },
});