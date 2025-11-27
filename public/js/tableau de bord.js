/**
 * Fonction générique pour appliquer la recherche et les filtres côté client sur une table.
 * * @param {string} tableId - L'ID de la table (ex: 'produits-table').
 * @param {string} searchInputId - L'ID du champ de recherche (ex: 'searchInput').
 * @param {Array<string>} filterSelectIds - Tableau des ID de tous les sélecteurs de filtre (ex: ['statusFilter', 'categoryFilter']).
 */
function applyTableFilter(tableId, searchInputId, filterSelectIds = []) {
    const searchInput = document.getElementById(searchInputId);
    const tableBody = document.querySelector(`#${tableId} tbody`);
    if (!searchInput || !tableBody) {
        // console.error(`Table ou champ de recherche manquant pour l'ID: ${tableId}`);
        return; 
    }

    const filters = filterSelectIds.map(id => document.getElementById(id)).filter(el => el !== null);

    // Fonction principale qui gère le filtrage
    function filterTable() {
        const searchText = searchInput.value.toLowerCase().trim();
        const rows = tableBody.querySelectorAll('tr');

        rows.forEach(row => {
            let matchesSearch = false;
            let matchesFilters = true;

            // 1. Recherche Textuelle (dans toutes les cellules de la ligne)
            const cells = row.querySelectorAll('td');
            cells.forEach(cell => {
                if (cell.textContent.toLowerCase().includes(searchText)) {
                    matchesSearch = true;
                }
            });

            // 2. Filtres Dropdown
            filters.forEach(filter => {
                const filterValue = filter.value.toLowerCase();
                // Utilise l'attribut data-column-index pour cibler la bonne colonne de la ligne
                const columnIndex = filter.getAttribute('data-column-index');

                if (columnIndex && filterValue !== 'all') {
                    const cellToFilter = row.cells[parseInt(columnIndex)];
                    // Vérifie si la cellule contient la valeur du filtre
                    if (cellToFilter && !cellToFilter.textContent.toLowerCase().includes(filterValue)) {
                        matchesFilters = false;
                    }
                }
            });

            // Afficher ou masquer la ligne
            if (matchesSearch && matchesFilters) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Événements: déclencher le filtre sur chaque saisie ou changement de sélection
    searchInput.addEventListener('input', filterTable);
    filters.forEach(filter => {
        filter.addEventListener('change', filterTable);
    });

    // Appliquer le filtre initial au chargement (dans le cas où il y a des valeurs par défaut)
    filterTable(); 
}

// Initialisation des filtres/recherches pour chaque page au chargement du DOM
document.addEventListener('DOMContentLoaded', function() {
    // Page Produits (gestion-produits.blade.php)
    applyTableFilter('produits-table', 'searchInput', ['categorieFilter']);

    // Page Commandes (admin-commandes.blade.php)
    applyTableFilter('commandes-table', 'searchInput', ['statusFilter']);

    // Page Clients (admin-clients.blade.php)
    applyTableFilter('clients-table', 'searchInput'); // Pas de filtres de sélection par défaut
});