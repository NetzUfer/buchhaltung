// Seiteninhalt für jede Unterseite
const pages = {
    angebote: {
        title: 'Angebote',
        icon: 'file-invoice',
        subtitle: 'Übersicht deiner aktuellen Angebote',
        template: `
            <div class="action-bar">
                <button class="btn btn-primary">+ Neues Angebot</button>
                <div class="action-group">
                    <button class="btn btn-outline">Löschen</button>
                    <button class="btn btn-outline">Archivieren</button>
                    <button class="btn btn-outline">PDF</button>
                    <button class="btn btn-outline">CSV</button>
                </div>
            </div>
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Angeb...</th>
                            <th>Projekt/Kunde</th>
                            <th>Status</th>
                            <th>Abrechnung</th>
                            <th>Datum</th>
                            <th>Betrag</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="empty-state">
                            <td colspan="6">Keine Einträge vorhanden</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        `
    },
    rechnungen: {
        title: 'Rechnungen',
        icon: 'file-invoice-dollar',
        subtitle: 'Übersicht deiner Rechnungen an Kunden',
        template: `
            <div class="action-bar">
                <div class="left-actions">
                    <button class="btn btn-outline">Neu aus erfassten Leistungen</button>
                    <button class="btn btn-primary">+ Neue Rechnung</button>
                </div>
                <div class="right-actions">
                    <button class="btn btn-outline">PDF</button>
                    <button class="btn btn-outline">CSV</button>
                </div>
            </div>
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Rechnu...</th>
                            <th>Projekt/Kunde</th>
                            <th>Status</th>
                            <th>Datum</th>
                            <th>Fällig am</th>
                            <th>Betrag</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="empty-state">
                            <td colspan="6">Keine Einträge vorhanden</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        `
    },
    belege: {
        title: 'Einnahmen-Belege',
        icon: 'receipt',
        subtitle: 'Übersicht aller erfassten Belege',
        template: `
            <div class="action-bar">
                <button class="btn btn-primary">+ Neuer Beleg</button>
                <div class="action-group">
                    <button class="btn btn-outline">Löschen</button>
                    <button class="btn btn-outline">Archivieren</button>
                    <button class="btn btn-outline">PDF</button>
                    <button class="btn btn-outline">CSV</button>
                </div>
            </div>
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Belegnummer/Bezeichnung</th>
                            <th>Kunde</th>
                            <th>Status</th>
                            <th>Betrag</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="empty-state">
                            <td colspan="4">Keine Einträge vorhanden</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        `
    },
    lieferscheine: {
        title: 'Lieferscheine',
        icon: 'truck',
        subtitle: 'Lieferscheine an deine Kunden erstellen, bearbeiten und verfolgen',
        template: `
            <div class="action-bar">
                <button class="btn btn-primary">+ Neuer Lieferschein</button>
                <div class="action-group">
                    <button class="btn btn-outline">Löschen</button>
                    <button class="btn btn-outline">Archivieren</button>
                    <button class="btn btn-outline">CSV</button>
                </div>
            </div>
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Lieferscheinnummer/Bet...</th>
                            <th>Projekt/Kunde</th>
                            <th>Status</th>
                            <th>Datum</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="empty-state">
                            <td colspan="4">Keine Einträge vorhanden</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        `
    },
    mahnungen: {
        title: 'Mahnungen',
        icon: 'exclamation-circle',
        subtitle: 'Mahnungen für offene Rechnungen an deine Kunden',
        template: `
            <div class="info-box">
                <i class="fas fa-info-circle"></i>
                <p>Erstelle Mahnungen, indem du in der abgeschlossenen Rechnung die Aktion "Mahnung erstellen" verwendest.</p>
            </div>
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Rechnung</th>
                            <th>Proj...</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Datum der Mahnung</th>
                            <th>Fälligkeit der Rechnung</th>
                            <th>Betrag der Rechnung</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="empty-state">
                            <td colspan="7">Keine Einträge vorhanden</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        `
    },
    'offene-posten': {
        title: 'Offene Posten',
        icon: 'clock',
        subtitle: 'Unbezahlte Rechnungen und Einnahmebelege',
        template: `
            <div class="tab-group">
                <div class="tab active">Rechnungen</div>
                <div class="tab">Belege</div>
            </div>
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Rechnungsnummer/Betreff</th>
                            <th>Kunde</th>
                            <th>Status</th>
                            <th>Datum</th>
                            <th>Fällig am</th>
                            <th>Betrag</th>
                            <th>offener Betrag</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="empty-state">
                            <td colspan="7">Keine Einträge vorhanden</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        `
    }
};

// Seiteninhalte laden
function loadContent(pageId) {
    const content = document.getElementById('content');
    const page = pages[pageId];
    
    if (page) {
        content.innerHTML = `
            <div class="page-header">
                <div class="page-title">
                    <i class="fas fa-${page.icon}"></i>
                    <h1>${page.title}</h1>
                </div>
                <p class="page-subtitle">${page.subtitle}</p>
            </div>
            ${page.template}
        `;
    }
}

// Event Listener für Navigation
document.addEventListener('DOMContentLoaded', () => {
    const menuItems = document.querySelectorAll('.menu-item');
    
    menuItems.forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            const pageId = e.currentTarget.getAttribute('href').replace('#', '');
            loadContent(pageId);
            
            menuItems.forEach(i => i.classList.remove('active'));
            e.currentTarget.classList.add('active');
        });
    });

    // Standardmäßig Angebote laden
    loadContent('angebote');
});