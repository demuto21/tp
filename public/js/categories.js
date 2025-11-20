const categoriesKey = 'allsports_categories';
let categoryToDelete = null;
let currentView = 'all';

function getCategories() {
    const data = localStorage.getItem(categoriesKey);
    return data ? JSON.parse(data) : [
        { id: '1', name: 'Running', desc: 'Chaussures et vêtements pour courir', products: 12, visits: 156 },
        { id: '2', name: 'Football', desc: 'Ballons, maillots, crampons', products: 8, visits: 203 },
        { id: '3', name: 'Yoga', desc: 'Tapis, leggings, accessoires', products: 0, visits: 45 },
        { id: '4', name: 'Basketball', desc: 'Ballons, maillots, chaussures', products: 6, visits: 89 },
        { id: '5', name: 'Natation', desc: 'Maillots, lunettes, accessoires', products: 4, visits: 67 },
        { id: '6', name: 'Fitness', desc: 'Haltères, équipements de gym', products: 0, visits: 23 }
    ];
}

function saveCategories(cats) {
    localStorage.setItem(categoriesKey, JSON.stringify(cats));
}

function loadCategories() {
    const cats = getCategories();
    displayCategories(cats);
    updateStats(cats);
}

function displayCategories(cats) {
    const grid = document.getElementById('categoriesGrid');
    const emptySection = document.getElementById('emptySection');
    grid.innerHTML = '';

    let filteredCats = cats;
    
    if (currentView === 'empty') {
        filteredCats = cats.filter(c => c.products === 0);
    }

    if (filteredCats.length === 0) {
        emptySection.style.display = 'block';
        return;
    } else {
        emptySection.style.display = 'none';
    }

    filteredCats.forEach(cat => {
        const card = document.createElement('div');
        card.className = 'category-card';
        card.innerHTML = `
            <div class="category-name">${cat.name}</div>
            <div class="category-products">${cat.products} produit${cat.products > 1 ? 's' : ''}</div>
            <p style="color:#6b7280; font-size:0.9rem; margin-bottom:1rem;">${cat.desc || 'Aucune description'}</p>
            <div style="font-size:0.8rem; color:#9ca3af; margin-bottom:1rem;">
                Visites: ${cat.visits || 0}
            </div>
            <div class="category-actions">
                <button class="btn btn-small" onclick="editCategory('${cat.id}')">Éditer</button>
                <button class="btn btn-small btn-danger" onclick="prepareDelete('${cat.id}')">Supprimer</button>
            </div>
        `;
        grid.appendChild(card);
    });
}

function updateStats(cats) {
    document.getElementById('totalCategories').textContent = cats.length;
    const totalProds = cats.reduce((sum, c) => sum + c.products, 0);
    document.getElementById('totalProducts').textContent = totalProds;
    document.getElementById('emptyCategories').textContent = cats.filter(c => c.products === 0).length;

    const popular = cats.reduce((prev, current) => 
        ((prev.visits || 0) > (current.visits || 0)) ? prev : current, 
        { visits: -1, name: '-' }
    );
    document.getElementById('popularCategory').textContent = popular.visits > 0 ? popular.name : '-';
}

function switchView(view) {
    currentView = view;
    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');
    const cats = getCategories();
    displayCategories(cats);
}

function openAddModal() {
    document.getElementById('modalTitle').textContent = 'Nouvelle catégorie';
    document.getElementById('categoryForm').reset();
    document.getElementById('categoryId').value = '';
    document.getElementById('categoryModal').classList.add('active');
}

function editCategory(id) {
    const cats = getCategories();
    const cat = cats.find(c => c.id === id);
    document.getElementById('modalTitle').textContent = 'Modifier catégorie';
    document.getElementById('categoryId').value = cat.id;
    document.getElementById('categoryName').value = cat.name;
    document.getElementById('categoryDesc').value = cat.desc || '';
    document.getElementById('categoryModal').classList.add('active');
}

function closeModal() {
    document.getElementById('categoryModal').classList.remove('active');
}

function prepareDelete(id) {
    const cats = getCategories();
    const cat = cats.find(c => c.id === id);
    categoryToDelete = id;
    document.getElementById('deleteName').textContent = cat.name;
    document.getElementById('deleteWarning').textContent = cat.products > 0 
        ? `Attention : ${cat.products} produit(s) seront sans catégorie !` 
        : 'Aucun produit affecté.';
    document.getElementById('deleteModal').classList.add('active');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('active');
    categoryToDelete = null;
}

function confirmDelete() {
    let cats = getCategories();
    cats = cats.filter(c => c.id !== categoryToDelete);
    saveCategories(cats);
    showAlert('Catégorie supprimée', 'success');
    loadCategories();
    closeDeleteModal();
}

document.getElementById('categoryForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('categoryId').value;
    const cat = {
        name: document.getElementById('categoryName').value,
        desc: document.getElementById('categoryDesc').value,
        products: id ? getCategories().find(c => c.id === id).products : 0,
        visits: id ? getCategories().find(c => c.id === id).visits : 0
    };

    let cats = getCategories();
    if (id) {
        cats = cats.map(c => c.id === id ? { ...c, ...cat } : c);
    } else {
        cat.id = Date.now().toString();
        cat.visits = 0;
        cats.push(cat);
    }

    saveCategories(cats);
    showAlert('Catégorie enregistrée !', 'success');
    loadCategories();
    closeModal();
});

function showAlert(message, type) {
    const alert = document.getElementById('alert');
    alert.textContent = message;
    alert.className = `alert alert-${type} show`;
    setTimeout(() => alert.classList.remove('show'), 3000);
}

function checkAuth() {
    if (!document.cookie.includes('admin_session')) {
        window.location.href = 'admin-login.html';
    }
}

function logout() {
    if (confirm('Déconnexion ?')) {
        document.cookie = 'admin_session=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        window.location.href = 'admin-login.html';
    }
}

window.addEventListener('click', (e) => {
    const modals = ['categoryModal', 'deleteModal'];
    modals.forEach(m => {
        const modal = document.getElementById(m);
        if (e.target === modal) modal.classList.remove('active');
    });
});
