// Seiteninhalt für jede Unterseite
const pages = {
    cashflow: {
        title: 'Cashflow',
        icon: 'chart-line',
        subtitle: 'Übersicht aller Einnahmen und Ausgaben',
        template: `
            <div class="chart-container">
                <div class="chart-header">
                    <h2>Cashflow-Entwicklung</h2>
                    <div class="chart-controls">
                        <button class="btn btn-outline">Stornos anzeigen?</button>
                        <select class="year-select">
                            <option>2025</option>
                        </select>
                    </div>
                </div>
                <canvas id="cashflowChart"></canvas>
            </div>
            <div class="month-navigation">
                <button><i class="fas fa-chevron-left"></i></button>
                <span class="current-month">Mai 2025</span>
                <button><i class="fas fa-chevron-right"></i></button>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Tag</th>
                            <th>Zahlung-Nr.</th>
                            <th>Referenz-Nr.</th>
                            <th>Name</th>
                            <th class="amount-column">Betrag</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="empty-state">
                            <td colspan="5">Keine Einträge verfügbar</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        `
    },
    bwa: {
        title: 'Betriebswirtschaftliche Auswertung',
        icon: 'file-invoice',
        subtitle: 'BWA von 01.01.2025 bis 15.05.2025',
        template: `
            <div class="chart-header">
                <div class="chart-controls">
                    <select class="period-select">
                        <option>Dieses Jahr bis heute</option>
                    </select>
                    <button class="btn btn-outline">
                        <i class="fas fa-file-pdf"></i> PDF
                    </button>
                </div>
            </div>
            <div class="info-box">
                <i class="fas fa-info-circle"></i>
                <p>Die BWA ist eine standardisierte Auswertung, die dir die Ertragslage deines Unternehmens sowie wichtige betriebswirtschaftliche Kennzahlen darstellt.</p>
            </div>
            <table class="bwa-table">
                <thead>
                    <tr>
                        <th>Zeile</th>
                        <th>Beschreibung</th>
                        <th>01.01.2025 - 15.05.2025</th>
                        <th>01.01.2024 - 15.05.2024</th>
                        <th>Monetär</th>
                        <th>Prozentual</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bwa-row">
                        <td>1051</td>
                        <td>Gesamtleistung</td>
                        <td class="amount-cell">0</td>
                        <td class="amount-cell">0</td>
                        <td class="amount-cell">0</td>
                        <td class="change-cell">0% <i class="fas fa-arrow-right"></i></td>
                    </tr>
                    <!-- Weitere BWA-Zeilen hier -->
                </tbody>
            </table>
        `
    },
    eur: {
        title: 'Einnahmenüberschussrechnung (EÜR)',
        icon: 'calculator',
        subtitle: 'für das Jahr 2025',
        template: `
            <div class="chart-controls">
                <select class="year-select">
                    <option>2025</option>
                </select>
                <button class="btn btn-outline">
                    <i class="fas fa-file-pdf"></i> PDF
                </button>
            </div>
            <div class="eur-section">
                <h3>Betriebseinnahmen</h3>
                <p>Keine Angaben.</p>
            </div>
            <div class="eur-section">
                <h3>Betriebsausgaben (einschl. auf steuerfreie Betriebseinnahmen entfallende Betriebsausgaben)</h3>
                <p>Keine Angaben.</p>
            </div>
            <div class="eur-section">
                <h3>Entnahmen und Einlagen i. S. d. § 4 Abs. 4a EStG</h3>
                <p>Keine Angaben.</p>
            </div>
            <div class="eur-total">
                <span>Überschuss: </span>
                <span class="amount">€ 0,00</span>
            </div>
        `
    },
    ustva: {
        title: 'Umsatzsteuervoranmeldungen',
        icon: 'percent',
        subtitle: 'für das Jahr 2025',
        template: `
            <div class="chart-controls">
                <select class="year-select">
                    <option>2025</option>
                </select>
                <span>monatlich</span>
                <button class="btn btn-outline">
                    <i class="fas fa-eye-slash"></i>
                </button>
                <button class="btn btn-outline">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <div class="tax-period-list">
                <div class="tax-period-item">
                    <span class="month">Januar</span>
                    <span class="amount">€ 0,00</span>
                    <span class="status status-open">offen</span>
                </div>
                <!-- Weitere Monate hier -->
            </div>
            <div class="steps-container">
                <div class="step">
                    <h3>Schritt 1: Abgabe</h3>
                    <div class="step-content">
                        <p>Lade das Elster-XML herunter, um es im ElsterOnline-Portal für die Umsatzsteuervoranmeldung hochzuladen.</p>
                        <div class="warning-box">
                            <h4>Für ein korrektes Elster-XML, prüfe bitte diese Hinweise:</h4>
                            <ul>
                                <li>Bundesland muss ausgefüllt werden</li>
                                <li>Elster-steuernummer ist nicht gültig</li>
                                <li>Steuernummer muss ausgefüllt werden</li>
                                <li>Bitte gib Postleitzahl, Ort und Staat der Adresse an.</li>
                            </ul>
                        </div>
                        <button class="btn btn-primary">Elster-XML herunterladen</button>
                    </div>
                </div>
                <div class="step">
                    <h3>Schritt 2: Buchen</h3>
                    <div class="step-content">
                        <p>Nachdem du die UStVA abgegeben hast, musst du dies verbuchen, indem du dazu einen Beleg erstellst:</p>
                        <button class="btn btn-primary">Beleg erstellen</button>
                    </div>
                </div>
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

        // Charts initialisieren
        if (pageId === 'cashflow') {
            initCashflowChart();
        }
    }
}

// Cashflow-Chart initialisieren
function initCashflowChart() {
    const ctx = document.getElementById('cashflowChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Mai \'24', 'Jun \'24', 'Jul \'24', 'Aug \'24', 'Sep \'24', 
                     'Okt \'24', 'Nov \'24', 'Dez \'24', 'Jan \'25', 'Feb \'25', 
                     'Mär \'25', 'Apr \'25', 'Mai \'25'],
            datasets: [{
                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                borderColor: '#27AE60',
                backgroundColor: 'rgba(39, 174, 96, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '€ ' + value;
                        }
                    }
                }
            }
        }
    });
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

    // Standardmäßig Cashflow laden
    loadContent('cashflow');
});