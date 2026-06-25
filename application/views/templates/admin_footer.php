    </main>

    <script>
        setTimeout(function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(function() { alert.style.display = 'none'; }, 500);
            });
        }, 4000);
    </script>
</body>
<script>
document.addEventListener('DOMContentLoaded', function(){

    const navbar = document.querySelector('.top-nav.glass-pill');
    const sentinel = document.getElementById('scroll-sentinel');

    if(!navbar || !sentinel) return;

    const observer = new IntersectionObserver(function(entries){

        if(entries[0].isIntersecting){
            navbar.classList.remove('scrolled');
        }else{
            navbar.classList.add('scrolled');
        }

    });

    observer.observe(sentinel);

});
</script>
</html>
