//Calcul du padding top du main
let headerHeight = document.getElementById('monHeader').getBoundingClientRect().height;

let main = document.getElementsByTagName('main');

if(main[0].id != "mainAccueil") {
    main[0].style.paddingTop = headerHeight + 'px';
}