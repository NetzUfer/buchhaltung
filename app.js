// Temporärer Datenspeicher (wird später durch Datenbank ersetzt)
const tempData = {
    contacts: [],
    projects: [],
    accounts: []
};

// Routing
const routes = {
    addressbook: {
        title: 'Adressbuch',
        template: `
            <div class="section-header">
                <h1>Adressbuch</h1>
                <button class="btn btn-primary">+ Neuer Kontakt</button>
            </div>
            <div class="empty-state">
                Keine Einträge vorhanden
            </div>
        `
    },
    projects: {
        title: 'Projekte',
        template: `
            <div class="section-header">
                <h1>Projekte</h1>
                <button class="btn btn-primary">+ Neues Projekt</button>
            </div>
            <div class="empty-state">
                Heute ist der große Tag! Lege dein erstes Projekt an.
            </div>
        `
    },
    accounts: {
        title: 'Konten',
        template: `
            <div class="section-header">
                <h1>Konten</h1>
                <button class="btn btn-primary">+ Neues Konto</button>
            </div>
            <div class="account-types">
                <div class="account-type">
                    <i class="fas fa-university account-icon"></i>
                    <h3>Bankkonto (offline)</h3>
                    <p>Ohne automatischen Abgleich</p>
                </div>
                <div class="account-type">
                    <i class="fas fa-globe account-icon"></i>
                    <h3>Bankkonto (online)</h3>
                    <p>Inkl. Online-Synchronisation für Girokonten</p>
                </div>
                <div class="account-type">
                    <i class="fab fa-paypal account-icon"></i>
                    <h3>PayPal</h3>
                    <p>Inkl. Online-Synchronisation</p>
                </div>
                <div class="account-type">
                    <i class="fas fa-credit-card account-icon"></i>
                    <h3>Kreditkarte</h3>
                    <p>Inkl. Online-Synchronisation</p>
                </div>
                <div class="account-type">
                    <i class="fas fa-cash-register account-icon"></i>
                    <h3>Kasse</h3>
                    <p>Kassenbuch</p>
                </div>
            </div>
        `
    }
};

// Seiteninhalte laden
function loadContent(route) {
    const content = document.getElementById('content');
    const currentRoute = routes[route];
    
    if (currentRoute) {
        document.title = `${currentRoute.title} - Freiberufler Buchhaltung`;
        content.innerHTML = currentRoute.template;
    }
}

// Event Listener für Navigation
document.addEventListener('DOMContentLoaded', () => {
    const menuItems = document.querySelectorAll('.menu-item');
    
    menuItems.forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            const route = e.currentTarget.getAttribute('href').replace('.html', '');
            loadContent(route.replace('/', ''));
            
            // Aktiven Menüpunkt markieren
            menuItems.forEach(i => i.classList.remove('active'));
            e.currentTarget.classList.add('active');
        });
    });

    // Standardmäßig Adressbuch laden
    loadContent('addressbook');
});