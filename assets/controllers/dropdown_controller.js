import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["details"]

    connect() {
        this.detailsTarget.open = false;
    }

    close(event) {
        if ( ! this.detailsTarget.contains(event.target)) {
            this.detailsTarget.open = false;
        }
    }

    close2() {
        this.detailsTarget.open = false;
    }
}
