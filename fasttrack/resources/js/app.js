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

// Multi-step quote wizard with a live price estimate. Steps are plain
// fieldsets so the form still submits everything if JavaScript fails; the
// server re-validates and recalculates the estimate.
Alpine.data('quoteWizard', (startStep = 0, estimateUrl = '') => ({
    step: startStep,
    total: 4,
    service: '',
    estimate: null,
    loading: false,
    timer: null,
    init() {
        this.syncService();
        this.$refs.form.addEventListener('submit', () => clearTimeout(this.timer));
        this.$refs.form.addEventListener('input', () => this.queue());
        this.$refs.form.addEventListener('change', () => {
            this.syncService();
            this.queue();
        });
        this.refresh();
    },
    syncService() {
        this.service = this.$refs.form.querySelector('[name=service]:checked')?.value ?? '';
    },
    queue() {
        clearTimeout(this.timer);
        this.timer = setTimeout(() => this.refresh(), 400);
    },
    async refresh() {
        if (!estimateUrl) return;
        this.loading = true;
        try {
            const res = await fetch(estimateUrl, {
                method: 'POST',
                headers: { Accept: 'application/json' },
                body: new FormData(this.$refs.form),
            });
            if (res.ok) this.estimate = await res.json();
        } catch (e) {
            // Keep the last estimate; the server recalculates on submit anyway.
        } finally {
            this.loading = false;
        }
    },
    money(value) {
        return '£' + Math.round(value).toLocaleString('en-GB');
    },
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

// Cookie notice. Analytics and ad pixels should listen for the
// "cookies-accepted" event (or check consent()) before loading.
Alpine.data('cookieBanner', () => ({
    show: false,
    init() {
        this.show = !this.consent();
    },
    consent() {
        try {
            return localStorage.getItem('ft-cookies');
        } catch (e) {
            return null;
        }
    },
    choose(level) {
        try {
            localStorage.setItem('ft-cookies', level);
        } catch (e) {}
        this.show = false;
        if (level === 'all') window.dispatchEvent(new CustomEvent('cookies-accepted'));
    },
}));

window.Alpine = Alpine;
Alpine.start();
