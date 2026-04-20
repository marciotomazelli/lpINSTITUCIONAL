import { Clock, TrendingUp, Zap } from "lucide-react";
import { WhatsAppCTA } from "@/components/WhatsAppButton";

const urgencies = [
  { icon: Clock, text: "Estoque limitado para alguns produtos" },
  { icon: TrendingUp, text: "Alta demanda de profissionais em todo o Brasil" },
  { icon: Zap, text: "Garanta seu atendimento prioritário" },
];

const UrgencySection = () => (
  <section className="bg-primary py-16 md:py-20">
    <div className="container mx-auto flex flex-col items-center gap-8 px-4 text-center">
      <h2 className="text-2xl font-bold text-primary-foreground md:text-3xl">
        Não perca tempo — fale agora com um especialista
      </h2>

      <div className="flex flex-wrap justify-center gap-6">
        {urgencies.map((u) => (
          <div key={u.text} className="flex items-center gap-2 text-primary-foreground/90">
            <u.icon className="h-5 w-5" />
            <span className="text-sm font-medium">{u.text}</span>
          </div>
        ))}
      </div>

      <WhatsAppCTA text="FALAR COM ESPECIALISTA AGORA" className="bg-whatsapp text-whatsapp-foreground" />
    </div>
  </section>
);

export default UrgencySection;
