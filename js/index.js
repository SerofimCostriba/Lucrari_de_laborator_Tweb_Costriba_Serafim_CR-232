document.addEventListener("DOMContentLoaded", function () {
    const image = document.getElementById("image_index");
    const leftText = document.querySelector(".left-text");
    const rightText = document.querySelector(".right-text");
    const header = document.querySelector("h1");
    const mainContainer = document.querySelector("main");

    if (!image || !leftText || !rightText || !header) {
        console.error("Unul sau mai multe elemente lipsesc din DOM.");
        return;
    }

    function createObserver(element, transformValue, delay) {
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        element.style.transition = "transform 0.9s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.9s ease-out";
                        element.style.opacity = "1";
                        element.style.transform = transformValue;
                    }, delay);
                    observer.unobserve(element);
                }
            });
        }, { threshold: 0.2 });
        observer.observe(element);
    }

    // Setare inițială a stilurilor pentru transparență și poziționare
    [leftText, rightText, image, header].forEach(el => {
        el.style.opacity = "0";
    });
    
    leftText.style.transform = "translateX(-100px) scale(0.95)";
    rightText.style.transform = "translateX(100px) scale(0.95)";
    image.style.transform = "scale(0.8) rotateY(10deg)";
    header.style.transform = "translateY(20px) scale(0.95)";

    // Aplicare animații la apariția elementelor pe ecran
    createObserver(leftText, "translateX(0) scale(1)", 100);
    createObserver(rightText, "translateX(0) scale(1)", 200);
    createObserver(image, "scale(1) rotateY(0deg)", 300);
    createObserver(header, "translateY(0) scale(1)", 400);

    // ----------------- Fundal slideshow -----------------
    const backgroundScript = document.getElementById("background-data");
    const backgrounds = JSON.parse(backgroundScript.textContent || "[]");

    let currentIndex = 0;
    const bgContainer = document.createElement("div");
    bgContainer.classList.add("background-slideshow");
    document.body.prepend(bgContainer);

    function startSlideshow() {
        currentIndex = 0;
        bgContainer.style.backgroundImage = `url(${backgrounds[currentIndex]})`;
        bgContainer.style.opacity = "0";
        bgContainer.style.transform = "scale(1.1)";

        setTimeout(() => {
            bgContainer.style.transition = "opacity 1.5s ease-in-out, transform 5s ease-out";
            bgContainer.style.opacity = "1";
            bgContainer.style.transform = "scale(1)";
        }, 500);
    }

    // Preîncărcare imagini pentru slideshow
    backgrounds.forEach((bg) => {
        const img = new Image();
        img.src = bg;
    });

    function setBackgroundImage() {
        bgContainer.style.opacity = "0";

        setTimeout(() => {
            currentIndex = (currentIndex + 1) % backgrounds.length;
            bgContainer.style.backgroundImage = `url(${backgrounds[currentIndex]})`;
            bgContainer.classList.remove("zoom");
            void bgContainer.offsetWidth; // Trigger reflow
            bgContainer.classList.add("zoom");
            bgContainer.style.opacity = "1";
        }, 800);
    }

    startSlideshow();
    setInterval(setBackgroundImage, 7000);

    // ----------------- Efect parallax -----------------
    let targetX = 0, targetY = 0;
    let lastX = 0, lastY = 0;
    const damping = 0.1;
    const intensity = 15;

    document.addEventListener("mousemove", (event) => {
        const { clientX, clientY } = event;
        targetX = (clientX / window.innerWidth - 0.5) * intensity;
        targetY = (clientY / window.innerHeight - 0.5) * intensity;
    });

    function animateParallax() {
        lastX += (targetX - lastX) * damping;
        lastY += (targetY - lastY) * damping;
        mainContainer.style.transform = `translate(${lastX}px, ${lastY}px)`;
        requestAnimationFrame(animateParallax);
    }

    animateParallax();

    // ----------------- Logare și înregistrare modal -----------------
    const loginBtn = document.getElementById("login-btn");
    const registerBtn = document.getElementById("register-btn");
    const modal = document.getElementById("auth-modal");
    const closeModal = document.querySelector(".close");

    function showModal() {
        modal.style.display = "flex";
    }

    function hideModal() {
        modal.style.display = "none";
    }

    loginBtn.addEventListener("click", showModal);
    registerBtn.addEventListener("click", showModal);
    closeModal.addEventListener("click", hideModal);

    // Ascundere modal când utilizatorul dă click în afara ferestrei
    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            hideModal();
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const authBtn = document.getElementById("auth-btn");
    const modal = document.getElementById("auth-modal");
    const closeModal = document.querySelector(".close-btn");
    const authForm = document.getElementById("auth-form");
    const registerForm = document.getElementById("register-form");
    const switchToRegister = document.getElementById("switch-to-register");
    const switchToLogin = document.getElementById("switch-to-login");
    const overlay = document.getElementById("overlay");
    const backArrow = document.getElementById("back-arrow");
    const switchToRegisterContainer = document.getElementById("switch-to-register-container");

    // Funcția de a arăta modalul
    function showModal() {
        modal.style.display = "flex";
        overlay.style.display = "block";
    }

    // Funcția de a ascunde modalul
    function hideModal() {
        modal.style.display = "none";
        overlay.style.display = "none";
    }

    // Funcția de comutare între formulare (Autentificare → Înregistrare)
    function switchToRegisterForm(event) {
        event.preventDefault();
        authForm.classList.add("hidden");
        registerForm.classList.remove("hidden");
        document.getElementById("modal-title").textContent = "Înregistrare";
        backArrow.style.display = "block"; // Afișează săgeata înapoi
        switchToRegisterContainer.style.display = "none"; // Ascunde textul "Nu ai cont?"
    }

    // Funcția de comutare între formulare (Înregistrare → Autentificare)
    function switchToLoginForm(event) {
        event.preventDefault();
        registerForm.classList.add("hidden");
        authForm.classList.remove("hidden");
        document.getElementById("modal-title").textContent = "Autentificare";
        backArrow.style.display = "none"; // Ascunde săgeata înapoi
        switchToRegisterContainer.style.display = "block"; // Afișează textul "Nu ai cont?"
    }

    // Event listeners
    authBtn.addEventListener("click", showModal);  // Deschide modalul când se apasă butonul de autentificare
    closeModal.addEventListener("click", hideModal);  // Închide modalul când se apasă pe butonul de închidere
    overlay.addEventListener("click", hideModal);  // Închide modalul când se apasă în afara ferestrei
    switchToRegister.addEventListener("click", switchToRegisterForm);  // Comută la formularul de înregistrare
    switchToLogin.addEventListener("click", switchToLoginForm);  // Comută la formularul de autentificare

    // Inițializare
    backArrow.style.display = "none";  // Ascunde săgeata la început
    switchToRegisterContainer.style.display = "block";  // Afișează "Nu ai cont?" la început
});


// Deschiderea modalului
document.getElementById('auth-btn').addEventListener('click', function() {
    document.getElementById('auth-modal').classList.remove('hidden');
    document.getElementById('overlay').classList.remove('hidden');
});

// Închiderea modalului
document.querySelector('.close-btn').addEventListener('click', function() {
    document.getElementById('auth-modal').classList.add('hidden');
    document.getElementById('overlay').classList.add('hidden');
});

// Comutarea între formulare (Autentificare → Înregistrare)
document.getElementById('switch-to-register').addEventListener('click', function() {
    document.getElementById('auth-form').classList.add('hidden');
    document.getElementById('register-form').classList.remove('hidden');
    document.getElementById('modal-title').textContent = 'Înregistrare';
    document.getElementById('switch-to-register-container').style.display = 'none';
    document.getElementById('back-arrow').style.display = 'inline';
});

// Comutarea între formulare (Înregistrare → Autentificare)
document.getElementById('switch-to-login').addEventListener('click', function() {
    document.getElementById('register-form').classList.add('hidden');
    document.getElementById('auth-form').classList.remove('hidden');
    document.getElementById('modal-title').textContent = 'Autentificare';
    document.getElementById('switch-to-register-container').style.display = 'inline';
    document.getElementById('back-arrow').style.display = 'none';
});
