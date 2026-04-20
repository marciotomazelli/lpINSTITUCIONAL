import { ShieldCheck, Package, Eye } from "lucide-react";

const guarantees = [
  { icon: ShieldCheck, title: "Compra segura", desc: "Pagamento protegido e dados criptografados em todas as transações." },
  { icon: Package, title: "Produtos originais", desc: "Garantia de autenticidade com rastreabilidade de lote e validade." },
  { icon: Eye, title: "Transparência total", desc: "Nota fiscal, laudos técnicos e certificados disponíveis em toda compra." },
];

const GuaranteeSection = () => (
  <section className="py-20 md:py-28">
    <div className="container mx-auto px-4">
      <div className="mx-auto max-w-2xl text-center">
        <span className="inline-block rounded-full bg-primary/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-primary">
          Garantia
        </span>
        <h2 className="mt-4 text-3xl font-bold tracking-tight md:text-4xl">
          Sua segurança é nossa prioridade
        </h2>
      </div>

      <div className="mt-16 grid gap-8 md:grid-cols-3">
        {guarantees.map((g) => (
          <div key={g.title} className="flex flex-col items-center rounded-2xl border bg-card p-8 text-center">
            <div className="flex h-14 w-14 items-center justify-center rounded-full bg-primary/10">
              <g.icon className="h-7 w-7 text-primary" />
            </div>
            <h3 className="mt-4 text-lg font-semibold">{g.title}</h3>
            <p className="mt-2 text-sm text-muted-foreground">{g.desc}</p>
          </div>
        ))}
      </div>
    </div>
  </section>
);

export default GuaranteeSection;
