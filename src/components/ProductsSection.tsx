import { Card, CardContent } from "@/components/ui/card";
import { Syringe, Sparkles, FlaskConical, Droplets } from "lucide-react";

const products = [
  {
    icon: Syringe,
    name: "Preenchedores",
    desc: "Ácido hialurônico de alta pureza com registro ANVISA para volumização e contorno facial.",
    brands: ["Rennova", "Merz", "Ilikia", "SofiDerm"],
  },
  {
    icon: Sparkles,
    name: "Bioestimuladores",
    desc: "Estimulam a produção natural de colágeno, promovendo rejuvenescimento progressivo e duradouro.",
    brands: ["Rennova", "Ilikia", "Merz"],
  },
  {
    icon: FlaskConical,
    name: "Toxina Botulínica",
    desc: "Formulações de alta precisão, com procedência garantida e rastreabilidade total de lotes.",
    brands: ["Rennova", "Merz", "Allergan"],
  },
  {
    icon: Droplets,
    name: "Dermocosméticos Profissionais e Home Care",
    desc: "Linha completa para cuidado profissional e continuidade do tratamento em casa.",
    brands: ["Samana", "SmartGr"],
  },
];

const ProductsSection = () => (
  <section id="produtos" className="bg-muted/50 py-20 md:py-28">
    <div className="container mx-auto px-4">
      <div className="mx-auto max-w-2xl text-center">
        <span className="inline-block rounded-full bg-primary/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-primary">
          Catálogo
        </span>
        <h2 className="mt-4 text-3xl font-bold tracking-tight md:text-4xl">
          Produtos com procedência e regularização
        </h2>
        <p className="mt-4 text-muted-foreground">
          Linha completa para harmonização facial — todos com registro ANVISA e nota fiscal.
        </p>
      </div>

      <div className="mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        {products.map((p) => (
          <Card key={p.name} className="group border-transparent bg-background transition-all hover:border-primary/20 hover:shadow-lg">
            <CardContent className="flex flex-col items-center p-8 text-center">
              <div className="flex h-14 w-14 items-center justify-center rounded-2xl bg-primary/10 transition-colors group-hover:bg-primary/20">
                <p.icon className="h-7 w-7 text-primary" />
              </div>
              <h3 className="mt-5 text-lg font-semibold">{p.name}</h3>
              <div className="mt-4 flex flex-wrap justify-center gap-2">
                {p.brands.map((brand) => (
                  <span
                    key={brand}
                    className="rounded-full border border-primary/20 bg-primary/5 px-3 py-1 text-xs font-medium text-primary"
                  >
                    {brand}
                  </span>
                ))}
              </div>
            </CardContent>
          </Card>
        ))}
      </div>
    </div>
  </section>
);

export default ProductsSection;
