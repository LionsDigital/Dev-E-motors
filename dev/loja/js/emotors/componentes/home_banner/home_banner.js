let i = 0;
let txtUm = 'Melhor opção';
let txtDois = 'em mobilidade';
let txtBt = 'Conheça a marca';
let speed = 10;

function typeWriter() {
      document.querySelector(".home_banner--texto-um").innerHTML += txtUm.charAt(i);
      document.querySelector(".home_banner--texto-dois").innerHTML += txtDois.charAt(i);
      document.querySelector(".home_banner--botao a").innerHTML += txtBt.charAt(i);
      i++;
      setTimeout(typeWriter, speed);
}
