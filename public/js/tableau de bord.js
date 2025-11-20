
        // === Gestion des données via cookies/localStorage ===
        const statsKey = 'allsports_stats';
        const ordersKey = 'allsports_orders';
        const productsKey = 'allsports_products';

        function getStats() {
            const data = localStorage.getItem(statsKey);
            return data ? JSON.parse(data) : {
                revenue: 1250000,
                orders: 42,
                customers: 89,
                products: 24
            };
        }

        function getOrders() {
            const data = localStorage.getItem(ordersKey);
            return data ? JSON.parse(data) : [
                { id: 'CMD001', client: 'Jean Dupont', montant: 85000, statut: 'Livrée', date: '03/11/2025' },
                { id: 'CMD002', client: 'Marie Sarr', montant: 45000, statut: 'En cours', date: '02/11/2025' },
                { id: 'CMD003', client: 'Paul Ndiaye', montant: 120000, statut: 'En attente', date: '01/11/2025' }
            ];
        }

        function getProducts() {
            const data = localStorage.getItem(productsKey);
            return data ? JSON.parse(data) : [
                { id: '1', name: 'Chaussures Running Pro', stock: 15, price: 45000 },
                { id: '2', name: 'Ballon Football', stock: 3, price: 25000 },
                { id: '3', name: 'Tapis de Yoga', stock: 0, price: 20000 },
                { id: '4', name: 'Raquette Tennis', stock: 8, price: 35000 },
                { id: '5', name: 'Vélo de Course', stock: 0, price: 150000 },
                { id: '6', name: 'Haltères 10kg', stock: 2, price: 18000 }
            ];
        }

        function getLowStock() {
            const products = getProducts();
            return products.filter(p => p.stock < 5); // Stock faible si moins de 5 unités
        }

        function loadDashboard() {
            const stats = getStats();
            document.getElementById('totalRevenue').textContent = stats.revenue.toLocaleString() + ' CFA';
            document.getElementById('totalOrders').textContent = stats.orders;
            document.getElementById('totalCustomers').textContent = stats.customers;
            document.getElementById('totalProducts').textContent = stats.products;

            const orders = getOrders();
            document.getElementById('recentOrders').innerHTML = orders.map(o => `
                <tr>
                    <td><strong>${o.id}</strong></td>
                    <td>${o.client}</td>
                    <td>${o.montant.toLocaleString()} CFA</td>
                    <td><span style="padding:0.25rem 0.75rem; border-radius:999px; font-size:0.75rem; background:#dbeafe; color:#1e40af;">${o.statut}</span></td>
                    <td>${o.date}</td>
                </tr>
            `).join('');

            const lowStock = getLowStock();
            if (lowStock.length > 0) {
                document.getElementById('stockAlerts').innerHTML = lowStock.map(p => {
                    const isOutOfStock = p.stock === 0;
                    const statusClass = isOutOfStock ? 'stock-out' : 'stock-low';
                    const statusText = isOutOfStock ? 'Rupture' : 'Stock faible';
                    const statusBadgeClass = isOutOfStock ? 'status-out' : 'status-low';
                    
                    return `
                        <div class="stock-alert-item ${statusClass}">
                            <div>
                                <strong>${p.name}</strong> – Stock: ${p.stock} unités
                            </div>
                            <span class="stock-status ${statusBadgeClass}">${statusText}</span>
                        </div>
                    `;
                }).join('');
            } else {
                document.getElementById('stockAlerts').innerHTML = '<p style="color:#6b7280;">Aucune alerte stock pour le moment</p>';
            }
        }

        function checkAuth() {
            if (!document.cookie.includes('admin_session')) {
                // window.location.href = 'admin-login.html';
            }
        }

        function logout() {
            if (confirm('Déconnexion ?')) {
                document.cookie = 'admin_session=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                alert('Déconnecté !');
            }
        }

        setInterval(loadDashboard, 30000);
