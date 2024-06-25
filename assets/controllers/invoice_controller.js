import { Controller } from '@hotwired/stimulus';
import { getComponent } from '@symfony/ux-live-component';
export default class extends Controller {
    static targets = ["button", "filter", "counter"];
    static values = {
        statuses: Array,
        count: Number,
    }

    async initialize() {
        this.component = await getComponent(this.element);
        this.component.on('render:finished', () => {
            this.renderTextContent()
        });
    }

    connect() {
        this.renderTextContent();
        addEventListener('resize', () => this.renderTextContent());
    }

    renderTextContent() {
        const statuses = this.statusesValue.length === 0 ? "total" : this.statusesValue.join(', ');
        const breakpoint = "(min-width: 641px)";
        const buttonTextContent = { small: "New", medium: "New Invoice" };
        const filterTextContent = { small: "Filter", medium: "Filter by status" };
        const counterTextContent = {
            small: `${this.countValue} invoices`,
            medium: `There are ${this.countValue} ${statuses} invoices`
        };

        if (window.matchMedia(breakpoint).matches) {
            this.buttonTarget.textContent = buttonTextContent.medium;
            this.filterTarget.textContent = filterTextContent.medium;
            this.counterTarget.textContent = counterTextContent.medium;
        } else {
            this.buttonTarget.textContent = buttonTextContent.small;
            this.filterTarget.textContent = filterTextContent.small;
            this.counterTarget.textContent = counterTextContent.small;
        }
    }
}
