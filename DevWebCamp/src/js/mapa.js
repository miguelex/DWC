if (document.querySelector('#mapa')) {
    const lat = 37.2095128;
    const lon = -6.9264627;
    const zoom = 16;

    const map = L.map('mapa').setView([lat, lon], zoom);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([lat, lon]).addTo(map)
        .bindPopup(`
            <h2 class="mapa__heading">DevWebCamp 2025</h2>
            <p class="mapa__texto">Foro Iberoamericano de La Rábida</p>
            `)
        .openPopup();
}