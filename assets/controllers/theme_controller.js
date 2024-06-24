import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["content", "lightIcon", "darkIcon", "button"]

    connect() {
        this.toggle();
    }

    toggle() {
        this.contentTarget.classList.toggle("dark");

        if (matchMedia("(prefers-color-scheme:dark)").matches) {
            this.lightIconTargets.forEach(element => {
                element.classList.remove('hidden')
            });
            this.darkIconTargets.forEach(element => {
                element.classList.add('hidden')
            });
        } else {
            this.lightIconTargets.forEach(element => {
                element.classList.add('hidden')
            });
            this.darkIconTargets.forEach(element => {
                element.classList.remove('hidden')
            });
        }
    }
}