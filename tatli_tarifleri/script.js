// Scroll-to-Top Button oluşturma
const scrollToTopButton = document.createElement('button');

// Buton içeriğini ayarlama (Font Awesome ikonu dahil)
scrollToTopButton.innerHTML = '<i class="fas fa-arrow-up"></i> Üst’e Git';

// Butonun id'sini belirleme ve body'ye ekleme
scrollToTopButton.setAttribute('id', 'scrollToTopButton');
document.body.appendChild(scrollToTopButton);

// Butonun başlangıç stil ayarları
Object.assign(scrollToTopButton.style, {
    display: 'none', // Başlangıçta gizli
    position: 'fixed', // Sabit konum
    bottom: '20px', // Aşağıdan 20px
    right: '20px', // Sağdan 20px
    backgroundColor: '#6a1b9a', // Arka plan rengi
    color: 'white', // Yazı rengi
    border: 'none', // Kenarlık yok
    borderRadius: '5px', // Kenar yuvarlama
    padding: '10px 15px', // İç boşluk
    cursor: 'pointer', // İmleç değişimi
    opacity: '0', // Başlangıçta görünmez
    transform: 'translateY(10px)', // Hafif aşağı kaydırılmış
    transition: 'opacity 0.3s, transform 0.3s', // Geçiş animasyonu
    zIndex: '1000', // Üstte görünmesi için
});

// Scroll olduğunda butonu göster/gizle
window.addEventListener('scroll', () => {
    const scrolled = window.scrollY || document.documentElement.scrollTop; // Kaydırılma miktarı

    if (scrolled > 200) {
        // Kaydırma 200 pikseli geçtiğinde butonu göster
        scrollToTopButton.style.display = 'block';
        setTimeout(() => {
            scrollToTopButton.style.opacity = '1';
            scrollToTopButton.style.transform = 'translateY(0)';
        }, 10); // Küçük bir gecikme ile animasyon başlat
    } else {
        // Kaydırma 200 pikselin altındaysa butonu gizle
        scrollToTopButton.style.opacity = '0';
        scrollToTopButton.style.transform = 'translateY(10px)';
        setTimeout(() => {
            scrollToTopButton.style.display = 'none';
        }, 300); // Geçiş animasyonu tamamlandıktan sonra gizle
    }
});

// Butona tıklandığında sayfayı yukarı kaydır
scrollToTopButton.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth', // Yumuşak kaydırma
    });
});

// Sayfa yüklendiğinde başlangıç stilini sıfırla
window.addEventListener('load', () => {
    scrollToTopButton.style.display = 'none';
    scrollToTopButton.style.opacity = '0';
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Fade in animation for elements
const fadeElements = document.querySelectorAll('.fade-in');
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

fadeElements.forEach(element => {
    element.style.opacity = '0';
    element.style.transform = 'translateY(20px)';
    element.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
    observer.observe(element);
});

// Mobile menu toggle
const mobileMenuButton = document.querySelector('.mobile-menu-button');
const navLinks = document.querySelector('.nav-links');

if (mobileMenuButton) {
    mobileMenuButton.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    });
}

// Recipe card hover effect
const recipeCards = document.querySelectorAll('.recipe-card');
recipeCards.forEach(card => {
    card.addEventListener('mouseenter', () => {
        card.style.transform = 'translateY(-5px)';
    });
    
    card.addEventListener('mouseleave', () => {
        card.style.transform = 'translateY(0)';
    });
});

// Lazy loading for images
document.addEventListener('DOMContentLoaded', () => {
    const lazyImages = document.querySelectorAll('img[data-src]');
    
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
                imageObserver.unobserve(img);
            }
        });
    });
    
    lazyImages.forEach(img => imageObserver.observe(img));
});
