import { MessageCircle } from "lucide-react";

const WHATSAPP_URL = "https://wa.me/5511999999999?text=Olá!%20Gostaria%20de%20saber%20mais%20sobre%20os%20produtos%20da%20EstéticaBio.";

const WhatsAppButton = () => (
  <a
    href={WHATSAPP_URL}
    target="_blank"
    rel="noopener noreferrer"
    className="fixed bottom-6 right-6 z-50 flex h-14 w-14 items-center justify-center rounded-full bg-whatsapp text-whatsapp-foreground shadow-lg transition-transform hover:scale-110 md:h-16 md:w-16"
    aria-label="Falar no WhatsApp"
  >
    <MessageCircle className="h-7 w-7 md:h-8 md:w-8" />
  </a>
);

export const WhatsAppCTA = ({ text = "FALAR COM ESPECIALISTA NO WHATSAPP", className = "" }: { text?: string; className?: string }) => (
  <a
    href={WHATSAPP_URL}
    target="_blank"
    rel="noopener noreferrer"
    className={`inline-flex items-center justify-center gap-2 rounded-lg bg-whatsapp px-8 py-4 text-base font-bold text-whatsapp-foreground shadow-lg transition-all hover:scale-105 hover:shadow-xl ${className}`}
  >
    <MessageCircle className="h-5 w-5" />
    {text}
  </a>
);

export default WhatsAppButton;
