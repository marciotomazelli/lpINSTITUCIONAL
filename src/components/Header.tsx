import { useState } from "react";
import { Menu, X, MessageCircle } from "lucide-react";
import { Button } from "@/components/ui/button";
import logo from "@/assets/logo-esteticabio.png";

const navLinks = [
  { label: "Sobre", href: "#sobre" },
  { label: "Produtos", href: "#produtos" },
  { label: "Diferenciais", href: "#diferenciais" },
  { label: "Depoimentos", href: "#depoimentos" },
  { label: "Contato", href: "#contato" },
];

const Header = () => {
  const [menuOpen, setMenuOpen] = useState(false);

  return (
    <header className="sticky top-0 z-50 border-b bg-background/80 backdrop-blur-md">
      <div className="container mx-auto flex h-16 items-center justify-between px-4">
        <a href="#" className="flex items-center">
          <img src={logo} alt="EstéticaBio" className="h-10" />
        </a>

        <nav className="hidden items-center gap-6 lg:flex">
          {navLinks.map((l) => (
            <a
              key={l.href}
              href={l.href}
              className="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground"
            >
              {l.label}
            </a>
          ))}
          <Button size="sm" className="bg-whatsapp text-whatsapp-foreground hover:bg-whatsapp/90" asChild>
            <a href="https://wa.me/5516991232051" target="_blank" rel="noopener noreferrer">
              <MessageCircle className="mr-1 h-4 w-4" /> WhatsApp
            </a>
          </Button>
        </nav>

        <button className="lg:hidden" onClick={() => setMenuOpen(!menuOpen)} aria-label="Menu">
          {menuOpen ? <X className="h-6 w-6" /> : <Menu className="h-6 w-6" />}
        </button>
      </div>

      {menuOpen && (
        <nav className="flex flex-col gap-4 border-t bg-background px-4 py-6 lg:hidden">
          {navLinks.map((l) => (
            <a
              key={l.href}
              href={l.href}
              onClick={() => setMenuOpen(false)}
              className="text-sm font-medium text-muted-foreground transition-colors hover:text-foreground"
            >
              {l.label}
            </a>
          ))}
          <Button size="sm" className="bg-whatsapp text-whatsapp-foreground hover:bg-whatsapp/90" asChild>
            <a href="https://wa.me/5516991232051" target="_blank" rel="noopener noreferrer" onClick={() => setMenuOpen(false)}>
              <MessageCircle className="mr-1 h-4 w-4" /> WhatsApp
            </a>
          </Button>
        </nav>
      )}
    </header>
  );
};

export default Header;
