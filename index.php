<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EstéticaBio — Produtos Estéticos com Segurança e Regularização ANVISA</title>
    <meta name="description" content="Distribuidora autorizada de produtos para harmonização facial com registro ANVISA, rastreabilidade de lotes e atendimento consultivo. Compre com segurança.">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Animate Source (AOS) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                container: {
                    center: true,
                    padding: '2rem',
                    screens: { '2xl': '1400px' },
                },
                extend: {
                    colors: {
                        border: 'hsl(30 15% 90%)',
                        input: 'hsl(30 15% 88%)',
                        ring: 'hsl(174 82% 38%)',
                        background: 'hsl(0 0% 100%)',
                        foreground: 'hsl(25 10% 15%)',
                        primary: {
                            DEFAULT: 'hsl(174 82% 38%)',
                            foreground: 'hsl(0 0% 100%)',
                        },
                        secondary: {
                            DEFAULT: 'hsl(35 40% 58%)',
                            foreground: 'hsl(0 0% 100%)',
                        },
                        destructive: {
                            DEFAULT: 'hsl(0 84.2% 60.2%)',
                            foreground: 'hsl(210 40% 98%)',
                        },
                        muted: {
                            DEFAULT: 'hsl(30 10% 94%)',
                            foreground: 'hsl(25 5% 45%)',
                        },
                        accent: {
                            DEFAULT: 'hsl(174 40% 93%)',
                            foreground: 'hsl(174 82% 25%)',
                        },
                        popover: {
                            DEFAULT: 'hsl(0 0% 100%)',
                            foreground: 'hsl(25 10% 15%)',
                        },
                        card: {
                            DEFAULT: 'hsl(30 20% 98%)',
                            foreground: 'hsl(25 10% 15%)',
                        },
                        whatsapp: {
                            DEFAULT: 'hsl(142 70% 45%)',
                            foreground: 'hsl(0 0% 100%)',
                        }
                    },
                    borderRadius: {
                        lg: '0.75rem',
                        md: 'calc(0.75rem - 2px)',
                        sm: 'calc(0.75rem - 4px)',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <style type="text/tailwindcss">
        @layer base {
            body { @apply bg-background text-foreground antialiased; }
        }
        .whatsapp-float {
            @apply fixed bottom-6 right-6 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-whatsapp text-whatsapp-foreground shadow-lg transition-all hover:scale-110 active:scale-95 md:h-16 md:w-16;
        }
        #mobile-nav.active { @apply flex translate-y-0 opacity-100; }
        .glass-nav { @apply sticky top-0 z-50 border-b bg-background/80 backdrop-blur-md; }
    </style>
    
    <link rel="icon" href="favicon.png">
</head>
<body class="flex min-h-screen flex-col">

    <!-- Header -->
    <header class="glass-nav">
      <div class="container mx-auto flex h-16 items-center justify-between px-4">
        <a href="#" class="flex items-center">
          <img src="assets/img/logo-esteticabio.png" alt="EstéticaBio" class="h-10">
        </a>

        <nav class="hidden items-center gap-6 lg:flex">
          <a href="#sobre" class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground">Sobre</a>
          <a href="#produtos" class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground">Produtos</a>
          <a href="#diferenciais" class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground">Diferenciais</a>
          <a href="#depoimentos" class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground">Depoimentos</a>
          <a href="#contato" class="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground">Contato</a>
          <a href="https://wa.me/5516991232051?text=Gostaria%20de%20falar%20com%20o%20especialista%20consultor%20de%20vendas" target="_blank" class="inline-flex items-center justify-center rounded-md bg-whatsapp px-4 py-2 text-sm font-medium text-whatsapp-foreground shadow hover:bg-whatsapp/90 transition-all">
            <i data-lucide="message-circle" class="mr-1.5 h-4 w-4"></i> WhatsApp
          </a>
        </nav>

        <button class="lg:hidden p-2 rounded-md hover:bg-muted" id="menu-toggle">
          <i data-lucide="menu" class="h-6 w-6" id="menu-icon"></i>
        </button>
      </div>

      <!-- Mobile Nav -->
      <nav id="mobile-nav" class="hidden absolute top-16 left-0 w-full flex-col gap-4 border-b bg-background px-4 py-6 shadow-xl lg:hidden transition-all duration-300 transform -translate-y-2 opacity-0">
          <a href="#sobre" class="text-base font-medium text-foreground py-2 link-mobile">Sobre</a>
          <a href="#produtos" class="text-base font-medium text-foreground py-2 link-mobile">Produtos</a>
          <a href="#diferenciais" class="text-base font-medium text-foreground py-2 link-mobile">Diferenciais</a>
          <a href="#depoimentos" class="text-base font-medium text-foreground py-2 link-mobile">Depoimentos</a>
          <a href="#contato" class="text-base font-medium text-foreground py-2 link-mobile">Contato</a>
          <a href="https://wa.me/5516991232051?text=Gostaria%20de%20falar%20com%20o%20especialista%20consultor%20de%20vendas" target="_blank" class="flex items-center justify-center rounded-lg bg-whatsapp py-3 text-sm font-bold text-whatsapp-foreground">
            <i data-lucide="message-circle" class="mr-2 h-5 w-5"></i> WhatsApp
          </a>
      </nav>
    </header>

    <main>
      <!-- Hero Section -->
      <section class="relative overflow-hidden bg-gradient-to-br from-primary/5 via-background to-accent/30 py-20 md:py-32">
        <div class="container mx-auto flex flex-col items-center gap-8 px-4 text-center" data-aos="fade-up">
          <div class="flex flex-wrap justify-center gap-3">
            <span class="inline-flex items-center gap-1.5 rounded-full border border-primary/20 bg-primary/5 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-primary">
              <i data-lucide="shield-check" class="h-3.5 w-3.5"></i> ANVISA
            </span>
            <span class="inline-flex items-center gap-1.5 rounded-full border border-primary/20 bg-primary/5 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-primary">
              <i data-lucide="file-check" class="h-3.5 w-3.5"></i> Nota Fiscal
            </span>
            <span class="inline-flex items-center gap-1.5 rounded-full border border-primary/20 bg-primary/5 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-primary">
              <i data-lucide="truck" class="h-3.5 w-3.5"></i> Entrega Rápida
            </span>
          </div>

          <h1 class="max-w-4xl text-4xl font-extrabold leading-tight tracking-tight md:text-6xl lg:text-7xl">
            Compre Produtos Estéticos com <span class="text-primary">Segurança, Procedência</span> e <span class="text-primary">Regularização ANVISA</span>
          </h1>

          <p class="max-w-2xl text-lg text-muted-foreground md:text-xl">
            Evite riscos, multas e produtos falsificados. Compre de uma distribuidora confiável, com rastreabilidade de lotes e atendimento consultivo.
          </p>

          <a href="https://wa.me/5516991232051?text=Gostaria%20de%20falar%20com%20o%20especialista%20consultor%20de%20vendas" target="_blank" class="inline-flex items-center justify-center rounded-xl bg-whatsapp px-10 py-5 text-xl font-bold text-whatsapp-foreground shadow-2xl transition-all hover:scale-105 hover:bg-whatsapp/90">
              <i data-lucide="message-circle" class="mr-3 h-7 w-7"></i> Falar com especialista agora
          </a>

          <p class="text-xs font-medium text-muted-foreground animate-pulse">
            ✅ Atendimento de segunda a sexta, das 8hs às 17:30 hs
          </p>
        </div>
      </section>

      <!-- Problem Section -->
      <section class="bg-[#1a1513] py-24 md:py-32">
        <div class="container mx-auto px-4">
          <div class="mx-auto max-w-2xl text-center" data-aos="fade-up">
            <span class="inline-block rounded-full bg-destructive/20 px-4 py-1.5 text-xs font-bold uppercase tracking-widest text-destructive">
              Atenção
            </span>
            <h2 class="mt-6 text-3xl font-extrabold tracking-tight text-white md:text-5xl">
              Você sabe realmente a origem dos produtos que está aplicando?
            </h2>
            <p class="mt-6 text-lg text-gray-400">
              Muitos profissionais correm riscos desnecessários sem saber.
            </p>
          </div>

          <div class="mt-20 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-3xl border border-white/10 bg-white/5 p-8 text-center transition-all hover:bg-white/10" data-aos="zoom-in" data-aos-delay="100">
              <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-destructive/20">
                <i data-lucide="shield-off" class="h-8 w-8 text-destructive"></i>
              </div>
              <h3 class="mt-6 text-lg font-bold text-white">Produtos falsificados</h3>
              <p class="mt-4 text-sm leading-relaxed text-gray-400">Mercado inundado por produtos sem procedência, colocando a saúde dos pacientes em risco.</p>
            </div>
            <div class="rounded-3xl border border-white/10 bg-white/5 p-8 text-center transition-all hover:bg-white/10" data-aos="zoom-in" data-aos-delay="200">
              <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-destructive/20">
                <i data-lucide="alert-triangle" class="h-8 w-8 text-destructive"></i>
              </div>
              <h3 class="mt-6 text-lg font-bold text-white">Risco com vigilância</h3>
              <p class="mt-4 text-sm leading-relaxed text-gray-400">Uso de produtos irregulares pode resultar em multas, interdição e processos judiciais.</p>
            </div>
            <div class="rounded-3xl border border-white/10 bg-white/5 p-8 text-center transition-all hover:bg-white/10" data-aos="zoom-in" data-aos-delay="300">
              <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-destructive/20">
                <i data-lucide="file-x" class="h-8 w-8 text-destructive"></i>
              </div>
              <h3 class="mt-6 text-lg font-bold text-white">Sem Nota Fiscal</h3>
              <p class="mt-4 text-sm leading-relaxed text-gray-400">Sem documentação, você não tem como provar a procedência e se proteger legalmente.</p>
            </div>
            <div class="rounded-3xl border border-white/10 bg-white/5 p-8 text-center transition-all hover:bg-white/10" data-aos="zoom-in" data-aos-delay="400">
              <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-destructive/20">
                <i data-lucide="user-x" class="h-8 w-8 text-destructive"></i>
              </div>
              <h3 class="mt-6 text-lg font-bold text-white">Perda de pacientes</h3>
              <p class="mt-4 text-sm leading-relaxed text-gray-400">Complicações por produtos de baixa qualidade destroem sua reputação profissional.</p>
            </div>
          </div>
        </div>
      </section>

      <!-- About Section -->
      <section id="sobre" class="py-24 md:py-32 overflow-hidden">
        <div class="container mx-auto px-4">
          <div class="mx-auto max-w-2xl text-center" data-aos="fade-up">
            <span class="inline-block rounded-full bg-primary/10 px-4 py-2 text-xs font-bold uppercase tracking-widest text-primary">
              A Solução
            </span>
            <h2 class="mt-6 text-3xl font-extrabold tracking-tight md:text-5xl text-foreground">
              EstéticaBio: Sua distribuidora de confiança
            </h2>
            <p class="mt-6 text-lg text-muted-foreground italic">
              "Segurança de excelência para os profissionais da Estética"
            </p>
            <p class="mt-4 text-muted-foreground leading-relaxed">
              Somos uma distribuidora autorizada de produtos para estética avançada, com parceria estratégica com instituições de ensino. 
            </p>
          </div>

          <div class="mt-20 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
            <div class="group flex flex-col items-center rounded-3xl border bg-card p-10 text-center transition-all hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
              <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-primary/10 transition-colors group-hover:bg-primary/20">
                <i data-lucide="shield-check" class="h-8 w-8 text-primary"></i>
              </div>
              <h3 class="mt-6 text-xl font-bold">Procedência</h3>
              <p class="mt-4 text-sm text-muted-foreground">Registro ANVISA e rastreabilidade completa de lotes.</p>
            </div>
            <div class="group flex flex-col items-center rounded-3xl border bg-card p-10 text-center transition-all hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
              <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-primary/10 transition-colors group-hover:bg-primary/20">
                <i data-lucide="file-check" class="h-8 w-8 text-primary"></i>
              </div>
              <h3 class="mt-6 text-xl font-bold">Documentação</h3>
              <p class="mt-4 text-sm text-muted-foreground">Documentos para qualificação da estéticaBio como sua fornecedora, entre eles alvará sanitário, licença de funcionamento e emissão de notas fiscais</p>
            </div>
            <div class="group flex flex-col items-center rounded-3xl border bg-card p-10 text-center transition-all hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
              <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-primary/10 transition-colors group-hover:bg-primary/20">
                <i data-lucide="heart-handshake" class="h-8 w-8 text-primary"></i>
              </div>
              <h3 class="mt-6 text-xl font-bold">Consultoria</h3>
              <p class="mt-4 text-sm text-muted-foreground">Equipe técnica pronta para ajudar na estratégia da sua clínica.</p>
            </div>
            <div class="group flex flex-col items-center rounded-3xl border bg-card p-10 text-center transition-all hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="400">
              <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-primary/10 transition-colors group-hover:bg-primary/20">
                <i data-lucide="headphones" class="h-8 w-8 text-primary"></i>
              </div>
              <h3 class="mt-6 text-xl font-bold">Suporte</h3>
              <p class="mt-4 text-sm text-muted-foreground">Acompanhamento pós-venda garantido com rapidez.</p>
            </div>
          </div>

          <div class="mt-16 flex justify-center" data-aos="zoom-in">
            <a href="https://wa.me/5516991232051?text=Gostaria%20de%20falar%20com%20o%20especialista%20consultor%20de%20vendas" target="_blank" class="inline-flex items-center justify-center rounded-xl bg-whatsapp px-8 py-4 text-lg font-bold text-whatsapp-foreground shadow-lg transition-all hover:scale-105">
              Falar com especialista agora
            </a>
          </div>
        </div>
      </section>

      <!-- Products Section -->
      <section id="produtos" class="bg-muted/30 py-24 md:py-32">
        <div class="container mx-auto px-4 text-foreground">
          <div class="mx-auto max-w-2xl text-center" data-aos="fade-up">
            <span class="inline-block rounded-full bg-primary/10 px-4 py-2 text-xs font-bold uppercase tracking-widest text-primary">Catálogo</span>
            <h2 class="mt-6 text-3xl font-extrabold tracking-tight md:text-5xl">Produtos Premium Selecionados</h2>
            <p class="mt-6 text-muted-foreground leading-relaxed">
              Trabalhamos apenas com as melhores marcas do mercado mundial.
            </p>
          </div>

          <div class="mt-20 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
            <!-- P1 -->
            <div class="group h-full rounded-3xl border border-transparent bg-background p-10 text-center shadow-sm transition-all hover:border-primary/30 hover:shadow-2xl" data-aos="fade-up" data-aos-delay="100">
              <div class="flex h-20 w-20 mx-auto items-center justify-center rounded-3xl bg-primary/10 transition-transform group-hover:rotate-6">
                <i data-lucide="syringe" class="h-10 w-10 text-primary"></i>
              </div>
              <h3 class="mt-8 text-2xl font-bold">Preenchedores</h3>
              <p class="mt-4 text-sm text-muted-foreground leading-relaxed">Ácido hialurônico para volumização e contorno.</p>
              <div class="mt-6 flex flex-wrap justify-center gap-2">
                <span class="rounded-full border bg-primary/5 px-4 py-1 text-xs font-bold text-primary">Rennova</span>
                <span class="rounded-full border bg-primary/5 px-4 py-1 text-xs font-bold text-primary">Merz</span>
                <span class="rounded-full border bg-primary/5 px-4 py-1 text-xs font-bold text-primary">Ilikia</span>
              </div>
            </div>
            <!-- P2 -->
            <div class="group h-full rounded-3xl border border-transparent bg-background p-10 text-center shadow-sm transition-all hover:border-primary/30 hover:shadow-2xl" data-aos="fade-up" data-aos-delay="200">
              <div class="flex h-20 w-20 mx-auto items-center justify-center rounded-3xl bg-primary/10 transition-transform group-hover:rotate-6">
                <i data-lucide="sparkles" class="h-10 w-10 text-primary"></i>
              </div>
              <h3 class="mt-8 text-2xl font-bold">Bioestimuladores</h3>
              <p class="mt-4 text-sm text-muted-foreground leading-relaxed">Estimulam a produção natural de colágeno.</p>
              <div class="mt-6 flex flex-wrap justify-center gap-2">
                <span class="rounded-full border bg-primary/5 px-4 py-1 text-xs font-bold text-primary">Rennova</span>
                <span class="rounded-full border bg-primary/5 px-4 py-1 text-xs font-bold text-primary">Merz</span>
              </div>
            </div>
            <!-- P3 -->
            <div class="group h-full rounded-3xl border border-transparent bg-background p-10 text-center shadow-sm transition-all hover:border-primary/30 hover:shadow-2xl" data-aos="fade-up" data-aos-delay="300">
              <div class="flex h-20 w-20 mx-auto items-center justify-center rounded-3xl bg-primary/10 transition-transform group-hover:rotate-6">
                <i data-lucide="flask-conical" class="h-10 w-10 text-primary"></i>
              </div>
              <h3 class="mt-8 text-2xl font-bold">Toxina</h3>
              <p class="mt-4 text-sm text-muted-foreground leading-relaxed">Alta precisão e rastreabilidade total.</p>
              <div class="mt-6 flex flex-wrap justify-center gap-2">
                <span class="rounded-full border bg-primary/5 px-4 py-1 text-xs font-bold text-primary">Rennova</span>
                <span class="rounded-full border bg-primary/5 px-4 py-1 text-xs font-bold text-primary">Allergan</span>
              </div>
            </div>
            <!-- P4 -->
            <div class="group h-full rounded-3xl border border-transparent bg-background p-10 text-center shadow-sm transition-all hover:border-primary/30 hover:shadow-2xl" data-aos="fade-up" data-aos-delay="400">
              <div class="flex h-20 w-20 mx-auto items-center justify-center rounded-3xl bg-primary/10 transition-transform group-hover:rotate-6">
                <i data-lucide="droplets" class="h-10 w-10 text-primary"></i>
              </div>
              <h3 class="mt-8 text-2xl font-bold">Cosméticos</h3>
              <p class="mt-4 text-sm text-muted-foreground leading-relaxed">Profissional e linha completa Home Care.</p>
              <div class="mt-6 flex flex-wrap justify-center gap-2">
                <span class="rounded-full border bg-primary/5 px-4 py-1 text-xs font-bold text-primary">Samana</span>
                <span class="rounded-full border bg-primary/5 px-4 py-1 text-xs font-bold text-primary">SmartGr</span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Differentials Section -->
      <section id="diferenciais" class="py-24 md:py-32">
        <div class="container mx-auto px-4">
          <div class="mx-auto max-w-2xl text-center" data-aos="fade-up">
            <span class="inline-block rounded-full bg-primary/10 px-4 py-2 text-xs font-bold uppercase tracking-widest text-primary">
              Nossa Essência
            </span>
            <h2 class="mt-6 text-3xl font-extrabold tracking-tight md:text-5xl text-foreground">
              Porque as clínicas e profissionais confiam na Estéticabio?
            </h2>
          </div>

          <div class="mt-20 grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
            <div class="flex items-start gap-6 rounded-3xl border bg-card p-8 shadow-sm transition-all hover:shadow-lg" data-aos="fade-right" data-aos-delay="100">
              <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-primary/10">
                <i data-lucide="shield-check" class="h-7 w-7 text-primary"></i>
              </div>
              <div>
                <h3 class="text-lg font-bold">Regulamentação Total</h3>
                <p class="mt-2 text-sm text-muted-foreground leading-relaxed">100% dos produtos com registro ativo e regularizado na ANVISA.</p>
              </div>
            </div>
            <div class="flex items-start gap-6 rounded-3xl border bg-card p-8 shadow-sm transition-all hover:shadow-lg" data-aos="fade-right" data-aos-delay="200">
              <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-primary/10">
                <i data-lucide="graduation-cap" class="h-7 w-7 text-primary"></i>
              </div>
              <div>
                <h3 class="text-lg font-bold">Parceria Educacional</h3>
                <p class="mt-2 text-sm text-muted-foreground leading-relaxed">Atendemos alunos e professores de grandes instituições de ensino.</p>
              </div>
            </div>
            <div class="flex items-start gap-6 rounded-3xl border bg-card p-8 shadow-sm transition-all hover:shadow-lg" data-aos="fade-right" data-aos-delay="300">
              <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-primary/10">
                <i data-lucide="truck" class="h-7 w-7 text-primary"></i>
              </div>
              <div>
                <h3 class="text-lg font-bold">Entrega Ágil</h3>
                <p class="mt-2 text-sm text-muted-foreground leading-relaxed">Logística otimizada para todo o Brasil com proteção térmica se necessário.</p>
              </div>
            </div>
            <div class="flex items-start gap-6 rounded-3xl border bg-card p-8 shadow-sm transition-all hover:shadow-lg" data-aos="fade-right" data-aos-delay="400">
              <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-primary/10">
                <i data-lucide="heart-handshake" class="h-7 w-7 text-primary"></i>
              </div>
              <div>
                <h3 class="text-lg font-bold">Atendimento Humano</h3>
                <p class="mt-2 text-sm text-muted-foreground leading-relaxed">Aqui você não fala com robôs. Temos consultores reais dedicados a você.</p>
              </div>
            </div>
            <div class="flex items-start gap-6 rounded-3xl border bg-card p-8 shadow-sm transition-all hover:shadow-lg" data-aos="fade-right" data-aos-delay="500">
              <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-primary/10">
                <i data-lucide="clipboard-check" class="h-7 w-7 text-primary"></i>
              </div>
              <div>
                <h3 class="text-lg font-bold">Consultoria Comercial</h3>
                <p class="mt-2 text-sm text-muted-foreground leading-relaxed">Ajudamos você a escolher os produtos que mais rentabilizam seu consultório.</p>
              </div>
            </div>
            <div class="flex items-start gap-6 rounded-3xl border bg-card p-8 shadow-sm transition-all hover:shadow-lg" data-aos="fade-right" data-aos-delay="600">
              <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-primary/10">
                <i data-lucide="users" class="h-7 w-7 text-primary"></i>
              </div>
              <div>
                <h3 class="text-lg font-bold">Comunidade VIP</h3>
                <p class="mt-2 text-sm text-muted-foreground leading-relaxed">Milhares de profissionais formando a maior rede de estética do país.</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Testimonials Section -->
      <section id="depoimentos" class="bg-muted/40 py-24 md:py-32">
        <div class="container mx-auto px-4">
          <div class="mx-auto max-w-2xl text-center" data-aos="fade-up">
            <span class="inline-block rounded-full bg-primary/10 px-4 py-2 text-xs font-bold uppercase tracking-widest text-primary">Resultados Reais</span>
            <h2 class="mt-6 text-3xl font-extrabold md:text-5xl">O que dizem os especialistas</h2>
          </div>

          <div class="mt-20 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <!-- T1 -->
            <div class="rounded-3xl border bg-background p-10 shadow-sm transition-all hover:shadow-xl" data-aos="fade-up" data-aos-delay="100">
              <div class="flex gap-1 mb-6">
                <i data-lucide="star" class="h-5 w-5 fill-primary text-primary"></i>
                <i data-lucide="star" class="h-5 w-5 fill-primary text-primary"></i>
                <i data-lucide="star" class="h-5 w-5 fill-primary text-primary"></i>
                <i data-lucide="star" class="h-5 w-5 fill-primary text-primary"></i>
                <i data-lucide="star" class="h-5 w-5 fill-primary text-primary"></i>
              </div>
              <p class="text-lg leading-relaxed text-muted-foreground font-medium italic">"Desde que comecei a comprar da EstéticaBio, tenho total tranquilidade. Nota fiscal, rastreabilidade e produtos de alta qualidade."</p>
              <div class="mt-10 flex items-center gap-4">
                <div class="h-12 w-12 rounded-full bg-primary/10 flex items-center justify-center font-bold text-primary">ACP</div>
                <div>
                  <p class="text-base font-bold">Dra. Ana Carolina Puga</p>
                  <p class="text-xs text-muted-foreground uppercase tracking-widest font-semibold">Biomédica Esteta</p>
                </div>
              </div>
            </div>
            <!-- T2 -->
            <div class="rounded-3xl border bg-background p-10 shadow-sm transition-all hover:shadow-xl" data-aos="fade-up" data-aos-delay="200">
              <div class="flex gap-1 mb-6">
                <i data-lucide="star" class="h-5 w-5 fill-primary text-primary"></i>
                <i data-lucide="star" class="h-5 w-5 fill-primary text-primary"></i>
                <i data-lucide="star" class="h-5 w-5 fill-primary text-primary"></i>
                <i data-lucide="star" class="h-5 w-5 fill-primary text-primary"></i>
                <i data-lucide="star" class="h-5 w-5 fill-primary text-primary"></i>
              </div>
              <p class="text-lg leading-relaxed text-muted-foreground font-medium italic">"O atendimento consultivo faz toda a diferença. Me ajudaram a montar o mix ideal. Confiança e segurança para meus pacientes."</p>
              <div class="mt-10 flex items-center gap-4">
                <div class="h-12 w-12 rounded-full bg-primary/10 flex items-center justify-center font-bold text-primary">FA</div>
                <div>
                  <p class="text-base font-bold">Dra. Fernanda Andrade</p>
                  <p class="text-xs text-muted-foreground uppercase tracking-widest font-semibold">Farmacêutica Esteta</p>
                </div>
              </div>
            </div>
            <!-- T3 -->
            <div class="rounded-3xl border bg-background p-10 shadow-sm transition-all hover:shadow-xl" data-aos="fade-up" data-aos-delay="300">
              <div class="flex gap-1 mb-6">
                <i data-lucide="star" class="h-5 w-5 fill-primary text-primary"></i>
                <i data-lucide="star" class="h-5 w-5 fill-primary text-primary"></i>
                <i data-lucide="star" class="h-5 w-5 fill-primary text-primary"></i>
                <i data-lucide="star" class="h-5 w-5 fill-primary text-primary"></i>
                <i data-lucide="star" class="h-5 w-5 fill-primary text-primary"></i>
              </div>
              <p class="text-lg leading-relaxed text-muted-foreground font-medium italic">"Parceria sólida e produtos autênticos. Recomendo a EstéticaBio para quem preza por segurança e resultados clínicos."</p>
              <div class="mt-10 flex items-center gap-4">
                <div class="h-12 w-12 rounded-full bg-primary/10 flex items-center justify-center font-bold text-primary">TR</div>
                <div>
                  <p class="text-base font-bold">Dr. Tiago Rossi</p>
                  <p class="text-xs text-muted-foreground uppercase tracking-widest font-semibold">Farmacêutico Esteta</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Google Maps Review Section -->
          <div class="mx-auto mt-20 max-w-5xl overflow-hidden rounded-[2rem] border bg-background shadow-2xl" data-aos="fade-up">
            <div class="flex flex-col items-center gap-6 p-8 text-center md:flex-row md:text-left">
              <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-3xl bg-primary/10">
                <svg viewBox="0 0 24 24" class="h-10 w-10"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
              </div>
              <div class="flex-1">
                <h3 class="text-2xl font-bold">Estamos no Google Maps</h3>
                <p class="mt-2 text-lg text-muted-foreground leading-relaxed">Confira nossas avaliações 5 estrelas e nossa localização oficial.</p>
              </div>
              <a href="https://www.google.com/search?q=Est%C3%A9ticaBio+Sertaozinho" target="_blank" class="flex h-14 items-center justify-center rounded-2xl border border-input bg-background px-8 text-base font-bold shadow-sm transition-all hover:bg-accent">
                Ver no Google
              </a>
            </div>
            <iframe src="https://www.google.com/maps?q=EsteticaBio+Rua+Carlos+Gomes+1839+Sertaozinho+SP&output=embed" width="100%" height="450" style="border: 0" loading="lazy"></iframe>
          </div>
        </div>
      </section>

      <!-- Urgency Section -->
      <section class="bg-primary py-20">
        <div class="container mx-auto flex flex-col items-center gap-10 px-4 text-center">
          <h2 class="text-3xl font-extrabold text-white md:text-5xl" data-aos="fade-down">
            Pronto para levar segurança para sua clínica?
          </h2>
          <div class="flex flex-wrap justify-center gap-10" data-aos="fade-up">
            <div class="flex items-center gap-3 text-white/90">
              <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10"><i data-lucide="clock" class="h-6 w-6"></i></div>
              <span class="text-lg font-bold">Estoque Rápido</span>
            </div>
            <div class="flex items-center gap-3 text-white/90">
              <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10"><i data-lucide="trending-up" class="h-6 w-6"></i></div>
              <span class="text-lg font-bold">Top Marcas</span>
            </div>
            <div class="flex items-center gap-3 text-white/90">
              <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10"><i data-lucide="zap" class="h-6 w-6"></i></div>
              <span class="text-lg font-bold">Suporte Prioritário</span>
            </div>
          </div>
          <a href="https://wa.me/5516991232051?text=Gostaria%20de%20falar%20com%20o%20especialista%20consultor%20de%20vendas" target="_blank" class="inline-flex items-center justify-center rounded-2xl bg-whatsapp px-12 py-6 text-2xl font-black text-whatsapp-foreground shadow-[0_20px_50px_rgba(37,211,102,0.4)] transition-all hover:scale-105 active:scale-100">
            FALAR COM ESPECIALISTA AGORA
          </a>
        </div>
      </section>

      <!-- Guarantee Section -->
      <section class="py-24 md:py-32 bg-white">
        <div class="container mx-auto px-4">
          <div class="mx-auto max-w-2xl text-center" data-aos="fade-up">
            <span class="inline-block rounded-full bg-primary/10 px-4 py-2 text-xs font-bold uppercase tracking-widest text-primary">Selo de Qualidade</span>
            <h2 class="mt-6 text-3xl font-extrabold md:text-5xl text-foreground">Sua segurança acima de tudo</h2>
          </div>
          <div class="mt-20 grid gap-10 md:grid-cols-3">
            <div class="flex flex-col items-center rounded-[2.5rem] border bg-background p-12 text-center" data-aos="zoom-in" data-aos-delay="100">
              <div class="flex h-20 w-20 items-center justify-center rounded-full bg-primary/10 mb-8">
                <i data-lucide="shield-check" class="h-10 w-10 text-primary"></i>
              </div>
              <h3 class="text-2xl font-bold">Compra Segura</h3>
              <p class="mt-4 text-base text-muted-foreground leading-relaxed text-gray-500">Pagamento protegido e dados criptografados para sua total tranquilidade.</p>
            </div>
            <div class="flex flex-col items-center rounded-[2.5rem] border bg-background p-12 text-center" data-aos="zoom-in" data-aos-delay="200">
              <div class="flex h-20 w-20 items-center justify-center rounded-full bg-primary/10 mb-8">
                <i data-lucide="package" class="h-10 w-10 text-primary"></i>
              </div>
              <h3 class="text-2xl font-bold">Origem Certificada</h3>
              <p class="mt-4 text-base text-muted-foreground leading-relaxed text-gray-500">Garantia absoluta de autenticidade em todos os rótulos e lacres.</p>
            </div>
            <div class="flex flex-col items-center rounded-[2.5rem] border bg-background p-12 text-center" data-aos="zoom-in" data-aos-delay="300">
              <div class="flex h-20 w-20 items-center justify-center rounded-full bg-primary/10 mb-8">
                <i data-lucide="eye" class="h-10 w-10 text-primary"></i>
              </div>
              <h3 class="text-2xl font-bold">Transparência</h3>
              <p class="mt-4 text-base text-muted-foreground leading-relaxed text-gray-500">Acesso livre a NF, laudos técnicos e certificados a qualquer momento.</p>
            </div>
          </div>
        </div>
      </section>

      <section id="contato" class="bg-muted/30 py-24 md:py-32">
        <div class="container mx-auto px-4">
          <!-- Mobile Title -->
          <div class="md:hidden text-center mb-12" data-aos="fade-up">
            <h2 class="text-4xl font-extrabold tracking-tight text-foreground">Fale conosco</h2>
            <p class="mt-4 text-lg text-muted-foreground leading-relaxed">Solicite uma cotação personalizada. Respondemos em até 2 horas úteis.</p>
          </div>

          <div class="mx-auto max-w-4xl flex flex-col-reverse md:grid md:grid-cols-2 gap-20">
            <div data-aos="fade-right">
              <h2 class="hidden md:block text-4xl font-extrabold tracking-tight md:text-6xl text-foreground">Fale conosco</h2>
              <p class="hidden md:block mt-6 text-xl text-muted-foreground leading-relaxed">Solicite uma cotação personalizada. Respondemos em até 2 horas úteis.</p>
              
              <div class="mt-12 flex flex-col gap-8">
                <div class="flex items-start gap-6">
                  <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-primary/10 text-primary"><i data-lucide="map-pin" class="h-7 w-7"></i></div>
                  <div>
                    <p class="text-lg font-bold">Sede</p>
                    <p class="text-base text-muted-foreground">Rua Carlos Gomes, 1839, Centro - Sertãozinho - SP - CEP 14160-530</p>
                  </div>
                </div>
                <div class="flex items-start gap-6">
                  <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-primary/10 text-primary"><i data-lucide="mail" class="h-7 w-7"></i></div>
                  <div>
                    <p class="text-lg font-bold">E-mail Comercial</p>
                    <p class="text-base text-muted-foreground">contato@esteticabio.com.br</p>
                  </div>
                </div>
                <div class="flex items-start gap-6">
                  <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-primary/10 text-primary"><i data-lucide="phone" class="h-7 w-7"></i></div>
                  <div>
                    <p class="text-lg font-bold">Telefone</p>
                    <p class="text-base text-muted-foreground">(16) 3524-1764</p>
                  </div>
                </div>
                <div class="flex items-start gap-6">
                  <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-whatsapp/10 text-whatsapp"><i data-lucide="message-circle" class="h-7 w-7"></i></div>
                  <div>
                    <p class="text-lg font-bold text-whatsapp">WhatsApp</p>
                    <a href="https://wa.me/5516991232051?text=Gostaria%20de%20falar%20com%20o%20especialista%20consultor%20de%20vendas" target="_blank" class="text-lg font-bold text-whatsapp underline">Clique para Falar Agora</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="rounded-[2.5rem] bg-background border p-10 shadow-2xl" data-aos="fade-left">
              <form id="lead-form" class="flex flex-col gap-6">
                <div class="grid gap-2">
                    <label class="text-sm font-bold ml-1">Nome Completo</label>
                    <input type="text" name="name" class="h-14 rounded-2xl border px-5 focus:ring-2 focus:ring-primary outline-none" placeholder="Digite seu nome" required>
                </div>
                <div class="grid gap-2">
                    <label class="text-sm font-bold ml-1">E-mail</label>
                    <input type="email" name="email" class="h-14 rounded-2xl border px-5 focus:ring-2 focus:ring-primary outline-none" placeholder="seu@email.com">
                </div>
                <div class="grid gap-2">
                    <label class="text-sm font-bold ml-1">WhatsApp</label>
                    <input type="tel" name="phone" id="phone" class="h-14 rounded-2xl border px-5 focus:ring-2 focus:ring-primary outline-none" value="+55 ">
                </div>
                <div class="grid gap-2">
                    <label class="text-sm font-bold ml-1">Especialidade / Profissão</label>
                    <select name="specialty" class="h-14 rounded-2xl border px-5 focus:ring-2 focus:ring-primary outline-none bg-white" required>
                        <option value="" disabled selected>Selecione sua especialidade</option>
                        <option value="Biomédico">Biomédico</option>
                        <option value="Dentista">Dentista</option>
                        <option value="Farmacêutico">Farmacêutico</option>
                        <option value="Enfermeiro">Enfermeiro</option>
                        <option value="Fisioterapeuta">Fisioterapeuta</option>
                        <option value="Biólogo">Biólogo</option>
                        <option value="Esteticista">Esteticista</option>
                        <option value="Médico">Médico</option>
                        <option value="Outras">Outras</option>
                    </select>
                </div>
                <div class="grid gap-2">
                    <label class="text-sm font-bold ml-1">Mensagem</label>
                    <textarea name="message" class="h-32 rounded-2xl border p-5 focus:ring-2 focus:ring-primary outline-none resize-none" placeholder="Como podemos te ajudar?" required></textarea>
                </div>
                <button type="submit" id="submit-btn" class="h-16 rounded-2xl bg-primary text-white font-black text-lg shadow-xl hover:shadow-2xl transition-all active:scale-95">
                    ENVIAR MENSAGEM
                </button>
              </form>
            </div>
          </div>
        </div>
      </section>
    </main>

    <footer class="bg-[#1a1513] text-white py-20 border-t border-white/5">
        <div class="container mx-auto px-4">
            <div class="flex flex-col items-center justify-between gap-10 md:flex-row">
                <div class="text-center md:text-left">
                    <img src="assets/img/logo-esteticabio.png" alt="EstéticaBio" class="h-12 brightness-0 invert mx-auto md:mx-0">
                    <p class="mt-4 text-sm text-gray-400 max-w-sm">Distribuidora autorizada de produtos para estética avançada. CNPJ: 22.373.525/0001-05</p>
                </div>
                <div class="flex flex-wrap justify-center md:justify-start gap-x-8 gap-y-2 text-sm font-bold text-gray-400 uppercase tracking-widest leading-loose">
                    <a href="#sobre" class="hover:text-primary transition-colors">Sobre</a>
                    <a href="#produtos" class="hover:text-primary transition-colors">Produtos</a>
                    <a href="#diferenciais" class="hover:text-primary transition-colors">Diferenciais</a>
                    <a href="#depoimentos" class="hover:text-primary transition-colors">Depoimentos</a>
                    <a href="#contato" class="hover:text-primary transition-colors">Contato</a>
                </div>
                <p class="text-xs text-gray-500 font-medium">© <?php echo date('Y'); ?> EstéticaBio. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <a href="https://wa.me/5516991232051?text=Gostaria%20de%20falar%20com%20o%20especialista%20consultor%20de%20vendas" target="_blank" class="whatsapp-float group">
        <i data-lucide="message-circle" class="h-8 w-8 transition-transform group-hover:scale-110"></i>
    </a>

    <script>
        // Init Lucide
        lucide.createIcons();
        
        // Init AOS
        AOS.init({ duration: 1000, once: true });

        // Mobile Menu
        const menuToggle = document.getElementById('menu-toggle');
        const mobileNav = document.getElementById('mobile-nav');
        const menuIcon = document.getElementById('menu-icon');
        
        menuToggle.addEventListener('click', () => {
            mobileNav.classList.toggle('hidden');
            setTimeout(() => mobileNav.classList.toggle('active'), 10);
            
            const isOpen = mobileNav.classList.contains('active');
            menuIcon.setAttribute('data-lucide', isOpen ? 'x' : 'menu');
            lucide.createIcons();
        });

        // Close menu on link click
        document.querySelectorAll('.link-mobile').forEach(link => {
            link.addEventListener('click', () => {
                mobileNav.classList.remove('active');
                setTimeout(() => mobileNav.classList.add('hidden'), 300);
                menuIcon.setAttribute('data-lucide', 'menu');
                lucide.createIcons();
            });
        });

        // Form Handling
        const leadForm = document.getElementById('lead-form');
        const submitBtn = document.getElementById('submit-btn');

        // Phone mask and protection
        const phoneInput = document.getElementById('phone');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                if (!this.value.startsWith('+55 ')) {
                    this.value = '+55 ' + this.value.replace(/^\+55\s*/, '');
                }
            });

            phoneInput.addEventListener('keydown', function(e) {
                // Prevent deleting +55
                if (this.selectionStart < 4 && (e.key === 'Backspace' || e.key === 'Delete')) {
                    e.preventDefault();
                }
            });
        }

        if (leadForm) {
            leadForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                submitBtn.disabled = true;
                submitBtn.innerText = 'ENVIANDO...';

                const formData = new FormData(leadForm);
                const data = Object.fromEntries(formData.entries());

                try {
                    const response = await fetch('api/save_lead.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify(data)
                    });

                    const result = await response.json();
                    if (result.status === 'success') {
                        alert('Mensagem enviada com sucesso! Nossa equipe entrará em contato em breve.');
                        leadForm.reset();
                    } else {
                        alert('Erro ao enviar: ' + (result.message || 'Tente novamente.'));
                    }
                } catch (error) {
                    alert('Erro de conexão com o servidor.');
                } finally {
                    submitBtn.disabled = false;
                    submitBtn.innerText = 'ENVIAR MENSAGEM';
                }
            });
        }
    </script>
</body>
</html>
