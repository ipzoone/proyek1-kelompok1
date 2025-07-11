// Load saat DOM telah selesai
document.addEventListener("DOMContentLoaded", function () {
  // Hamburger menu untuk mobile
  const hamburger = document.querySelector(".hamburger");
  const navLinks = document.querySelector(".nav-links");

  if (hamburger && navLinks) {
    hamburger.addEventListener("click", function () {
      navLinks.classList.toggle("active");
      hamburger.classList.toggle("is-active");
    });
  }

  // Dropdown untuk mobile
  document.querySelectorAll(".dropdown-btn").forEach((button) => {
    button.addEventListener("click", function (e) {
      if (window.innerWidth <= 768) {
        e.preventDefault();
        const dropdown = this.closest(".dropdown");
        dropdown.classList.toggle("active");
      }
    });
  });

  // Close dropdown saat klik di luar
  document.addEventListener("click", function (e) {
    if (!e.target.closest(".dropdown") && window.innerWidth <= 768) {
      document.querySelectorAll(".dropdown").forEach((drop) => {
        drop.classList.remove("active");
      });
    }
  });
});

// Carousel
let currentIndex = 0;

function showSlide(index) {
  const slides = document.querySelectorAll(".slide");
  if (index >= slides.length) {
    currentIndex = 0;
  } else if (index < 0) {
    currentIndex = slides.length - 1;
  } else {
    currentIndex = index;
  }

  const offset = -currentIndex * 100 + "%";
  document.querySelector(".carousel-container").style.transform =
    "translateX(" + offset + ")";
}

function nextSlide() {
  showSlide(currentIndex + 1);
}

function prevSlide() {
  showSlide(currentIndex - 1);
}

// Auto-slide setiap 5 detik
setInterval(nextSlide, 5000);
// Menambahkan event listener pada setiap dropdown button
const dropdownBtns = document.querySelectorAll(".dropdown-btn");

//Dropdown

document.addEventListener("DOMContentLoaded", function () {
  // Tangani semua tombol dropdown
  const dropdownBtns = document.querySelectorAll(".dropdown-btn");

  dropdownBtns.forEach((btn) => {
    btn.addEventListener("click", function (e) {
      e.preventDefault(); // Mencegah link '#' melakukan reload

      const dropdown = this.closest(".dropdown");
      const dropdownContent = dropdown.querySelector(".dropdown-content");

      // Tutup dropdown lain terlebih dahulu
      document.querySelectorAll(".dropdown-content").forEach((dc) => {
        if (dc !== dropdownContent) {
          dc.style.display = "none";
        }
      });

      // Toggle tampilan dropdown yang diklik
      dropdownContent.style.display =
        dropdownContent.style.display === "block" ? "none" : "block";

      e.stopPropagation(); // Mencegah bubbling ke document
    });
  });

  // Tutup dropdown jika klik di luar
  document.addEventListener("click", function () {
    document.querySelectorAll(".dropdown-content").forEach((dc) => {
      dc.style.display = "none";
    });
  });
});
