$(document).ready(function(){

    $('#inscription').click(function(evt){
        evt.preventDefault()
        $('.modal').removeClass('hidden')

        $('.modal').fadeIn()
    })

    $('.fa').click(function(){
        $('.modal').fadeOut()
    })

    $('#connexion').click(function(evt){
        evt.preventDefault()
        $('.modal2').removeClass('hidden')

        $('.modal2').fadeIn()
    })

    $('.fa').click(function(){
        $('.modal2').fadeOut()
    })















})  // Fin du chargement du DOM