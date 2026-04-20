import logo from "@/assets/logo-esteticabio.png";

const Footer = () => (
  <footer className="border-t bg-foreground py-12">
    <div className="container mx-auto flex flex-col items-center gap-6 px-4 text-center md:flex-row md:justify-between md:text-left">
      <div>
        <img src={logo} alt="EstéticaBio" className="h-10 brightness-0 invert" />
        <p className="mt-1 text-xs text-muted/70">
          Distribuidora de produtos para estética avançada. Segurança e procedência garantida.
        </p>
      </div>

      <nav className="flex flex-wrap justify-center gap-6 text-sm text-muted/70">
        <a href="#sobre" className="hover:text-background">Sobre</a>
        <a href="#produtos" className="hover:text-background">Produtos</a>
        <a href="#diferenciais" className="hover:text-background">Diferenciais</a>
        <a href="#depoimentos" className="hover:text-background">Depoimentos</a>
        <a href="#contato" className="hover:text-background">Contato</a>
      </nav>

      <p className="text-xs text-muted/50">
        © {new Date().getFullYear()} EstéticaBio. Todos os direitos reservados.
      </p>
    </div>
  </footer>
);

export default Footer;
