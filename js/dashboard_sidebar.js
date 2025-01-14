window.onload = function (){
    const sidebar = document.querySelector(".sidemenu");
    const closeBtn = document.querySelector("#btn");
    const searchBtn = document.querySelector(".bx-search");

    closeBtn.addEventListener("click", function(){
        sidebar.classList.toggle("open")
    })

    searchBtn.addEventListener("click", function(){
        sidebar.classList.toggle("open")
    })

    function menuBtnChange(){
        if(sidebar.classList.container("open")){
            closeBtn.classList.replace("bx-menu", "bx-menu-alt-right")
        }else{
            closeBtn.classList.replace("bx-menu-alt", "bx-menu")
        }
    }
}

function toggleMenu() {
    const menu = document.querySelector(".menu");
    menu.classList.toggle("active");
}

window.onload = function(){
    const sidebar = document.querySelector(".sidebar");
    const closeBtn = document.querySelector("#btn");
    const searchBtn = document.querySelector(".bx-search")

    closeBtn.addEventListener("click",function(){
        sidebar.classList.toggle("open")
        menuBtnChange()
    })

    function menuBtnChange(){
        if(sidebar.classList.contains("open")){
            closeBtn.classList.replace("bx-menu","bx-menu-alt-right")
        }else{
            closeBtn.classList.replace("bx-menu-alt-right","bx-menu")
        }
    }
}