@extends('layout.admin')

@section('title', 'Gestion des Commandes')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/commandes.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/commandes.js') }}"></script>
@endpush

@section('content')
<div class="page-header">
    <div>
        <h1>Gestion des Commandes</h1>
        <p class="page-subtitle">Suivez et traitez toutes les commandes</p>
    </div>
</div>

<div class="filters-section">
    <div class="dropdown">
        <button class="dropdown-btn" onclick="toggleDropdown('statusDropdown')">
            <span id="statusText">Tous les statuts</span>
            <i class="fas fa-chevron-down"></i>
        </button>
        <div id="statusDropdown" class="dropdown-content">
            <a class="dropdown-item" onclick="filterByStatus('all')">Tous les statuts</a>
            <a class="dropdown-item" onclick="filterByStatus('en_attente')">En attente</a>
            <a class="dropdown-item" onclick="filterByStatus('payée')">Payée</a>
            <a class="dropdown-item" onclick="filterByStatus('expédiée')">Expédiée</a>
            <a class="dropdown-item" onclick="filterByStatus('livrée')">Livrée</a>
            <a class="dropdown-item" onclick="filterByStatus('annulée')">Annulée</a>
        </div>
    </div>
</div>

<div class="order-count">Total : {{ $commandes->count() }} commande(s)</div>

<div class="content-section">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Email</th>
                <th>Date</th>
                <th>Montant (FCFA)</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="ordersTable">
            @forelse($commandes as $commande)
            <tr data-status="{{ $commande->statut }}">
                <td>#{{ $commande->id_commande }}</td>
                <td>{{ $commande->client->nom }} {{ $commande->client->prenom }}</td>
                <td>{{ $commande->client->email }}</td>
                <td>{{ $commande->date_commande->format('d/m/Y H:i') }}</td>
                <td>{{ number_format($commande->montant_total) }}</td>
                <td>
                    <form action="{{ route('admin.commandes.updateStatus', $commande->id_commande) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <select name="statut" onchange="this.form.submit()" class="status-select">
                            <option value="en_attente" {{ $commande->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                            <option value="payée" {{ $commande->statut == 'payée' ? 'selected' : '' }}>Payée</option>
                            <option value="expédiée" {{ $commande->statut == 'expédiée' ? 'selected' : '' }}>Expédiée</option>
                            <option value="livrée" {{ $commande->statut == 'livrée' ? 'selected' : '' }}>Livrée</option>
                            <option value="annulée" {{ $commande->statut == 'annulée' ? 'selected' : '' }}>Annulée</option>
                        </select>
                    </form>
                </td>
                <td>
                    <button type="button" onclick="showOrderDetails({{ $commande->id_commande }})" class="btn btn-sm">Détails</button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Aucune commande trouvée.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal Détails Commande -->
<div class="modal" id="orderModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Détails de la commande</h3>
            <button class="close-modal" onclick="closeModal()">×</button>
        </div>
        <div id="modalBody">
            <!-- Contenu chargé via JS -->
        </div>
    </div>
</div>
@endsection
