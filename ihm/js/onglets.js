function afficherOnglet(idElement) {
    if (idElement == "boutonEnCoursValidation") {
        document.getElementById("ongletEnCoursValidation").style.display = 'block';
        document.getElementById("ongletEnCours").style.display = 'none';
        document.getElementById("ongletTermines").style.display = 'none';
    }
    if (idElement == "boutonEnCours") {
        document.getElementById("ongletEnCoursValidation").style.display = 'none';
        document.getElementById("ongletEnCours").style.display = 'block';
        document.getElementById("ongletTermines").style.display = 'none';
    }
    if (idElement == "boutonTermines") {
        document.getElementById("ongletEnCoursValidation").style.display = 'none';
        document.getElementById("ongletEnCours").style.display = 'none';
        document.getElementById("ongletTermines").style.display = 'block';
    }
}

