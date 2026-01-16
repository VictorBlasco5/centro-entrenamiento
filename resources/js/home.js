document.addEventListener("DOMContentLoaded", () => {
    const cards = Array.from(document.querySelectorAll(".card-history"));

    const offsetX = 140;
    const startFactor = 0.95;
    const endFactor = 0.30;
    const minOpacity = 0;
    const maxScale = 1;
    const minScale = 0.95;

    cards.forEach((card, i) => {
        card.classList.add(i % 2 === 0 ? "from-left" : "from-right");
    });

    const clamp = (v, a = 0, b = 1) => Math.min(b, Math.max(a, v));
    const smoothstep = t => t * t * (3 - 2 * t);

    let ticking = false;
    const updateAll = () => {
        const vh = window.innerHeight;
        const startY = vh * startFactor;
        const endY = vh * endFactor;
        const range = startY - endY || 1;

        cards.forEach((card, index) => {
            const rect = card.getBoundingClientRect();
            const top = rect.top;

            let progress = (startY - top) / range;
            progress = clamp(progress, 0, 1);

            const eased = smoothstep(progress);
            const isLeft = index % 2 === 0;
            const sign = isLeft ? -1 : 1;

            const translateX = sign * (1 - eased) * offsetX;
            const scale = minScale + (maxScale - minScale) * eased;
            const opacity = minOpacity + (1 - minOpacity) * eased;

            card.style.transform = `translateX(${translateX}px) scale(${scale})`;
            card.style.opacity = `${opacity}`;
            card.style.pointerEvents = (progress > 0.03) ? "auto" : "none";
        });

        ticking = false;
    };

    const onScroll = () => {
        if (!ticking) {
            ticking = true;
            requestAnimationFrame(updateAll);
        }
    };

    updateAll();
    window.addEventListener("scroll", onScroll, {
        passive: true
    });
    window.addEventListener("resize", onScroll);
});