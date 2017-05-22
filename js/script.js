$(document).ready(function(){

function openModal1(){
    $('a[href$="inscription"]').click(function(evt){
        evt.preventDefault()
        var modal = $(this).removeClass(hidden)
        $('.modal').text(modal)

        $('.modal').fadeToggle()
    })

    $('.fa').click(function(){
        $('.modal').fadeToggle()
    })
}















})  // Fin du chargement du DOM