<?php
session_start();
require_once "vendors/FlashMessage/FlashMessage.php";
?>

<?php // header("Location: views/"); ?>
<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Gestão de aula | Login</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Gestão de aula | Login " />
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
        integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="views/css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Sistema de Aulas - Bem-vindo</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&amp;display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
      rel="stylesheet"
    />
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            colors: {
              primary: "#137fec",
              "background-light": "#f6f7f8",
              "background-dark": "#101922",
            },
            fontFamily: {
              display: ["Inter", "sans-serif"],
            },
            borderRadius: {
              DEFAULT: "0.25rem",
              lg: "0.5rem",
              xl: "0.75rem",
              full: "9999px",
            },
          },
        },
      };
    </script>
    <style>
      .material-symbols-outlined {
        font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24;
      }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="bg-body-secondary">
    <div
      class="relative flex min-h-screen w-full flex-col group/design-root overflow-x-hidden"
    >
      <div class="layout-container flex h-full grow flex-col">
        <header
          class="w-full bg-white dark:bg-background-dark/50 border-b border-gray-200 dark:border-gray-800"
        >
          <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
              <div
                class="flex items-center gap-4 text-[#111418] dark:text-white"
              >
                <div class="flex-shrink-0">
                  <span class="material-symbols-outlined text-primary text-3xl"
                    >school</span
                  >
                </div>
                <h1 class="text-xl font-bold tracking-tight">
                  Sistema de Gestão de Aulas
                </h1>
              </div>
              <div class="flex flex-1 justify-end">
                <button
                  class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold leading-normal tracking-[0.015em] hover:bg-primary/90 transition-colors"
                  onclick="window.location.href='views/login'"
                >
                  <span class="truncate">Login</span>
                </button>
              </div>
            </div>
          </div>
        </header>
        <main class="flex-grow">
          <div
            class="flex flex-col items-center w-full px-4 sm:px-6 lg:px-8 py-8 md:py-12"
          >
            <!-- Carousel Section -->
            <div class="w-full max-w-5xl mb-6 md:mb-4">
              <div class="relative overflow-hidden rounded-xl shadow-lg">
                <div id="carouselTrack" class="flex transition-transform duration-500 ease-in-out" style="transform: translateX(0%);">
                  <!-- Slides -->
                  <div class="flex-shrink-0 w-full">
                    <div class="relative w-full aspect-[16/5] bg-cover bg-center" style="background-image: url('views/imagem/aulao_enem_propaganda.png');">
                      <div class="absolute inset-0 flex items-center justify-center p-8">
                      </div>
                    </div>
                  </div>
                  <div class="flex-shrink-0 w-full">
                    <div class="relative w-full aspect-[16/5] bg-cover bg-center" style="background-image: url('views/imagem/aulas_particulares.png');">
                      <div class="absolute inset-0 flex items-center justify-center p-8">
                      </div>
                    </div>
                  </div>
                  <div class="flex-shrink-0 w-full">
                    <div class="relative w-full aspect-[16/5] bg-cover bg-center" style="background-image: url('views/imagem/matematica.png');">
                      <div class="absolute inset-0 flex items-center justify-center p-8">
                      </div>
                    </div>
                  </div>
                  <div class="flex-shrink-0 w-full">
                    <div class="relative w-full aspect-[16/5] bg-cover bg-center" style="background-image: url('views/imagem/quimica.png');">
                      <div class="absolute inset-0 flex items-center justify-center p-8">
                      </div>
                    </div>
                  </div>
                  <div class="flex-shrink-0 w-full">
                    <div class="relative w-full aspect-[16/5] bg-cover bg-center" style="background-image: url('views/imagem/fisica.png');">
                      <div class="absolute inset-0 flex items-center justify-center p-8">
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Carousel Navigation -->
                <button id="prevBtn"
                  class="absolute top-1/2 left-4 -translate-y-1/2 bg-white/30 hover:bg-white/50 text-white p-2 rounded-full backdrop-blur-sm transition"
                >
                  <span class="material-symbols-outlined">arrow_back_ios_new</span>
                </button>
                <button id="nextBtn"
                  class="absolute top-1/2 right-4 -translate-y-1/2 bg-white/30 hover:bg-white/50 text-white p-2 rounded-full backdrop-blur-sm transition"
                >
                  <span class="material-symbols-outlined">arrow_forward_ios</span>
                </button>
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2" id="carouselDots">
                  <div class="dot w-2 h-2 bg-white rounded-full opacity-100"></div>
                  <div class="dot w-2 h-2 bg-white rounded-full opacity-50"></div>
                  <div class="dot w-2 h-2 bg-white rounded-full opacity-50"></div>
                </div>
              </div>
            </div>
          </div>
          <div
            class="mx-auto flex max-w-4xl flex-col items-center gap-2 text-center"
          >
            <div class="flex flex-col gap-3">
              <h1
                class="text-4xl font-black leading-tight tracking-tighter text-gray-900 dark:text-white md:text-1xl"
              >
                Clique no card que representa você e faça o seu cadastro.
              </h1>
            </div>
            <div class="grid w-full grid-cols-1 gap-6 pt-8 md:grid-cols-3">
                <a
                  class="group flex cursor-pointer flex-col items-center gap-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-background-dark p-6 text-center shadow-sm transition-all hover:-translate-y-1 hover:shadow-lg hover:border-primary/50 dark:hover:border-primary/50"
                  href="views/publico/professores"
                >
                  <div
                    class="flex h-16 w-16 items-center justify-center rounded-full bg-primary/10 text-primary transition-colors group-hover:bg-primary group-hover:text-white"
                  >
                    <span
                      class="material-symbols-outlined text-4xl"
                      data-icon="school"
                      >school</span
                    >
                  </div>
                  <div class="flex flex-col">
                    <p class="text-lg font-bold text-gray-900 dark:text-white">
                      Sou Professor
                    </p>
                  </div>
                </a>
                <a
                  class="group flex cursor-pointer flex-col items-center gap-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-background-dark p-6 text-center shadow-sm transition-all hover:-translate-y-1 hover:shadow-lg hover:border-primary/50 dark:hover:border-primary/50"
                  href="views/publico/alunos"
                >
                  <div
                    class="flex h-16 w-16 items-center justify-center rounded-full bg-primary/10 text-primary transition-colors group-hover:bg-primary group-hover:text-white"
                  >
                    <span
                      class="material-symbols-outlined text-4xl"
                      data-icon="person"
                      >person</span
                    >
                  </div>
                  <div class="flex flex-col">
                    <p class="text-lg font-bold text-gray-900 dark:text-white">
                      Sou Aluno
                    </p>
                  </div>
                </a>
                <a
                  class="group flex cursor-pointer flex-col items-center gap-4 rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-background-dark p-6 text-center shadow-sm transition-all hover:-translate-y-1 hover:shadow-lg hover:border-primary/50 dark:hover:border-primary/50"
                  href="views/publico/escolas"
                >
                  <div
                    class="flex h-16 w-16 items-center justify-center rounded-full bg-primary/10 text-primary transition-colors group-hover:bg-primary group-hover:text-white"
                  >
                    <span
                      class="material-symbols-outlined text-4xl"
                      data-icon="corporate_fare"
                      >corporate_fare</span
                    >
                  </div>
                  <div class="flex flex-col">
                    <p class="text-lg font-bold text-gray-900 dark:text-white">
                      Sou Escola
                    </p>
                  </div>
                </a>
              </div>
          </div>
        </main>
      </div>
    </div>
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const track = document.getElementById('carouselTrack');
        const slides = track.querySelectorAll('.flex-shrink-0');
        const prev = document.getElementById('prevBtn');
        const next = document.getElementById('nextBtn');
        const dotsContainer = document.getElementById('carouselDots');
        const dots = dotsContainer ? dotsContainer.querySelectorAll('.dot') : [];
        let index = 0;

        function update() {
          track.style.transform = `translateX(-${index * 100}%)`;
          if (dots.length) {
            dots.forEach((d, i) => d.style.opacity = i === index ? '1' : '0.5');
          }
        }

        prev.addEventListener('click', () => {
          index = (index - 1 + slides.length) % slides.length;
          update();
        });

        next.addEventListener('click', () => {
          index = (index + 1) % slides.length;
          update();
        });

        // Optional: autoplay
        // setInterval(() => { index = (index + 1) % slides.length; update(); }, 5000);

        // Initialize
        update();
      });
    </script>
</body>
<!--end::Body-->

</html>
