function afiseazaProduse(produse) {
    const container = document.querySelector('.product-list');
    container.innerHTML = '';
    produse.forEach(p => {
        const produs = document.createElement('div');
        produs.classList.add('product');
        produs.innerHTML = `
            <img src="Image/Produse/${p.imagine}" alt="${p.nume}">
            <h3>${p.nume}</h3>
            <p>${p.descriere}</p>
            <span>Preț: ${p.pret} RON</span>
        `;
        container.appendChild(produs);
    });
}

function cautaProduse(cuvant) {
    fetch(`cauta_produse.php?search=${encodeURIComponent(cuvant)}`)
        .then(r => r.json())
        .then(data => afiseazaProduse(data));
}

document.addEventListener('DOMContentLoaded', function () {
    cautaProduse('');

    const input = document.getElementById('cautare');
    input.addEventListener('input', function () {
        cautaProduse(this.value);
    });
});
