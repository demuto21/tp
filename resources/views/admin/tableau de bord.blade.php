@extends('layout.admin')

@section('title', 'Tableau de Bord')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/tableau de bord.css') }}">
@endpush

@section('content')
<div class="page-header">
    <h1>Tableau de Bord</h1>
    <p class="page-subtitle">Aperçu général de votre boutique AllSports</p>
</div>

<!-- Statistiques -->
<div class="content-section">
    <h2 style="margin-bottom: 1.5rem; color: #1e3a8a;">Statistiques Globales</h2>
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ number_format($totalRevenue) }} FCFA</div>
            <div class="stat-label">Chiffre d'affaires</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $totalOrders }}</div>
            <div class="stat-label">Commandes</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $totalCustomers }}</div>
            <div class="stat-label">Clients</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $totalProducts }}</div>
            <div class="stat-label">Produits</div>
        </div>
    </div>
</div>

<!-- Commandes récentes -->
<div class="content-section">
    <h2 style="margin-bottom: 1rem; color: #1e3a8a;">Commandes Récentes</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Montant</th>
                    <th>Statut</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                <tr>
                    <td>#{{ $order->id_commande }}</td>
                    <td>{{ $order->client->nom }} {{ $order->client->prenom }}</td>
                    <td>{{ number_format($order->montant_total) }} FCFA</td>
                    <td>
                        <span class="status-badge status-{{ strtolower($order->statut) }}">
                            {{ ucfirst(str_replace('_', ' ', $order->statut)) }}
                        </span>
                    </td>
                    <td>{{ $order->date_commande->format('d/m/Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Aucune commande récente.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Alertes stock -->
<div class="content-section">
    <h2 style="margin-bottom: 1rem; color: #1e3a8a;">Alerte Stock</h2>
    <div id="stockAlerts">
        @forelse($lowStockProducts as $product)
        <div class="alert alert-warning">
            <strong>{{ $product->nom }}</strong> : {{ $product->stock }} en stock
        </div>
        @empty
        <p>Tous les produits sont en stock.</p>
        @endforelse
    </div>
</div>

<!-- Actions rapides -->
<div class="content-section">
    <h2 style="margin-bottom: 1.5rem; color: #1e3a8a;">Actions Rapides</h2>
    <div class="quick-actions">
        <a href="{{ route('produit.index') }}" class="action-btn">Gestion des produits</a>
        <a href="{{ route('admin.commandes.index') }}" class="action-btn">Voir les commandes</a>
        <a href="{{ route('admin.clients.index') }}" class="action-btn">Gérer les clients</a>
    </div>
</div>
@endsection
