import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["select", "option", "dropdown"]
    static values = {
        label: String
    }

    select(event) {
        this.selectTarget.textContent = event.target.dataset.choiceLabelValue;
        this.dropdownTarget.open = false;
    }
}
