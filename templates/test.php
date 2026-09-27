<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moccam - Gestion Bibliographique</title>
    
    <!-- Bootstrap 5 CSS (pour le responsive et les composants modernes) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- jQuery UI CSS (pour les interactions) -->
    <link href="https://code.jquery.com/ui/1.13.2/themes/base/theme.css" rel="stylesheet">
    
    <!-- CSS personnalisé -->
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Bandeau principal -->
    <header class="header">
        <div class="header-content d-flex align-items-center justify-content-between px-3">
            <!-- Logo à gauche -->
            <div class="logo d-flex align-items-center">
                <i class="bi bi-book me-2"></i>
                <span class="app-name">Moccam</span>
            </div>
            
            <!-- Champ de recherche rapide (centré sur desktop, à gauche sur mobile) -->
            <div class="search-container flex-grow-1 mx-3">
                <div class="input-group">
                    <span class="input-group-text bg-transparent border-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" 
                           id="quick-search" 
                           class="form-control border-0" 
                           placeholder="Recherche rapide...">
                </div>
            </div>
            
            <!-- Icône de connexion et menu hamburger (mobile) -->
            <div class="header-actions d-flex align-items-center">
                <!-- Menu hamburger (visible uniquement sur mobile) -->
                <button id="hamburger-menu" class="btn btn-link text-white d-lg-none me-2">
                    <i class="bi bi-list fs-4"></i>
                </button>
                
                <!-- Icône de connexion -->
                <button id="login-btn" class="btn btn-link text-white">
                    <i class="bi bi-person-circle fs-4"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Conteneur principal -->
    <div class="main-container d-flex">
        <!-- Barre latérale -->
        <aside id="sidebar" class="sidebar">
            <button id="close-sidebar" class="btn btn-link text-white d-lg-none close-btn">
                <i class="bi bi-x-lg fs-4"></i>
            </button>
            
            <nav class="sidebar-nav">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="bi bi-house me-2"></i>
                            <span>Accueil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-book me-2"></i>
                            <span>Notices</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-search me-2"></i>
                            <span>Recherche avancée</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-download me-2"></i>
                            <span>Import BNF</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-upload me-2"></i>
                            <span>Export UNIMARC</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-people me-2"></i>
                            <span>Auteurs</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-building me-2"></i>
                            <span>Éditeurs</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-tags me-2"></i>
                            <span>Thématiques</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-collection me-2"></i>
                            <span>Collections</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-gear me-2"></i>
                            <span>Paramètres</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-question-circle me-2"></i>
                            <span>Aide</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Contenu principal -->
        <main class="content flex-grow-1 p-4">
            <div class="container-fluid">
                <h2 class="mb-4">Bienvenue sur Moccam</h2>
                
                <!-- Exemple de cartes avec données bidons -->
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="card-icon bg-primary bg-opacity-10 text-primary me-3">
                                        <i class="bi bi-book fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-1">Total Notices</h5>
                                        <p class="card-text fs-4 fw-bold">2,847</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="card-icon bg-success bg-opacity-10 text-success me-3">
                                        <i class="bi bi-people fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-1">Auteurs</h5>
                                        <p class="card-text fs-4 fw-bold">1,234</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="card-icon bg-warning bg-opacity-10 text-warning me-3">
                                        <i class="bi bi-collection fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="card-title mb-1">Collections</h5>
                                        <p class="card-text fs-4 fw-bold">56</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tableau d'exemple -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Dernières notices ajoutées</h5>
                        <button class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-plus me-1"></i> Ajouter
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Titre</th>
                                        <th>Auteur</th>
                                        <th>ISBN</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Le Petit Prince</td>
                                        <td>Antoine de Saint-Exupéry</td>
                                        <td>978-2-07-061275-8</td>
                                        <td>15/06/2024</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-secondary me-1">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-primary me-1">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1984</td>
                                        <td>George Orwell</td>
                                        <td>978-2-07-036822-8</td>
                                        <td>14/06/2024</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-secondary me-1">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-primary me-1">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>L'Étranger</td>
                                        <td>Albert Camus</td>
                                        <td>978-2-07-036821-1</td>
                                        <td>13/06/2024</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-secondary me-1">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-primary me-1">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>À la recherche du temps perdu</td>
                                        <td>Marcel Proust</td>
                                        <td>978-2-07-010854-5</td>
                                        <td>12/06/2024</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-secondary me-1">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-primary me-1">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">© 2024 Moccam - Gestion Bibliographique</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Version 1.0.0</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery + jQuery UI -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    
    <!-- Bootstrap JS (pour les composants comme les modales) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- JavaScript personnalisé -->
    <script src="../javascript/app.js"></script>
</body>
</html>
