import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

Alpine.plugin(collapse);

// Light/dark theme for the CRM. The initial class is set inline in the
// layout <head> to avoid a flash; this store keeps it in sync afterwards.
Alpine.store('theme', {
    dark: document.documentElement.classList.contains('dark'),
    toggle() {
        this.dark = !this.dark;
        document.documentElement.classList.toggle('dark', this.dark);
        try {
            localStorage.setItem('ft-theme', this.dark ? 'dark' : 'light');
        } catch (e) {}
    },
});

// x-reveal: fade content up as it scrolls into view.
Alpine.directive('reveal', (el, { expression }, { evaluate }) => {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    const delay = expression ? evaluate(expression) : 0;
    el.style.opacity = '0';
    el.style.transform = 'translateY(16px)';
    el.style.transition = `opacity .6s ease ${delay}ms, transform .6s ease ${delay}ms`;
    const observer = new IntersectionObserver(([entry]) => {
        if (entry.isIntersecting) {
            el.style.opacity = '1';
            el.style.transform = 'none';
            observer.disconnect();
        }
    }, { threshold: 0.15 });
    observer.observe(el);
});

// Multi-step quote wizard. Steps are plain fieldsets so the form still
// submits everything if JavaScript fails; the server re-validates.
Alpine.data('quoteWizard', (startStep = 0) => ({
    step: startStep,
    total: 4,
    next() {
        const fields = this.$refs['step' + this.step].querySelectorAll('input, select, textarea');
        for (const field of fields) {
            if (!field.checkValidity()) {
                field.reportValidity();
                return;
            }
        }
        if (this.step < this.total - 1) this.step++;
        this.$nextTick(() => this.$refs.wizard.scrollIntoView({ behavior: 'smooth', block: 'start' }));
    },
    back() {
        if (this.step > 0) this.step--;
    },
}));

window.Alpine = Alpine;
Alpine.start();
