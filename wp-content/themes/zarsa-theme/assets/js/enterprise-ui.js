document.addEventListener('DOMContentLoaded', () => {
    console.log('ENTERPRISE UI LOADED');

    const toggle = document.getElementById('mobileToggle');
    const nav = document.getElementById('mainNav');
    const closeBtn = document.getElementById('mobileClose');
    const header = document.getElementById('siteHeader');

    if(toggle && nav){

        toggle.addEventListener('click', (e) => {
            e.stopPropagation();
            toggle.classList.toggle('active');
            nav.classList.toggle('active');
            document.body.classList.toggle('menu-open');
        });

        if(closeBtn){
            closeBtn.addEventListener('click', (e)=>{
                e.stopPropagation();
                console.log('CLOSE CLICKED');

                toggle.classList.remove('active');
                nav.classList.remove('active');
                document.body.classList.remove('menu-open');
            });
        }

        document.querySelectorAll('.nav-menu a').forEach(link=>{
            link.addEventListener('click', ()=>{
                if(window.innerWidth <= 900){
                    toggle.classList.remove('active');
                    nav.classList.remove('active');
                    document.body.classList.remove('menu-open');
                }
            });
        });
    }

    /* Header scroll effect */
    if(header){
        window.addEventListener('scroll', ()=>{
            if(window.scrollY > 60){
                header.classList.add('header-scrolled');
            }else{
                header.classList.remove('header-scrolled');
            }
        });
    }
});
