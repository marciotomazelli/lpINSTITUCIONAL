import { AlertTriangle, ShieldOff, FileX, UserX } from "lucide-react";

const problems = [
  { icon: ShieldOff, title: "Produtos falsificados", desc: "Mercado inundado por produtos sem procedência, colocando a saúde dos pacientes em risco." },
  { icon: AlertTriangle, title: "Risco com vigilância sanitária", desc: "Uso de produtos irregulares pode resultar em multas, interdição e processos judiciais." },
  { icon: FileX, title: "Sem nota fiscal ou rastreabilidade", desc: "Sem documentação, você não tem como provar a procedência e se proteger legalmente." },
  { icon: UserX, title: "Perda de pacientes", desc: "Complicações por produtos de baixa qualidade destroem sua reputação profissional." },
];

const ProblemSection = () => (
  <section className="bg-foreground py-20 md:py-28">
    <div className="container mx-auto px-4">
      <div className="mx-auto max-w-2xl text-center">
        <span className="inline-block rounded-full bg-destructive/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-destructive">
          Atenção
        </span>
        <h2 className="mt-4 text-3xl font-bold tracking-tight text-background md:text-4xl">
          Você sabe realmente a origem dos produtos que está aplicando?
        </h2>
        <p className="mt-4 text-muted/80">
          Muitos profissionais correm riscos desnecessários sem saber.
        </p>
      </div>

      <div className="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        {problems.map((p) => (
          <div key={p.title} className="rounded-2xl border border-muted/20 bg-muted/5 p-6 text-center">
            <div className="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-destructive/10">
              <p.icon className="h-6 w-6 text-destructive" />
            </div>
            <h3 className="mt-4 text-sm font-semibold text-background">{p.title}</h3>
            <p className="mt-2 text-xs leading-relaxed text-muted/70">{p.desc}</p>
          </div>
        ))}
      </div>
    </div>
  </section>
);

export default ProblemSection;
