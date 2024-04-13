document.getElementById("fileInput").addEventListener("change", function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const pdfViewer = document.getElementById("pdfViewer");
            const arrayBuffer = e.target.result;
            pdfViewer.src = "data:application/pdf;base64," + arrayBufferToBase64(arrayBuffer);
            displayMessage("¡El archivo PDF se ha cargado correctamente!");
        };
        reader.readAsArrayBuffer(file);
    }
});

document.getElementById("signButton").addEventListener("click", function() {
    displayMessage("Iniciando proceso de firma digital...");
});

function displayMessage(message) {
    const feedbackMessage = document.getElementById("feedbackMessage");
    feedbackMessage.textContent = message;
}

function arrayBufferToBase64(buffer) {
    let binary = "";
    const bytes = new Uint8Array(buffer);
    const len = bytes.byteLength;
    for (let i = 0; i < len; i++) {
        binary += String.fromCharCode(bytes[i]);
    }
    return btoa(binary);
}
