@extends('layout.admin')

@section('title', 'Gestion des Clients')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/clients.css') }}">
@endpush

@section('content')
<div class="page-header">
    <div>
        <h1>Gestion des Clients</h1>
        <p class="page-subtitle">Gérez tous vos clients</p>
    </div>
</div>

<!-- Statistiques -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-number">{{ $totalClients }}</div>
        <div class="stat-label">Clients total</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">{{ $loyalClients->count() }}</div>
        <div class="stat-label">Clients fidèles (≥ 3 commandes)</div>
    </div>
</div>

<!-- Clients fidèles -->
<div class="content-section">
    <h2 style="margin-bottom: 1.5rem; color: #1e3a8a;">Clients fidèles</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Commandes</th>
                    <th>Inscrit le</th>
                </tr>
            </thead>
            <tbody>
                @forelse($loyalClients as $client)
                <tr>
                    <td>#{{ $client->id }}</td>
                    <td>{{ $client->nom }} {{ $client->prenom }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->telephone ?? '—' }}</td>
                    <td>{{ $client->commandes_count }}</td>
                    <td>{{ $client->created_at->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Aucun client fidèle pour le moment.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Liste complète des clients -->
<div class="content-section">
    <h2 style="margin-bottom: 1.5rem; color: #1e3a8a;">Liste des clients</h2>

    <div class="filters-section">
        <div class="search-box">
            <i class="fas fa-search search-icon"></i>
            <input type="text" id="searchInput" placeholder="Rechercher par nom ou email..." onkeyup="searchClients()">
        </div>
    </div>

    <div class="view-options">
        <button id="listViewBtn" class="btn btn-outline active" onclick="setViewMode('list')">
            <i class="fas fa-list"></i> Liste
        </button>
    </div>

    <div class="client-count">{{ $clients->count() }} client(s)</div>

    <div class="table-container">
        <table id="clientsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Commandes</th>
                    <th>Inscrit le</th>
                </tr>
            </thead>
            <tbody id="clientsTableBody">
                @foreach($clients as $client)
                <tr data-name="{{ strtolower($client->nom . ' ' . $client->prenom) }}" data-email="{{ strtolower($client->email) }}">
                    <td>#{{ $client->id }}</td>
                    <td>{{ $client->nom }} {{ $client->prenom }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->telephone ?? '—' }}</td>
                    <td>{{ $client->commandes_count }}</td>
                    <td>{{ $client->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
