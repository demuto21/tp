
        const ordersKey = 'allsports_orders';
        let currentStatusFilter = 'all';

        function getOrders() {
            const data = localStorage.getItem(ordersKey);
            return data ? JSON.parse(data) : [
                { 
                    id: 'CMD001', 
                    client: 'Jean Dupont', 
                    email: 'jean.dupont@yahoo.cm',
                    date: '2025-11-03', 
                    montant: 85000, 
                    statut: 'en_attente', 
                    produits: [
                        { nom: 'Chaussures de Running Pro', prix: 45000, quantite: 1 },
                        { nom: 'T-Shirt Performance', prix: 15000, quantite: 2 }
                    ],
                    adresse: '123 Rue du Commerce, Yaoundé',
                    telephone: '677 12 34 56'
                },
                { 
                    id: 'CMD002', 
                    client: 'Marie Sarr', 
                    email: 'marie.sarr@gmail.com',
                    date: '2025-11-02', 
                    montant: 45000, 
                    statut: 'en_cours', 
                    produits: [
                        { nom: 'Legging Sport Élégant', prix: 25000, quantite: 1 },
                        { nom: 'Tapis de Yoga Premium', prix: 20000, quantite: 1 }
                    ],
                    adresse: '456 Avenue des Sports, Douala',
                    telephone: '678 98 76 54'
                },
                { 
                    id: 'CMD003', 
                    client: 'Paul Ndiaye', 
                    email: 'paul.ndiaye@yahoo.cm',
                    date: '2025-11-01', 
                    montant: 120000, 
                    statut: 'livree', 
                    produits: [
                        { nom: 'Vélo de Course', prix: 90000, quantite: 1 },
                        { nom: 'Casque de Sécurité', prix: 15000, quantite: 1 },
                        { nom: 'Gants Cyclisme', prix: 15000, quantite: 1 }
                    ],
                    adresse: '789 Boulevard des Athlètes, Yaoundé',
                    telephone: '676 45 67 89'
                },
                { 
                    id: 'CMD004', 
                    client: 'Sophie Ndiaye', 
                    email: 'sophie.ndiaye@gmail.com',
                    date: '2025-11-03', 
                    montant: 75000, 
                    statut: 'en_attente', 
                    produits: [
                        { nom: 'Sac de Sport Grande Capacité', prix: 18000, quantite: 1 },
                        { nom: 'Chaussures de Running Pro', prix: 45000, quantite: 1 },
                        { nom: 'Bouteille d\'Eau Sport', prix: 12000, quantite: 1 }
                    ],
                    adresse: '321 Rue du Stade, Douala',
                    telephone: '677 23 45 67'
                },
                { 
                    id: 'CMD005', 
                    client: 'Alioune Fall', 
                    email: 'alioune.fall@outlook.cm',
                    date: '2025-11-02', 
                    montant: 35000, 
                    statut: 'annulee', 
                    produits: [
                        { nom: 'Veste Sport Imperméable', prix: 35000, quantite: 1 }
                    ],
                    adresse: '654 Avenue de la Victoire, Bafoussam',
                    telephone: '678 34 56 78'
                },
                { 
                    id: 'CMD006', 
                    client: 'Fatou Mbappé', 
                    email: 'fatou.mbappe@hotmail.cm',
                    date: '2025-11-04', 
                    montant: 68000, 
                    statut: 'en_cours', 
                    produits: [
                        { nom: 'Ballon de Football Professionnel', prix: 25000, quantite: 1 },
                        { nom: 'Protèges Tibias', prix: 15000, quantite: 1 },
                        { nom: 'Chaussettes de Sport', prix: 8000, quantite: 2 }
                    ],
                    adresse: '159 Rue des Champions, Garoua',
                    telephone: '679 45 67 89'
                },
                { 
                    id: 'CMD007', 
                    client: 'Pierre Tchouaméni', 
                    email: 'pierre.tchouameni@gmail.com',
                    date: '2025-11-03', 
                    montant: 95000, 
                    statut: 'livree', 
                    produits: [
                        { nom: 'Raquette de Tennis Pro', prix: 65000, quantite: 1 },
                        { nom: 'Balles de Tennis (pack de 4)', prix: 15000, quantite: 2 }
                    ],
                    adresse: '753 Allée des Sportifs, Bamenda',
                    telephone: '677 56 78 90'
                },
                { 
                    id: 'CMD008', 
                    client: 'Aïcha Koné', 
                    email: 'aicha.kone@yahoo.cm',
                    date: '2025-11-05', 
                    montant: 42000, 
                    statut: 'en_attente', 
                    produits: [
                        { nom: 'Short de Sport Respirant', prix: 12000, quantite: 1 },
                        { nom: 'Brassière de Sport', prix: 15000, quantite: 1 },
                        { nom: 'Bandana Sportif', prix: 5000, quantite: 3 }
                    ],
                    adresse: '486 Avenue du Stade, Maroua',
                    telephone: '678 67 89 01'
                },
                { 
                    id: 'CMD009', 
                    client: 'Mohamed Aboubakar', 
                    email: 'm.aboubakar@gmail.com',
                    date: '2025-11-04', 
                    montant: 110000, 
                    statut: 'en_cours', 
                    produits: [
                        { nom: 'Tapis de Course Électrique', prix: 85000, quantite: 1 },
                        { nom: 'Haltères Adjustables', prix: 25000, quantite: 1 }
                    ],
                    adresse: '264 Rue des Athlètes, Ngaoundéré',
                    telephone: '679 78 90 12'
                },
                { 
                    id: 'CMD010', 
                    client: 'Claire Eto\'o', 
                    email: 'claire.etoo@outlook.cm',
                    date: '2025-11-02', 
                    montant: 28000, 
                    statut: 'annulee', 
                    produits: [
                        { nom: 'Corde à Sauter Professionnelle', prix: 8000, quantite: 1 },
                        { nom: 'Gourde Isotherme', prix: 10000, quantite: 2 }
                    ],
                    adresse: '951 Boulevard du Sport, Kumba',
                    telephone: '677 89 01 23'
                },
                { 
                    id: 'CMD011', 
                    client: 'David Mvogo', 
                    email: 'd.mvogo@yahoo.cm',
                    date: '2025-11-05', 
                    montant: 135000, 
                    statut: 'en_attente', 
                    produits: [
                        { nom: 'Tapis de Gym Premium', prix: 35000, quantite: 1 },
                        { nom: 'Kit d\'haltères 20kg', prix: 45000, quantite: 1 },
                        { nom: 'Barre de Traction Murale', prix: 55000, quantite: 1 }
                    ],
                    adresse: '147 Rue des Champions, Buéa',
                    telephone: '678 90 12 34'
                },
                { 
                    id: 'CMD012', 
                    client: 'Sarah Ngalle', 
                    email: 'sarah.ngalle@gmail.com',
                    date: '2025-11-01', 
                    montant: 52000, 
                    statut: 'livree', 
                    produits: [
                        { nom: 'Ballon de Basketball', prix: 18000, quantite: 1 },
                        { nom: 'Maillot de Sport', prix: 12000, quantite: 2 },
                        { nom: 'Bandages Élastiques', prix: 5000, quantite: 2 }
                    ],
                    adresse: '369 Avenue du Sport, Limbe',
                    telephone: '679 01 23 45'
                }
            ];
        }

        function saveOrders(orders) {
            localStorage.setItem(ordersKey, JSON.stringify(orders));
        }

        function loadOrders() {
            const orders = getOrders();
            displayOrders(orders);
        }

        function displayOrders(orders) {
            let filteredOrders = orders;
            
            // Appliquer les filtres
            if (currentStatusFilter !== 'all') {
                filteredOrders = filteredOrders.filter(o => o.statut === currentStatusFilter);
            }
            
            const tbody = document.getElementById('ordersTable');
            tbody.innerHTML = filteredOrders.map(order => `
                <tr>
                    <td><strong>${order.id}</strong></td>
                    <td>${order.client}</td>
                    <td>${order.email}</td>
                    <td>${formatDate(order.date)}</td>
                    <td><strong>${order.montant.toLocaleString('fr-FR')} FCFA</strong></td>
                    <td><span class="status-badge status-${order.statut}">${order.statut.replace('_', ' ')}</span></td>
                    <td class="actions-cell">
                        <button class="btn btn-secondary btn-sm" onclick="viewOrder('${order.id}')">
                            <i class="fas fa-eye"></i> Voir
                        </button>
                        ${order.statut !== 'livree' && order.statut !== 'annulee' ? 
                            `<button class="btn btn-sm" onclick="nextStatus('${order.id}')">
                                <i class="fas fa-arrow-right"></i> Suivant
                            </button>` : ''}
                    </td>
                </tr>
            `).join('');
            
            // Mettre à jour le compteur de commandes
            document.getElementById('orderCount').textContent = `${filteredOrders.length} commande(s) trouvée(s)`;
        }

        function filterByStatus(status) {
            currentStatusFilter = status;
            const statusTexts = {
                'all': 'Tous les statuts',
                'en_attente': 'En attente',
                'en_cours': 'En cours',
                'livree': 'Livrée',
                'annulee': 'Annulée'
            };
            document.getElementById('statusText').textContent = statusTexts[status];
            closeAllDropdowns();
            displayOrders(getOrders());
        }

        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            const isShowing = dropdown.classList.contains('show');
            
            // Fermer tous les dropdowns d'abord
            closeAllDropdowns();
            
            // Ouvrir celui-ci s'il n'était pas déjà ouvert
            if (!isShowing) {
                dropdown.classList.add('show');
            }
        }

        function closeAllDropdowns() {
            const dropdowns = document.querySelectorAll('.dropdown-content');
            dropdowns.forEach(dropdown => {
                dropdown.classList.remove('show');
            });
        }

        // Fermer les dropdowns en cliquant ailleurs
        document.addEventListener('click', function(event) {
            if (!event.target.matches('.dropdown-btn')) {
                closeAllDropdowns();
            }
        });

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('fr-FR');
        }

        function viewOrder(id) {
            const order = getOrders().find(o => o.id === id);
            document.getElementById('modalBody').innerHTML = `
                <div class="order-details">
                    <p><strong>ID Commande :</strong> ${order.id}</p>
                    <p><strong>Client :</strong> ${order.client}</p>
                    <p><strong>Email :</strong> ${order.email}</p>
                    <p><strong>Téléphone :</strong> ${order.telephone}</p>
                    <p><strong>Adresse :</strong> ${order.adresse}</p>
                    <p><strong>Date :</strong> ${formatDate(order.date)}</p>
                    <p><strong>Statut :</strong> <span class="status-badge status-${order.statut}">${order.statut.replace('_', ' ')}</span></p>
                    <p><strong>Montant total :</strong> <strong>${order.montant.toLocaleString('fr-FR')} FCFA</strong></p>
                </div>
                
                <div class="order-products">
                    <h4>Produits commandés :</h4>
                    <ul>
                        ${order.produits.map(p => `
                            <li>
                                <div class="product-info">
                                    <strong>${p.nom}</strong><br>
                                    <small>Quantité: ${p.quantite}</small>
                                </div>
                                <div class="product-price">
                                    ${(p.prix * p.quantite).toLocaleString('fr-FR')} FCFA
                                </div>
                            </li>
                        `).join('')}
                    </ul>
                </div>
                
                <div class="status-selector">
                    <label for="statusSelect">Changer le statut :</label>
                    <select id="statusSelect" onchange="updateOrderStatus('${order.id}')">
                        <option value="en_attente" ${order.statut === 'en_attente' ? 'selected' : ''}>En attente</option>
                        <option value="en_cours" ${order.statut === 'en_cours' ? 'selected' : ''}>En cours</option>
                        <option value="livree" ${order.statut === 'livree' ? 'selected' : ''}>Livrée</option>
                        <option value="annulee" ${order.statut === 'annulee' ? 'selected' : ''}>Annulée</option>
                    </select>
                </div>
            `;
            document.getElementById('orderModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('orderModal').classList.remove('active');
        }

        function nextStatus(id) {
            let orders = getOrders();
            const orderIndex = orders.findIndex(o => o.id === id);
            
            if (orderIndex !== -1) {
                const currentStatus = orders[orderIndex].statut;
                let newStatus;
                
                // Définir le statut suivant selon la progression logique
                if (currentStatus === 'en_attente') {
                    newStatus = 'en_cours';
                } else if (currentStatus === 'en_cours') {
                    newStatus = 'livree';
                } else {
                    return; // Ne rien faire si déjà livrée ou annulée
                }
                
                orders[orderIndex].statut = newStatus;
                saveOrders(orders);
                showAlert(`Statut de la commande ${id} mis à jour en "${newStatus.replace('_', ' ')}" !`, 'success');
                displayOrders(orders);
                
                // Notifier le client
                notifyCustomer(orders[orderIndex], newStatus);
            }
        }

        function updateOrderStatus(id) {
            const newStatus = document.getElementById('statusSelect').value;
            let orders = getOrders();
            const orderIndex = orders.findIndex(o => o.id === id);
            
            if (orderIndex !== -1) {
                orders[orderIndex].statut = newStatus;
                saveOrders(orders);
                showAlert(`Statut de la commande ${id} mis à jour en "${newStatus.replace('_', ' ')}" !`, 'success');
                displayOrders(orders);
                closeModal();
                
                // Notifier le client
                notifyCustomer(orders[orderIndex], newStatus);
            }
        }

        function notifyCustomer(order, newStatus) {
            const statusMessages = {
                'en_attente': 'est en attente de traitement',
                'en_cours': 'est en cours de préparation',
                'livree': 'a été livrée',
                'annulee': 'a été annulée'
            };
            
            console.log(`Notification envoyée à ${order.client} (${order.email}) :`);
            console.log(`Votre commande ${order.id} ${statusMessages[newStatus]}.`);
            
            // Dans une application réelle, on enverrait un email ou SMS ici
            showAlert(`Notification envoyée à ${order.client}`, 'info');
        }

        function showAlert(message, type) {
            const alert = document.getElementById('alert');
            alert.textContent = message;
            alert.className = `alert alert-${type} show`;
            setTimeout(() => alert.classList.remove('show'), 4000);
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

        // Fermer modal en cliquant dehors
        window.addEventListener('click', (e) => {
            const modal = document.getElementById('orderModal');
            if (e.target === modal) closeModal();
        });

        // Initialiser l'affichage
        displayOrders(getOrders());
