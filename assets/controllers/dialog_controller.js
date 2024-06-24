import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["dialog"]

    connect() {
        this.close();
    }

    open() {
        this.dialogTarget.showModal();
    }

    close() {
        this.dialogTarget.close();
    }
}