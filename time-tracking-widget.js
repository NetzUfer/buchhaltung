class TimeTracker {
    constructor() {
        this.isRunning = false;
        this.startTime = null;
        this.timer = null;
        this.duration = 0;

        this.timerDisplay = document.querySelector('.timer-display');
        this.startButton = document.querySelector('.btn-start');
        this.durationDisplay = document.querySelector('.timer-duration');

        this.initializeEventListeners();
    }

    initializeEventListeners() {
        // Start/Stop Button
        this.startButton.addEventListener('click', () => {
            if (this.isRunning) {
                this.stopTimer();
            } else {
                this.startTimer();
            }
        });

        // Form Submit
        document.querySelector('.tracking-form').addEventListener('submit', (e) => {
            e.preventDefault();
            this.saveTimeEntry();
        });

        // Toggle Billable Button
        document.querySelector('.btn-toggle').addEventListener('click', (e) => {
            e.target.classList.toggle('active');
        });

        // Delete Button
        document.querySelector('.btn-delete').addEventListener('click', () => {
            this.resetForm();
        });
    }

    startTimer() {
        this.isRunning = true;
        this.startTime = Date.now() - (this.duration * 1000);
        this.startButton.classList.add('active');
        this.startButton.innerHTML = '<i class="fas fa-stop"></i>';

        this.timer = setInterval(() => {
            this.duration = Math.floor((Date.now() - this.startTime) / 1000);
            this.updateDisplay();
        }, 1000);
    }

    stopTimer() {
        this.isRunning = false;
        clearInterval(this.timer);
        this.startButton.classList.remove('active');
        this.startButton.innerHTML = '<i class="fas fa-play"></i>';
    }

    updateDisplay() {
        // Timer Display
        const hours = Math.floor(this.duration / 3600);
        const minutes = Math.floor((this.duration % 3600) / 60);
        const seconds = this.duration % 60;

        this.timerDisplay.textContent = [
            hours.toString().padStart(2, '0'),
            minutes.toString().padStart(2, '0'),
            seconds.toString().padStart(2, '0')
        ].join(':');

        // Duration Display
        if (hours > 0) {
            this.durationDisplay.textContent = `${hours}h ${minutes}m`;
        } else {
            this.durationDisplay.textContent = `${minutes}m`;
        }
    }

    saveTimeEntry() {
        // Hier später die Speicherlogik implementieren
        const formData = {
            project: document.getElementById('project').value,
            task: document.getElementById('task').value,
            comment: document.getElementById('comment').value,
            duration: this.duration,
            date: new Date().toISOString(),
            billable: document.querySelector('.btn-toggle').classList.contains('active')
        };

        console.log('Saving time entry:', formData);
        this.resetForm();
    }

    resetForm() {
        this.stopTimer();
        this.duration = 0;
        this.updateDisplay();

        document.querySelector('.tracking-form').reset();
    }
}

// Timer initialisieren
document.addEventListener('DOMContentLoaded', () => {
    new TimeTracker();
});