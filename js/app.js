document.querySelectorAll(".icon-box").forEach(icon=>{
    icon.addEventListener("click", ()=>{
        const link = icon.querySelector("a").getAttribute("href");
        window.location.href = link;
    });
});