import { ShieldCheck, FileCheck, HeartHandshake, Headphones } from "lucide-react";
import { WhatsAppCTA } from "@/components/WhatsAppButton";

const solutions = [
  { icon: ShieldCheck, title: "Procedência garantida", desc: "Todos os produtos com registro ANVISA e rastreabilidade completa de lotes." },
  { icon: FileCheck, title: "Nota fiscal e documentação", desc: "Toda compra acompanhada de Nota Fiscal" },
  { icon: HeartHandshake, title: "Atendimento consultivo", desc: "Equipe especializada para ajudar na escolha dos melhores produtos para sua clínica." },
  { icon: Headphones, title: "Suporte completo", desc: "Acompanhamento pós-venda, suporte técnico e orientação sobre armazenamento." },
];

const AboutSection = () => (
  <section id="sobre" className="py-20 md:py-28">
    <div className="container mx-auto px-4">
      <div className="mx-auto max-w-2xl text-center">
        <span className="inline-block rounded-full bg-primary/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-primary">
          A Solução
        </span>
        <h2 className="mt-4 text-3xl font-bold tracking-tight md:text-4xl">
          EstéticaBio: Sua distribuidora de confiança
        </h2>
        <p className="mt-4 text-muted-foreground">
          Somos uma distribuidora Autorizada de produtos para estética avançada, com parcerias estratégicas com Clínicas e Instituições de Ensino. Atuamos com foco em segurança, legalidade e excelência para o profissional.
        </p>
      </div>

      <div className="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        {solutions.map((s) => (
          <div key={s.title} className="flex flex-col items-center rounded-2xl border bg-card p-8 text-center transition-shadow hover:shadow-lg">
            <div className="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10">
              <s.icon className="h-6 w-6 text-primary" />
            </div>
            <h3 className="mt-4 text-base font-semibold">{s.title}</h3>
            <p className="mt-2 text-sm text-muted-foreground">{s.desc}</p>
          </div>
        ))}
      </div>

      <div className="mt-12 flex justify-center">
        <WhatsAppCTA text="Falar com especialista agora" />
      </div>
    </div>
  </section>
);

export default AboutSection;
