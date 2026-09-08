/**
 * Moccam - JavaScript principal
 * Gestion de la sidebar responsive et des interactions de base
 */

$(document).ready(function() {
    // ============================================
    // Gestion de la sidebar responsive
    // ============================================
    
    const $sidebar = $('#sidebar');
    const $hamburgerMenu = $('#hamburger-menu');
    const $closeSidebar = $('#close-sidebar');
    const $body = $('body');
    
    // Créer l'overlay pour fermer la sidebar en cliquant à l'extérieur
    const $overlay = $('<div class="sidebar-overlay"></div>');
    $body.append($overlay);
    
    // Ouvrir la sidebar sur mobile
    $hamburgerMenu.on('click', function(e) {
        e.stopPropagation();
        $sidebar.addClass('open');
        $overlay.addClass('active');
    });
    
    // Fermer la sidebar
    function closeSidebar() {
        $sidebar.removeClass('open');
        $overlay.removeClass('active');
    }
    
    $closeSidebar.on('click', closeSidebar);
    
    // Fermer la sidebar en cliquant sur l'overlay
    $overlay.on('click', closeSidebar);
    
    // Fermer la sidebar en cliquant à l'extérieur sur mobile
    $(document).on('click', function(e) {
        if ($(window).width() < 992) {
            if (!$sidebar.is(e.target) && $sidebar.has(e.target).length === 0 &&
                !$(e.target).closest('#hamburger-menu').length) {
                closeSidebar();
            }
        }
    });
    
    // ============================================
    // Gestion du champ de recherche rapide
    // ============================================
    
    const $quickSearch = $('#quick-search');
    
    // Effet de focus/blur pour le champ de recherche
    $quickSearch.on('focus', function() {
        $(this).closest('.input-group').addClass('focused');
    });
    
    $quickSearch.on('blur', function() {
        $(this).closest('.input-group').removeClass('focused');
    });
    
    // Exemple : Recherche en temps réel (à adapter avec ton backend)
    $quickSearch.on('input', function() {
        const searchTerm = $(this).val().trim();
        
        if (searchTerm.length >= 2) {
            // Ici, tu pourrais appeler une API ou filtrer un tableau local
            console.log('Recherche:', searchTerm);
            // Exemple : filterTable(searchTerm);
        }
    });
    
    // ============================================
    // Gestion des liens de la sidebar
    // ============================================
    
    $('.sidebar-nav .nav-link').on('click', function(e) {
        // Retirer la classe active de tous les liens
        $('.sidebar-nav .nav-link').removeClass('active');
        
        // Ajouter la classe active au lien cliqué
        $(this).addClass('active');
        
        // Fermer la sidebar sur mobile après sélection
        if ($(window).width() < 992) {
            closeSidebar();
        }
    });
    
    // ============================================
    // Gestion de l'icône de connexion
    // ============================================
    
    $('#login-btn').on('click', function() {
        // Exemple : Afficher une modale de connexion
        console.log('Ouvrir la modale de connexion');
        // Tu pourrais utiliser Bootstrap Modal ici
        // $('#loginModal').modal('show');
    });
    
    // ============================================
    // Gestion du redimensionnement de la fenêtre
    // ============================================
    
    $(window).on('resize', function() {
        // Si on passe en mode desktop (> 992px), fermer la sidebar
        if ($(window).width() >= 992) {
            closeSidebar();
        }
    });
    
    // ============================================
    // Fonctions utilitaires
    // ============================================
    
    /**
     * Filtre un tableau HTML en fonction d'un terme de recherche
     * @param {string} searchTerm - Terme à rechercher
     * @param {string} tableSelector - Sélecteur jQuery du tableau
     */
    function filterTable(searchTerm, tableSelector = 'table') {
        const $table = $(tableSelector);
        const $rows = $table.find('tbody tr');
        
        $rows.each(function() {
            const $row = $(this);
            let found = false;
            
            // Rechercher dans toutes les cellules
            $row.find('td').each(function() {
                const text = $(this).text().toLowerCase();
                if (text.includes(searchTerm.toLowerCase())) {
                    found = true;
                    return false; // Sortir de la boucle each
                }
            });
            
            // Afficher ou masquer la ligne
            $row.toggle(found);
        });
    }
    
    // ============================================
    // Initialisation
    // ============================================
    
    // Masquer la sidebar sur mobile au chargement
    if ($(window).width() < 992) {
        $sidebar.removeClass('open');
        $overlay.removeClass('active');
    }
    
    console.log('Moccam initialisé avec succès !');
});

// ============================================
// Fonctions globales (accessibles depuis le HTML)
// ============================================

/**
 * Ouvre la sidebar sur mobile
 */
function openSidebar() {
    $('#sidebar').addClass('open');
    $('.sidebar-overlay').addClass('active');
}

/**
 * Ferme la sidebar sur mobile
 */
function closeSidebar() {
    $('#sidebar').removeClass('open');
    $('.sidebar-overlay').removeClass('active');
}
