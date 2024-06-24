import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["scroll", "item"];

    connect() {
        this.scrollTarget.addEventListener('scroll', () => this.changeBackgroundColor());
    }
    changeBackgroundColor() {
        if(this.scrollTarget.scrollTop === this.scrollTarget.scrollTopMax) {
            this.itemTarget.classList.add('sm:dark:bg-neutral-darker');
        } else {
            this.itemTarget.classList.remove('sm:dark:bg-neutral-darker');
        }
    }
}
