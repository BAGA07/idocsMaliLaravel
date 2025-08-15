@extends('layouts.app')
@section('titre')Finaliser la copie/extrait @endsection
@section('content')
<div class="right_col" role="main">
    <h2 class="text-2xl font-semibold mb-6">Finaliser la copie/extrait</h2>
    <div class="bg-white shadow rounded p-6 mb-6 max-w-2xl mx-auto">
        <h3 class="font-semibold mb-4">Détails de la copie/extrait</h3>
        <ul class="mb-6">
            <li><strong>Numéro acte :</strong> {{ $copie->num_acte }}</li>
            <li><strong>Nom enfant :</strong> {{ $copie->prenom }} {{ $copie->nom }}</li>
            <li><strong>Date naissance :</strong> {{ $copie->date_naissance_enfant }}</li>
            <li><strong>Lieu naissance :</strong> {{ $copie->lieu_naissance_enfant }}</li>
            <li><strong>Sexe :</strong> {{ $copie->sexe_enfant == 'M' ? 'Masculin' : 'Féminin' }}</li>
        </ul>
        <form id="finalisation-form" method="POST" action="{{ route('officier.copies.finaliser.post', $copie->id) }}">
            @csrf
            <div class="mb-4">
                <label class="block font-semibold mb-2">Signature électronique (dessinez ci-dessous) :</label>
                <div class="border-2 border-gray-300 rounded bg-white p-4 inline-block">
                    <canvas id="signature-canvas" width="350" height="120" style="border: 2px solid #000; cursor: default; background-color: white;"></canvas>
                </div>
                <input type="hidden" name="signature_image" id="signature_image">
                <div class="mt-2">
                    <button type="button" id="clear-signature" class="bg-gray-300 px-2 py-1 rounded">Effacer</button>
                </div>

            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-2">Aperçu de la signature :</label>
                <img id="signature-preview" src="" alt="Aperçu signature" style="width:200px; display:none; border:1px solid #ccc;">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Finaliser la copie/extrait</button>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing signature...');
    
    const canvas = document.getElementById('signature-canvas');
    
    if (!canvas) {
        console.error('Canvas not found!');
        return;
    }
    
    console.log('Canvas found:', canvas);
    
    const ctx = canvas.getContext('2d');
    const signatureInput = document.getElementById('signature_image');
    const signaturePreview = document.getElementById('signature-preview');
    const clearBtn = document.getElementById('clear-signature');
    
    if (!ctx) {
        console.error('Canvas context not available!');
        return;
    }
    
    let isDrawing = false;
    let hasDrawn = false;
    
    // Configuration du style de dessin
    ctx.strokeStyle = '#000000';
    ctx.lineWidth = 2;
    ctx.lineCap = 'round';
    ctx.lineJoin = 'round';
    
    console.log('Canvas context configured');
    
    // Fonction pour obtenir les coordonnées de la souris/tactile
    function getMousePos(canvas, e) {
        const rect = canvas.getBoundingClientRect();
        const scaleX = canvas.width / rect.width;
        const scaleY = canvas.height / rect.height;
        
        if (e.type.includes('touch')) {
            return {
                x: (e.touches[0].clientX - rect.left) * scaleX,
                y: (e.touches[0].clientY - rect.top) * scaleY
            };
        } else {
            return {
                x: (e.clientX - rect.left) * scaleX,
                y: (e.clientY - rect.top) * scaleY
            };
        }
    }
    
    // Événements de souris
    canvas.addEventListener('mousedown', function(e) {
        console.log('Mouse down event');
        startDrawing(e);
    });
    canvas.addEventListener('mousemove', function(e) {
        if (isDrawing) {
            console.log('Mouse move while drawing');
        }
        draw(e);
    });
    canvas.addEventListener('mouseup', function(e) {
        console.log('Mouse up event');
        stopDrawing(e);
    });
    canvas.addEventListener('mouseout', function(e) {
        console.log('Mouse out event');
        stopDrawing(e);
    });
    
    // Événements tactiles
    canvas.addEventListener('touchstart', function(e) {
        console.log('Touch start event');
        startDrawing(e);
    });
    canvas.addEventListener('touchmove', function(e) {
        if (isDrawing) {
            console.log('Touch move while drawing');
        }
        draw(e);
    });
    canvas.addEventListener('touchend', function(e) {
        console.log('Touch end event');
        stopDrawing(e);
    });
    
    function startDrawing(e) {
        e.preventDefault();
        console.log('Starting to draw');
        isDrawing = true;
        hasDrawn = true;
        const pos = getMousePos(canvas, e);
        console.log('Drawing position:', pos);
        ctx.beginPath();
        ctx.moveTo(pos.x, pos.y);
    }
    
    function draw(e) {
        e.preventDefault();
        if (!isDrawing) return;
        
        const pos = getMousePos(canvas, e);
        ctx.lineTo(pos.x, pos.y);
        ctx.stroke();
    }
    
    function stopDrawing() {
        console.log('Stopping drawing');
        isDrawing = false;
        updatePreview();
    }
    
    function updatePreview() {
        if (hasDrawn) {
            const dataUrl = canvas.toDataURL('image/png');
            signaturePreview.src = dataUrl;
            signaturePreview.style.display = 'block';
            console.log('Preview updated, data length:', dataUrl.length);
        } else {
            signaturePreview.style.display = 'none';
        }
    }
    
    clearBtn.onclick = function() {
        console.log('Clearing signature');
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        hasDrawn = false;
        signaturePreview.style.display = 'none';
    };
    
    document.getElementById('finalisation-form').addEventListener('submit', function(e) {
        console.log('Form submission, hasDrawn:', hasDrawn);
        if (!hasDrawn) {
            alert('Veuillez dessiner votre signature avant de finaliser.');
            e.preventDefault();
            return false;
        }
        
        const dataUrl = canvas.toDataURL('image/png');
        signatureInput.value = dataUrl;
        console.log('Signature data set in form, length:', dataUrl.length);
    });
});
</script>
@endpush 