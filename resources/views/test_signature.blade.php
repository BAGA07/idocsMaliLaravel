<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Test SignaturePad</title>
</head>
<body>
    <canvas id="signature-pad" width="350" height="120" style="border:1px solid #000; cursor:crosshair;"></canvas>
    <button id="clear-signature">Effacer</button>
    <img id="signature-preview" style="display:none; border:1px solid #ccc; width:200px;">
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const canvas = document.getElementById('signature-pad');
            const signaturePad = new SignaturePad(canvas);
            const clearBtn = document.getElementById('clear-signature');
            const preview = document.getElementById('signature-preview');

            function updatePreview() {
                if (!signaturePad.isEmpty()) {
                    const dataUrl = signaturePad.toDataURL();
                    preview.src = dataUrl;
                    preview.style.display = 'block';
                } else {
                    preview.style.display = 'none';
                }
            }

            signaturePad.onEnd = updatePreview;
            clearBtn.onclick = function() {
                signaturePad.clear();
                preview.style.display = 'none';
            };
        });
    </script>
</body>
</html> 