// Seiteninhalt für jede Unterseite
const pages = {
    belege: {
        title: 'Ausgaben-Belege',
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
                <table>
                    <thead>
                        <tr>
                            <th>Belegnummer/Bezeichnung</th>
                            <th>Lieferant</th>
                            <th>Status</th>
                            <th class="amount-column">Betrag</th>
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
    anlagegueter: {
        title: 'Anlagegüter (AfA)',
        icon: 'chart-line',
        subtitle: 'Darstellung des Anlagespiegels',
        template: `
            <div class="info-box">
                <h3><i class="fas fa-info-circle"></i> Information</h3>
                <p>Es existieren keine Anlagegüter mit einem Restwert über 0 Euro</p>
                <p>Anlagegüter sind Gegenstände, welche über einen längeren Zeitraum im Unternehmen genutzt werden bzw. werthaltig sind wie z.B. Fahrzeuge, Maschinen, etc.</p>
                <p>Um ein neues Anlagegut anzulegen erfasse die Anschaffung als <a href="#belege">Ausgabe-Beleg</a> und wähle dort als Kategorie eine passende Anlagekategorie.</p>
                <p>Anschließend findest du hier eine Übersicht mit den jeweiligen Abschreibungswerten.</p>
            </div>
            <div class="action-bar">
                <button class="btn btn-primary">+ Neues Anlagegut</button>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Bezeichnung</th>
                            <th>Anschaffungsdatum</th>
                            <th>Anschaffungskosten</th>
                            <th>Nutzungsdauer</th>
                            <th>Restwert</th>
                            <th>Abschreibung p.a.</th>
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
    'offene-posten': {
        title: 'Offene Posten',
        icon: 'clock',
        subtitle: 'Unbezahlte Ausgaben-Belege',
        template: `
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Belegnummer/Bezeichnung</th>
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

    // Standardmäßig Belege laden
    loadContent('belege');
});