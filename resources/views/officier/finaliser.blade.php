@extends('layouts.app')
@section('titre')Finaliser l'acte @endsection
@section('content')
<div class="right_col" role="main">
    <h2 class="text-2xl font-semibold mb-6">Finaliser l'acte de naissance</h2>
    <div class="bg-white shadow rounded p-6 mb-6 max-w-2xl mx-auto">
        <h3 class="font-semibold mb-4">Détails de l'acte</h3>
        <ul class="mb-6">
            <li><strong>Numéro acte :</strong> {{ $acte->num_acte }}</li>
            <li><strong>Nom enfant :</strong> {{ $acte->prenom }} {{ $acte->nom }}</li>
            <li><strong>Date naissance :</strong> {{ $acte->date_naissance_enfant }}</li>
            <!-- Ajoute d'autres infos si besoin -->
        </ul>
        <form id="finalisation-form" method="POST" action="{{ route('officier.actes.finaliser.post', $acte->id) }}">
            @csrf
            <div class="mb-4">
                <label class="block font-semibold mb-2">Signature électronique (dessinez ci-dessous) :</label>
                <div class="border-2 border-gray-300 rounded-lg bg-white p-4 inline-block shadow-sm">
                    <canvas id="signature-pad" width="400" height="150" class="border border-gray-200 rounded" style="cursor: crosshair;"></canvas>
                </div>
                <input type="hidden" name="signature_image" id="signature_image">
                <div class="mt-3 space-x-2">
                    <button type="button" id="clear-signature" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition-colors">
                        <i class="fas fa-eraser mr-1"></i> Effacer
                    </button>
                    <span class="text-sm text-gray-600">Utilisez votre souris ou votre doigt pour signer</span>
                </div>
            </div>
            {{-- Aperçu du cachet supprimé ici --}}
            <div class="mb-4">
                <label class="block font-semibold mb-2">Aperçu de la signature :</label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 bg-gray-50 min-h-[100px] flex items-center justify-center">
                    <img id="signature-preview" src="" alt="Aperçu signature" style="max-width:300px; max-height:100px; display:none; border:1px solid #ccc; border-radius: 4px;">
                    <span id="no-signature-text" class="text-gray-500 text-sm">Aucune signature dessinée</span>
                </div>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Finaliser l'acte</button>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<style>
    #signature-pad {
        cursor: crosshair !important;
        -webkit-user-select: none !important;
        -moz-user-select: none !important;
        -ms-user-select: none !important;
        user-select: none !important;
        touch-action: none !important;
        -webkit-touch-callout: none !important;
        -webkit-tap-highlight-color: transparent !important;
        pointer-events: auto !important;
    }
    
    #signature-pad:focus {
        outline: none !important;
    }
    
    #signature-pad:hover {
        cursor: crosshair !important;
    }
    
    #signature-pad:active {
        cursor: crosshair !important;
    }
    
    /* Supprimer tout curseur de sélection */
    #signature-pad::selection {
        background: transparent !important;
    }
    
    #signature-pad::-moz-selection {
        background: transparent !important;
    }
    
    /* Supprimer les curseurs sur tous les éléments parents */
    .border-2.border-gray-300.rounded-lg.bg-white.p-4.inline-block.shadow-sm {
        cursor: default !important;
        -webkit-user-select: none !important;
        -moz-user-select: none !important;
        -ms-user-select: none !important;
        user-select: none !important;
    }
    
    /* Supprimer les curseurs sur le conteneur de signature */
    .mb-4 {
        cursor: default !important;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('signature-pad');
        if (!canvas) {
            console.error('Canvas signature-pad non trouvé');
            return;
        }
        
        const signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgb(255, 255, 255)',
            penColor: 'rgb(0, 0, 0)',
            minWidth: 0.5,
            maxWidth: 2.5,
            throttle: 16
        });
        
        // Forcer le curseur crosshair
        canvas.style.cursor = 'crosshair';
        canvas.addEventListener('mouseenter', function() {
            this.style.cursor = 'crosshair';
        });
        canvas.addEventListener('mousedown', function() {
            this.style.cursor = 'crosshair';
        });
        canvas.addEventListener('mousemove', function() {
            this.style.cursor = 'crosshair';
        });
        canvas.addEventListener('mouseup', function() {
            this.style.cursor = 'crosshair';
        });
        
        const signatureInput = document.getElementById('signature_image');
        const signaturePreview = document.getElementById('signature-preview');
        const noSignatureText = document.getElementById('no-signature-text');
        const clearBtn = document.getElementById('clear-signature');

        function updatePreview() {
            if (!signaturePad.isEmpty()) {
                const dataUrl = signaturePad.toDataURL();
                signaturePreview.src = dataUrl;
                signaturePreview.style.display = 'block';
                if (noSignatureText) {
                    noSignatureText.style.display = 'none';
                }
            } else {
                signaturePreview.src = '';
                signaturePreview.style.display = 'none';
                if (noSignatureText) {
                    noSignatureText.style.display = 'block';
                }
            }
        }

        signaturePad.onEnd = updatePreview;
        
        if (clearBtn) {
            clearBtn.addEventListener('click', function(e) {
                e.preventDefault();
                signaturePad.clear();
                updatePreview();
            });
        }

        const form = document.getElementById('finalisation-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                if (signaturePad.isEmpty()) {
                    alert('Veuillez dessiner votre signature.');
                    e.preventDefault();
                    return false;
                }
                signatureInput.value = signaturePad.toDataURL();
            });
        }
    });
</script>
@endpush 