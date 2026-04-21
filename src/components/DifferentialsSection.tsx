import { ShieldCheck, GraduationCap, Truck, HeartHandshake, ClipboardCheck, Users } from "lucide-react";

const diffs = [
  { icon: ShieldCheck, title: "Regulamentação ANVISA", desc: "100% dos produtos com registro ativo na ANVISA." },
  { icon: GraduationCap, title: "Parceria com ensino", desc: "Parcerias com instituições de ensino, atendendo alunos e professores. Venha ser nosso parceiro também" },
  { icon: Truck, title: "Entrega rápida", desc: "Logística otimizada para todo o Brasil com embalagens especiais." },
  { icon: HeartHandshake, title: "Atendimento humanizado", desc: "Relacionamento próximo e consultoria personalizada." },
  { icon: ClipboardCheck, title: "Consultoria comercial", desc: "Ajudamos você a montar o mix ideal para sua clínica." },
  { icon: Users, title: "Rede de profissionais", desc: "Comunidade de milhares de profissionais que confiam na EstéticaBio." },
];

const DifferentialsSection = () => (
  <section id="diferenciais" className="py-20 md:py-28">
    <div className="container mx-auto px-4">
      <div className="mx-auto max-w-2xl text-center">
        <span className="inline-block rounded-full bg-primary/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-primary">
          Por que a EstéticaBio?
        </span>
        <h2 className="mt-4 text-3xl font-bold tracking-tight md:text-4xl">
          Diferenciais que fazem a diferença
        </h2>
      </div>

      <div className="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        {diffs.map((d) => (
          <div key={d.title} className="flex items-start gap-4 rounded-xl border bg-card p-6 transition-shadow hover:shadow-md">
            <div className="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-primary/10">
              <d.icon className="h-5 w-5 text-primary" />
            </div>
            <div>
              <h3 className="text-sm font-semibold">{d.title}</h3>
              <p className="mt-1 text-sm text-muted-foreground">{d.desc}</p>
            </div>
          </div>
        ))}
      </div>
    </div>
  </section>
);

export default DifferentialsSection;
