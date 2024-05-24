import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["content", "lightIcon", "darkIcon"]

    toggle() {
        let isThemeDark = this.contentTarget.classList.toggle("dark");

        if (isThemeDark) {
            this.lightIconTarget.classList.remove('hidden');
            this.darkIconTarget.classList.add('hidden');
        } else {
            this.lightIconTarget.classList.add('hidden');
            this.darkIconTarget.classList.remove('hidden');
        }
    }
}
