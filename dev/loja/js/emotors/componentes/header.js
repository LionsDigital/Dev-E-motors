function abrirMenu(){
    document.querySelector('.top-links-container_mobile--x').style.display="block";
    document.querySelector('.top-links-container_mobile--abrir').style.display="none";
    document.querySelector('.header .top-links ul').style.display="block";
    document.querySelector('.top-links-container_mobile .links').style.display="block";
}
function fecharMenu(){
    document.querySelector('.top-links-container_mobile--x').style.display="none";
    document.querySelector('.top-links-container_mobile--abrir').style.display="block";
    document.querySelector('.header .top-links ul').style.display="none";
    document.querySelector('.top-links-container_mobile .links').style.display="none";
}
