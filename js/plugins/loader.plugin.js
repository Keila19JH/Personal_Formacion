
function ensureOverlayExists() {
    let overlay = document.getElementById('loading-overlay');
    if (!overlay) {
        overlay = document.createElement('div');
        overlay.id = 'loading-overlay';
        overlay.style.position = 'fixed';
        overlay.style.top = '0';
        overlay.style.left = '0';
        overlay.style.width = '100%';
        overlay.style.height = '100%';
        overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
        overlay.style.display = 'none'; // Inicialmente oculto
        overlay.style.justifyContent = 'center';
        overlay.style.alignItems = 'center';
        overlay.style.zIndex = '9999';
        document.body.appendChild(overlay);
    }
}

export function showLoadingOverlay() {
    ensureOverlayExists(); // Asegura que el overlay exista antes de usarlo
    const overlay = document.getElementById('loading-overlay');
    overlay.style.display = 'flex';
}

export function hideLoadingOverlay() {
    ensureOverlayExists(); // Asegura que el overlay exista antes de usarlo
    const overlay = document.getElementById('loading-overlay');
    overlay.style.display = 'none';
}





/*

export function hideLoadingOverlay() {
    const overlay = document.getElementById( "overlay" );
    console.log( "Elemento overlay;", overlay )
    if( overlay ){
        overlay.style.display = "none";
    } else {
        console.error("No se encontro el overlay");
    }
}

*/
