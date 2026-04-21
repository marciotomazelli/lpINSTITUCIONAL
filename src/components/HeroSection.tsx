import { WhatsAppCTA } from "@/components/WhatsAppButton";
import { ShieldCheck, FileCheck, Truck } from "lucide-react";

const badges = [
  { icon: ShieldCheck, text: "ANVISA" },
  { icon: FileCheck, text: "Nota Fiscal" },
  { icon: Truck, text: "Entrega Rápida" },
];

const HeroSection = () => (
  <section className="relative overflow-hidden bg-gradient-to-br from-primary/5 via-background to-accent/30 py-20 md:py-32">
    <div className="container mx-auto flex flex-col items-center gap-8 px-4 text-center">
      <div className="flex flex-wrap justify-center gap-3">
        {badges.map((b) => (
          <span key={b.text} className="inline-flex items-center gap-1.5 rounded-full border border-primary/20 bg-primary/5 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-primary">
            <b.icon className="h-3.5 w-3.5" />
            {b.text}
          </span>
        ))}
      </div>

      <h1 className="max-w-4xl text-3xl font-extrabold leading-tight tracking-tight md:text-5xl lg:text-6xl">
        Compre Produtos Estéticos com{" "}
        <span className="text-primary">Segurança, Procedência</span> e{" "}
        <span className="text-primary">Regularização ANVISA</span>
      </h1>

      <p className="max-w-2xl text-lg text-muted-foreground md:text-xl">
        Evite riscos, multas e produtos falsificados. Compre de uma distribuidora confiável, com rastreabilidade de lotes e atendimento consultivo.
      </p>

      <WhatsAppCTA />

      <p className="text-xs text-muted-foreground">
        ✅ Atendimento de segunda a sexta, das 8hs as 17:30hs
      </p>
    </div>
  </section>
);

export default HeroSection;
