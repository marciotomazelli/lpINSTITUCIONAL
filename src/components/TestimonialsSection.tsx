import { Star, MessageCircle, Send } from "lucide-react";
import { Card, CardContent } from "@/components/ui/card";

const testimonials = [
  {
    name: "Dra. Ana Carolina Puga",
    role: "Biomédica Esteta — Ribeirão Preto",
    text: "Desde que comecei a comprar da EstéticaBio, tenho total tranquilidade quanto à procedência. Nota fiscal, rastreabilidade e produtos sempre originais.",
  },
  {
    name: "Dra. Fernanda Andrade",
    role: "Farmacêutica Esteta — Sertãozinho/SP",
    text: "O atendimento consultivo faz toda a diferença. Me ajudaram a montar o mix ideal de produtos para minha clínica. Confiança total.",
  },
  {
    name: "Dra. Karina Rocha",
    role: "Farmacêutica Esteta — Sertãozinho/SP",
    text: "Já tive problemas com produtos sem procedência no passado. Com a EstéticaBio, nunca mais. Tudo regularizado e com entrega rápida.",
  },
  {
    name: "Dr. Tiago Rossi",
    role: "Matão e Vista Alegre do Alto/SP",
    text: "Parceria sólida e produtos de altíssima qualidade. Recomendo a EstéticaBio para todos os colegas que prezam por segurança e resultado.",
  },
  {
    name: "Dra. Rosely Adolfi",
    role: "Santos/SP",
    text: "Profissionalismo, agilidade na entrega e produtos originais. A EstéticaBio se tornou minha distribuidora de confiança.",
  },
];

const SHARE_REVIEW_URL =
  "https://wa.me/5516991232051?text=Olá!%20Gostaria%20de%20deixar%20meu%20depoimento%20sobre%20a%20EstéticaBio%20para%20ser%20publicado%20no%20site.";

const GOOGLE_REVIEWS_URL =
  "https://www.google.com/search?q=Est%C3%A9ticaBio+Sertaozinho#lrd=0x0:0x0,1";

// Google Maps embed apontando para a EstéticaBio (endereço oficial).
// Mostra o card do estabelecimento com nota, reviews e mapa.
const GOOGLE_MAPS_EMBED_URL =
  "https://www.google.com/maps?q=EsteticaBio+Rua+Carlos+Gomes+1839+Sertaozinho+SP&output=embed";

const TestimonialsSection = () => (
  <section id="depoimentos" className="bg-muted/50 py-20 md:py-28">
    <div className="container mx-auto px-4">
      <div className="mx-auto max-w-2xl text-center">
        <span className="inline-block rounded-full bg-primary/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-primary">
          Prova Social
        </span>
        <h2 className="mt-4 text-3xl font-bold tracking-tight md:text-4xl">
          Profissionais que confiam na EstéticaBio
        </h2>
        <p className="mt-4 text-muted-foreground">
          Veja o que dizem biomédicos, farmacêuticos, dentistas e médicos que compram conosco.
        </p>
      </div>

      <div className="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        {testimonials.map((t) => (
          <Card key={t.name} className="border bg-background">
            <CardContent className="flex h-full flex-col gap-4 p-6">
              <div className="flex gap-1">
                {[...Array(5)].map((_, i) => (
                  <Star key={i} className="h-4 w-4 fill-primary text-primary" />
                ))}
              </div>
              <p className="text-sm leading-relaxed text-muted-foreground">"{t.text}"</p>
              <div className="mt-auto pt-4">
                <p className="text-sm font-semibold">{t.name}</p>
                <p className="text-xs text-muted-foreground">{t.role}</p>
              </div>
            </CardContent>
          </Card>
        ))}
      </div>

      {/* Google Reviews — widget embed oficial */}
      <div className="mx-auto mt-16 max-w-4xl">
        <Card className="overflow-hidden border bg-background">
          <CardContent className="p-0">
            <div className="flex flex-col items-center gap-4 p-6 text-center md:flex-row md:text-left">
              <div className="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-primary/10">
                <svg viewBox="0 0 24 24" className="h-7 w-7" aria-hidden="true">
                  <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                  <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                  <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/>
                  <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
              </div>
              <div className="flex-1">
                <h3 className="text-lg font-bold">Avaliações no Google</h3>
                <p className="mt-1 text-sm text-muted-foreground">
                  Veja a localização e as avaliações reais da EstéticaBio direto no Google Maps.
                </p>
              </div>
              <a
                href={GOOGLE_REVIEWS_URL}
                target="_blank"
                rel="noopener noreferrer"
                className="inline-flex items-center justify-center gap-2 rounded-lg border border-input bg-background px-5 py-3 text-sm font-semibold transition-colors hover:bg-accent"
              >
                Abrir no Google
              </a>
            </div>
            <iframe
              src={GOOGLE_MAPS_EMBED_URL}
              title="Avaliações e localização da EstéticaBio no Google Maps"
              width="100%"
              height="380"
              style={{ border: 0 }}
              loading="lazy"
              referrerPolicy="no-referrer-when-downgrade"
              allowFullScreen
            />
          </CardContent>
        </Card>
      </div>

      {/* Share testimonial CTA */}
      <div className="mx-auto mt-8 max-w-3xl">
        <Card className="border-2 border-dashed border-primary/30 bg-primary/5">
          <CardContent className="flex flex-col items-center gap-4 p-8 text-center md:flex-row md:text-left">
            <div className="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-primary/10 text-primary">
              <MessageCircle className="h-7 w-7" />
            </div>
            <div className="flex-1">
              <h3 className="text-lg font-bold">Já é cliente? Compartilhe sua experiência!</h3>
              <p className="mt-1 text-sm text-muted-foreground">
                Envie seu depoimento pelo WhatsApp e publicaremos seu nome aqui no site como prova social.
              </p>
            </div>
            <a
              href={SHARE_REVIEW_URL}
              target="_blank"
              rel="noopener noreferrer"
              className="inline-flex items-center justify-center gap-2 rounded-lg bg-whatsapp px-5 py-3 text-sm font-bold text-whatsapp-foreground shadow-lg transition-all hover:scale-105"
            >
              <Send className="h-4 w-4" />
              Enviar meu depoimento
            </a>
          </CardContent>
        </Card>
      </div>
    </div>
  </section>
);

export default TestimonialsSection;
