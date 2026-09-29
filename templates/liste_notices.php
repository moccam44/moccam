                <h2 class="mb-4">Liste des notices</h2>
                
                <!-- Tableau des notices -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Notices</h5>
                        <button class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-plus me-1"></i> Ajouter
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Titre</th>
                                        <th scope="col">Auteur principal</th>
                                        <th scope="col">Éditeur</th>
                                        <th scope="col">Année d'édition</th>
                                        <th scope="col">Collection</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$notices = [
    [
        'imagette' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/icons/book.svg',
        'titre' => 'Le Petit Prince',
        'auteur' => 'Antoine de Saint-Exupéry',
        'editeur' => 'Gallimard',
        'annee' => '2015',
        'collection' => 'Folio Junior',
    ],
];

foreach ($notices as $notice) :
?>
                                    <tr data-id="<?php echo htmlspecialchars((string)($notice['id'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>">
                                        <td class="text-center" style="width: 80px;">
                                            <img src="<?php echo htmlspecialchars($notice['imagette'], ENT_QUOTES, 'UTF-8'); ?>"
                                                 alt="Couverture : <?php echo htmlspecialchars($notice['titre'], ENT_QUOTES, 'UTF-8'); ?>"
                                                 class="img-thumbnail" style="width: 50px; height: 70px; object-fit: cover;">
                                        </td>
                                        <td><?php echo htmlspecialchars($notice['titre'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($notice['auteur'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($notice['editeur'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($notice['annee'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($notice['collection'], ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td class="text-center text-nowrap">
                                            <button type="button"
                                                    class="btn btn-sm btn-outline-primary action-add-panier me-1"
                                                    title="Ajouter au panier"
                                                    data-titre="<?php echo htmlspecialchars($notice['titre'], ENT_QUOTES, 'UTF-8'); ?>">
                                                <i class="bi bi-cart-plus"></i>
                                            </button>
                                            <button type="button"
                                                    class="btn btn-sm btn-outline-danger action-retirer-panier"
                                                    title="Retirer du panier"
                                                    data-titre="<?php echo htmlspecialchars($notice['titre'], ENT_QUOTES, 'UTF-8'); ?>">
                                                <i class="bi bi-cart-dash"></i>
                                            </button>
                                        </td>
                                    </tr>
<?php
endforeach;
?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
