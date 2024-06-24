import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["time", "month", "year", "calendar", "input"]
    static values = {
        day: String,
        month: Number,
        year: Number,
        time: String
    }

    connect() {
        const saveButtons = document.getElementsByName('save');
        this.monthValue =  new Date().getMonth();
        this.yearValue =  new Date().getFullYear();
        this.timeValue = new Date().toLocaleDateString("en", {dateStyle: 'medium'});

        this.timeTarget.textContent = this.formattedTime();
        this.setMonth();
        this.setYear();
        this.renderDaysInMonth();
        for(let button of saveButtons) {
            button.dataset.livePaymentDueParam = new Date().toISOString("en")
        }
    }

    formattedTime() {
        return this.timeValue.replace(',', '');
    }

    formattedMonth() {
        const monthNames = ["January","February","March","April","May","June","July","August","September","October","November","December"];
        return monthNames[this.monthValue].slice(0, 3);
    }

    renderDaysInMonth() {
        this.calendarTarget.innerHTML = "";
        for (let day = 1; day <= 31; day++) {
            let date = new Date(this.yearValue, this.monthValue, day).getDate();

            if(day > date) {
                this.calendarTarget.innerHTML += `
                <li class="flex justify-center">
                    <p class="font-bold body-variant text-neutral-darkest/10 dark:text-neutral-lightest">${date}</p>
                </li>`;
            } else {
                this.calendarTarget.innerHTML += `
                <li class="flex justify-center">
                    <button type="button" data-action="datepicker#pickDate dropdown#close2" value="${date}" class="dark:text-neutral-lightest self-center cursor-pointer font-bold body-variant text-neutral-darkest hover:text-primary">${date}</button>
                </li>`;
            }
        }
    }

    incrementMonth() {
        if (this.monthValue > 10) {
            this.monthValue = 0;
            this.incrementYear();
        } else {
            this.monthValue++;
        }
        this.setMonth();
        this.setYear();
        this.renderDaysInMonth();
    }

    decrementMonth() {
        if (this.monthValue < 1) {
            this.monthValue = 11;
            this.decrementYear();
        } else {
            this.monthValue--;
        }
        this.setMonth();
        this.setYear();
        this.renderDaysInMonth();
    }

    incrementYear() {
        this.yearValue++;
    }

    decrementYear() {
        this.yearValue--;
    }

    setMonth() {
        this.monthTarget.textContent = this.formattedMonth();
    }

    setYear() {
        this.yearTarget.textContent = this.yearValue;
    }

    pickDate(event) {
        const saveButtons = document.getElementsByName('save');

        this.dayValue = event.target.value;
        this.timeValue = new Date(this.yearValue, this.monthValue, this.dayValue).toLocaleDateString("en", {dateStyle: 'medium'})
        this.timeTarget.textContent = this.formattedTime();
        for(let button of saveButtons) {
            button.dataset.livePaymentDueParam = new Date(this.yearValue, this.monthValue, Number(this.dayValue)+1).toISOString("en")
        }
    }
}
