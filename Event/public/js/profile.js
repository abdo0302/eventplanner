//section creer event
let section_cree_event=document.querySelector('.section_cree_event')
let Creer_evenement=document.querySelector('.Creer_evenement')
let button_close=document.querySelector('.button_close')
section_cree_event.style.display='none'

Creer_evenement.onclick=()=>{
    section_cree_event.style.display='flex'
}

button_close.onclick=()=>{
    section_cree_event.style.display='none'
}
//
// let botton_more=document.querySelectorAll('.botton_more')
// let mini_menu=document.querySelectorAll('.mini_menu')

// botton_more.forEach((e,i)=>{
//     e[i].onclick=()=>{
//         mini_menu[i].style.display='flex'
//     }
// })