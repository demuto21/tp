// public/js/produits.js
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const tableBody = document.getElementById('productsTableBody');
    const productCount = document.getElementById('productCount');
    const noResults = document.getElementById('noResults');

    const allRows = Array.from(tableBody.querySelectorAll('tr'));

    function filterProducts() {
        const query = searchInput.value.trim().toLowerCase();
        const category = categoryFilter.value;

        let visibleCount = 0;

        allRows.forEach(row => {
            const name = row.cells[0].textContent.toLowerCase();
            const rowCategory = row.getAttribute('data-category') || '';

            const matchesSearch = name.includes(query);
            const matchesCategory = !category || rowCategory === category;

            if (matchesSearch && matchesCategory) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Mettre à jour le compteur
        productCount.textContent = `${visibleCount} produit(s)`;

        // Afficher message si aucun résultat
        noResults.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    // Événements
    searchInput.addEventListener('input', filterProducts);
    categoryFilter.addEventListener('change', filterProducts);

    // Initialiser
    filterProducts();
});
