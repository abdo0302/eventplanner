// sgin up
let button_inscription_home=document.querySelector('.button_inscription_home')
let button_close=document.querySelector('.button_close')
let continar_sin_up=document.querySelector('.continar_sin_up')
continar_sin_up.style.display='none'

button_close.onclick=()=>{
    continar_sin_up.style.display='none'
}

//sgin in
let button_close_form_connexion=document.querySelector('.button_close_form_connexion')
let continar_sin_in=document.querySelector('.continar_sin_in')
continar_sin_in.style.display='none'

button_close_form_connexion.onclick=()=>{
    continar_sin_in.style.display='none'
}

//
let connexion=document.querySelector('.connexion')
let inscription=document.querySelector('.inscription')

connexion.onclick=()=>{
         continar_sin_in.style.display='flex'
}

inscription.onclick=()=>{
    continar_sin_up.style.display='flex'
}

button_inscription_home.onclick=()=>{
    continar_sin_up.style.display='flex'
}

//notif
let continar_notif=document.querySelectorAll('.continar_notif')
let button_close_notif=document.querySelectorAll('.button_close_notif')

button_close_notif.forEach((e,i) => {
    e.onclick=()=>{
        continar_notif[i].style.display='none'
    }
});