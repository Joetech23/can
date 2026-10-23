const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

document.documentElement.classList.remove('no-js');

/**
 * Sticky header: solid background once the page scrolls.
 */
function initHeader() {
    const header = document.querySelector('[data-header]');

    if (!header) {
        return;
    }

    const update = () => header.classList.toggle('is-scrolled', window.scrollY > 24);

    update();
    window.addEventListener('scroll', update, { passive: true });
}

/**
 * Mobile navigation drawer.
 */
function initMobileNav() {
    const toggle = document.querySelector('[data-nav-toggle]');
    const panel = document.querySelector('[data-nav-panel]');

    if (!toggle || !panel) {
        return;
    }

    const setOpen = (isOpen) => {
        toggle.setAttribute('aria-expanded', String(isOpen));
        panel.classList.toggle('pointer-events-none', !isOpen);
        panel.classList.toggle('opacity-0', !isOpen);
        panel.classList.toggle('-translate-y-4', !isOpen);
        document.body.classList.toggle('overflow-hidden', isOpen);
        toggle.querySelectorAll('[data-nav-icon]').forEach((icon) => {
            icon.classList.toggle('hidden', icon.dataset.navIcon !== (isOpen ? 'close' : 'open'));
        });
    };

    toggle.addEventListener('click', () => setOpen(toggle.getAttribute('aria-expanded') !== 'true'));
    panel.querySelectorAll('a').forEach((link) => link.addEventListener('click', () => setOpen(false)));
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            setOpen(false);
        }
    });
}

/**
 * Reveal elements as they enter the viewport.
 */
function initReveal() {
    const elements = document.querySelectorAll('[data-reveal]');

    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        elements.forEach((element) => element.classList.add('is-visible'));

        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.12, rootMargin: '0px 0px -40px 0px' },
    );

    elements.forEach((element) => observer.observe(element));
}

/**
 * Animated number counters.
 */
function initCounters() {
    const counters = document.querySelectorAll('[data-count]');

    const render = (element, value) => {
        element.textContent = `${element.dataset.prefix ?? ''}${Math.round(value).toLocaleString()}${element.dataset.suffix ?? ''}`;
    };

    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        counters.forEach((element) => render(element, Number(element.dataset.count)));

        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                const element = entry.target;
                const target = Number(element.dataset.count);
                const duration = 1800;
                const start = performance.now();

                const tick = (now) => {
                    const progress = Math.min((now - start) / duration, 1);
                    const eased = 1 - Math.pow(1 - progress, 4);

                    render(element, target * eased);

                    if (progress < 1) {
                        requestAnimationFrame(tick);
                    }
                };

                requestAnimationFrame(tick);
                observer.unobserve(element);
            });
        },
        { threshold: 0.5 },
    );

    counters.forEach((element) => observer.observe(element));
}

/**
 * Flowing ribbons drawn on a canvas — echoes the knot in the ACPL mark.
 * data-tone="light" draws fine navy lines with a single gold ribbon, for white sections.
 */
function initRibbons() {
    document.querySelectorAll('[data-ribbons]').forEach((canvas) => {
        const context = canvas.getContext('2d');
        const ribbonCount = Number(canvas.dataset.ribbons) || 7;
        const isLight = canvas.dataset.tone === 'light';
        let width = 0;
        let height = 0;
        let frame = 0;
        let isVisible = true;
        let animationId = null;

        const resize = () => {
            const ratio = Math.min(window.devicePixelRatio || 1, 2);

            width = canvas.clientWidth;
            height = canvas.clientHeight;
            canvas.width = width * ratio;
            canvas.height = height * ratio;
            context.setTransform(ratio, 0, 0, ratio, 0, 0);
        };

        const draw = () => {
            context.clearRect(0, 0, width, height);

            for (let ribbon = 0; ribbon < ribbonCount; ribbon++) {
                const offset = ribbon / ribbonCount;
                const gradient = context.createLinearGradient(0, 0, width, 0);

                if (isLight && ribbon !== ribbonCount - 1) {
                    // Fine navy contour lines on white, as in the brand collateral.
                    gradient.addColorStop(0, 'rgba(0, 20, 64, 0)');
                    gradient.addColorStop(0.4, `rgba(0, 20, 64, ${0.05 + offset * 0.08})`);
                    gradient.addColorStop(1, `rgba(0, 20, 64, ${0.03 + offset * 0.06})`);
                } else {
                    gradient.addColorStop(0, 'rgba(232, 182, 84, 0)');
                    gradient.addColorStop(0.35, `rgba(232, 182, 84, ${(isLight ? 0.35 : 0.08) + offset * 0.22})`);
                    gradient.addColorStop(0.7, `rgba(239, 125, 16, ${(isLight ? 0.3 : 0.06) + offset * 0.2})`);
                    gradient.addColorStop(1, 'rgba(239, 125, 16, 0)');
                }

                context.beginPath();
                context.lineWidth = isLight ? 0.8 + offset * 0.6 : 1 + offset * 1.4;
                context.strokeStyle = gradient;

                for (let x = 0; x <= width; x += 8) {
                    const progress = x / width;
                    const y =
                        height * (0.58 + offset * 0.18) +
                        Math.sin(progress * 3.2 + frame * 0.006 + ribbon * 0.55) * height * 0.13 +
                        Math.sin(progress * 7.5 - frame * 0.004 + ribbon) * height * 0.035;

                    if (x === 0) {
                        context.moveTo(x, y);
                    } else {
                        context.lineTo(x, y);
                    }
                }

                context.stroke();
            }

            frame++;

            if (!prefersReducedMotion && isVisible) {
                animationId = requestAnimationFrame(draw);
            }
        };

        resize();
        draw();
        window.addEventListener('resize', () => {
            resize();

            if (prefersReducedMotion) {
                draw();
            }
        });

        if ('IntersectionObserver' in window && !prefersReducedMotion) {
            new IntersectionObserver(([entry]) => {
                isVisible = entry.isIntersecting;

                if (isVisible && animationId === null) {
                    draw();
                } else if (!isVisible && animationId !== null) {
                    cancelAnimationFrame(animationId);
                    animationId = null;
                }
            }).observe(canvas);
        }
    });
}

/**
 * Subtle pointer-driven 3D tilt.
 */
function initTilt() {
    if (prefersReducedMotion || window.matchMedia('(hover: none)').matches) {
        return;
    }

    document.querySelectorAll('[data-tilt]').forEach((element) => {
        const strength = Number(element.dataset.tilt) || 10;
        const area = element.closest('[data-tilt-area]') ?? element;

        area.addEventListener('pointermove', (event) => {
            const bounds = area.getBoundingClientRect();
            const x = (event.clientX - bounds.left) / bounds.width - 0.5;
            const y = (event.clientY - bounds.top) / bounds.height - 0.5;

            element.style.transform = `perspective(1000px) rotateY(${x * strength}deg) rotateX(${-y * strength}deg)`;
        });

        area.addEventListener('pointerleave', () => {
            element.style.transform = '';
        });
    });
}

/**
 * Generic "pick one" interactions: tabs, the values wheel, the capital stack.
 * Triggers carry data-pick="group:key", panels carry data-pick-panel="group:key".
 */
function initPickers() {
    const triggers = document.querySelectorAll('[data-pick]');

    const activate = (value) => {
        const [group] = value.split(':');

        document.querySelectorAll(`[data-pick^="${group}:"]`).forEach((trigger) => {
            const isActive = trigger.dataset.pick === value;

            trigger.classList.toggle('is-active', isActive);
            trigger.setAttribute('aria-selected', String(isActive));
        });

        document.querySelectorAll(`[data-pick-panel^="${group}:"]`).forEach((panel) => {
            panel.hidden = panel.dataset.pickPanel !== value;
        });
    };

    triggers.forEach((trigger) => {
        const handler = () => activate(trigger.dataset.pick);

        trigger.addEventListener('click', handler);
        trigger.addEventListener('keydown', (event) => {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                handler();
            }
        });

        if (trigger.dataset.pickHover !== undefined) {
            trigger.addEventListener('mouseenter', handler);
        }
    });
}

/**
 * Floating contact dock: WhatsApp, chat, email, call and LinkedIn shortcuts.
 */
function initContactDock() {
    const dock = document.querySelector('[data-dock]');

    if (!dock) {
        return;
    }

    const toggle = dock.querySelector('[data-dock-toggle]');
    const menu = dock.querySelector('[data-dock-menu]');
    const links = menu.querySelectorAll('a');

    const setOpen = (isOpen) => {
        toggle.setAttribute('aria-expanded', String(isOpen));
        menu.classList.toggle('pointer-events-none', !isOpen);
        menu.classList.toggle('opacity-0', !isOpen);
        menu.classList.toggle('translate-y-3', !isOpen);
        links.forEach((link) => link.setAttribute('tabindex', isOpen ? '0' : '-1'));
        toggle.querySelectorAll('[data-dock-icon]').forEach((icon) => {
            icon.classList.toggle('hidden', icon.dataset.dockIcon !== (isOpen ? 'close' : 'open'));
        });
        dock.querySelector('[data-dock-ping]')?.remove();
    };

    toggle.addEventListener('click', () => setOpen(toggle.getAttribute('aria-expanded') !== 'true'));
    document.addEventListener('click', (event) => {
        if (!dock.contains(event.target)) {
            setOpen(false);
        }
    });
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            setOpen(false);
        }
    });

    dock.querySelectorAll('[data-hubspot-chat]').forEach((link) => {
        link.addEventListener('click', (event) => {
            const widget = window.HubSpotConversations?.widget;

            if (widget) {
                event.preventDefault();
                widget.open();
                setOpen(false);
            }
        });
    });
}

initHeader();
initMobileNav();
initReveal();
initCounters();
initRibbons();
initTilt();
initPickers();
initContactDock();
