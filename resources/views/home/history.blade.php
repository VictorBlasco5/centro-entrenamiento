<style>
    .img-history {
        width: 100%;
        height: 20em;
        background-image: url('../images/history/banner-history.png');
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: center;
        background-position: center;
    }

    .title-history {
        font-size: 60px;
        color: white;
        font-weight: bold;
    }

    .container-history {
        width: 100%;
        background-color: #000;
        color: white;
    }

    /* === BANNER === */
    .img-history {
        width: 100%;
        height: 20em;
        background-image: url('../images/history/banner-history.png');
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .title-history {
        font-size: 60px;
        font-weight: 700;
        letter-spacing: 2px;
    }

    .container-history .subcontainer-history {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .container-history .card-history {
        width: 80%;
        display: flex;
        gap: 20px;
        margin: 10px 0;
    }

    .card-history:nth-child(even) {
        flex-direction: row-reverse;
    }

    .media-history,
    .card-history p {
        flex: 1;
    }

    .subcontainer-history h3 {
        font-size: 22px;
        margin-bottom: 10px;
    }

    .subcontainer-history img {
        width: 100%;
        max-width: 300px;
        height: auto;
        object-fit: contain;
    }

    .subcontainer-history p {
        font-size: 16px;
        color: #d0d0d0;
        display: flex;
        align-items: center;
    }

    .card-history:nth-child(even) .media-history {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }



    .card-history {
        opacity: 0;
        transform: translateX(0) scale(0.95);
        transition: opacity 1.2s ease, transform 1.2s ease;
    }

    .card-history.from-left {
        transform: translateX(-150px) scale(0.95);
    }

    .card-history.from-right {
        transform: translateX(150px) scale(0.95);
    }

    .card-history.show {
        opacity: 1;
        transform: translateX(0) scale(1);
    }
</style>

<section class="container-history">
    <div class="img-history">
        <h1 class="title-history">NUESTRA HISTORIA</h1>
    </div>
    <div class="subcontainer-history">
        <div class="card-history">
            <div class="media-history">
                <h3>El fundador</h3>
                <img src="/images/history/fundador.png" alt="">
            </div>
            <p>El proyecto nace de la mano de Carlos, entrenador personal y apasionado del entrenamiento y la salud desde muy joven. Tras años formándose y trabajando en diferentes centros deportivos, Víctor desarrolló una forma muy clara de entender el entrenamiento: cercana, consciente y adaptada a cada persona.
                Su experiencia le permitió conocer de primera mano tanto los aciertos como las carencias del sector, despertando la inquietud de crear algo propio, alineado con sus valores profesionales y personales.
            </p>
        </div>
        <div class="card-history">
            <div class="media-history">
                <h3>El origen del proyecto</h3>
                <img src="/images/history/history_origin.png" alt="">
            </div>
            <p>Durante su trayectoria, Carlos observó una realidad repetida: entrenamientos masificados, poca atención individual y personas que no lograban sus objetivos por falta de seguimiento real. Esta situación fue el punto de partida para dar forma a un nuevo concepto de centro de entrenamiento.
                El proyecto nace con una idea sencilla pero firme: volver a poner a la persona en el centro del entrenamiento.
            </p>
        </div>
        <div class="card-history">
            <div class="media-history">
                <h3>El nacimiento del centro</h3>
                <img src="/images/history/history_birth.png" alt="">
            </div>
            <p>En 2023, el proyecto se convierte en realidad con la apertura del centro de entrenamiento personalizado en Valencia. Desde el primer día, se apuesta por un modelo diferente, basado en la cercanía, la calidad del servicio y el compromiso con cada persona que confía en el equipo.
                El objetivo no era crecer rápido, sino construir una base sólida, cuidando cada detalle y cada proceso.
            </p>
        </div>
        <div class="card-history">
            <div class="media-history">
                <h3>La filosofía</h3>
                <img src="/images/history/history_philosophy.png" alt="">
            </div>
            <p>Desde su nacimiento, el centro se ha guiado por una filosofía clara: ofrecer un entrenamiento honesto, profesional y adaptado. La atención personalizada y el trato cercano forman parte de la identidad del proyecto, creando un entorno de confianza donde cada persona puede avanzar a su ritmo.
                La constancia, la técnica y la salud son los pilares sobre los que se construye el día a día del centro.
            </p>
        </div>
        <div class="card-history">
            <div class="media-history">
                <h3>El presente</h3>
                <img src="/images/history/history_present.png" alt="">
            </div>
            <p>Hoy, el centro continúa fiel a su esencia inicial. Mantiene el compromiso con la calidad, la cercanía y el acompañamiento, consolidándose como un espacio donde entrenar se convierte en una experiencia cuidada y consciente.
                Cada persona que entra forma parte de la historia del centro, y cada progreso es el reflejo del trabajo bien hecho.
            </p>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const cards = Array.from(document.querySelectorAll(".card-history"));

    // Asignamos zigzag
    cards.forEach((card, index) => {
        card.classList.add(index % 2 === 0 ? "from-left" : "from-right");
    });

    let visibleCards = [];

    const observer = new IntersectionObserver(
        entries => {
            entries.forEach(entry => {
                const card = entry.target;
                const index = cards.indexOf(card);

                if (entry.isIntersecting) {
                    // Al bajar: añadir a visibleCards si no estaba
                    if (!visibleCards.includes(card)) {
                        visibleCards.push(card);
                        card.style.transitionDelay = `${index * 0.2}s`;
                        card.classList.add("show");
                    }
                } else {
                    // Al subir: quitar solo la última de visibleCards
                    const lastVisible = visibleCards[visibleCards.length - 1];
                    if (card === lastVisible) {
                        lastVisible.classList.remove("show");
                        visibleCards.pop();
                    }
                }
            });
        },
        { threshold: 0.2 }
    );

    cards.forEach(card => observer.observe(card));
});
</script>
