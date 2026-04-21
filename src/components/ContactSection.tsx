import { useState } from "react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Textarea } from "@/components/ui/textarea";
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from "@/components/ui/select";
import { MessageCircle, Mail, Phone, MapPin } from "lucide-react";
import { useToast } from "@/hooks/use-toast";

const ADDRESS_LINE = "Rua Carlos Gomes, 1839 — Centro, Sertãozinho/SP — CEP 14160-530";
const MAPS_EMBED_URL =
  "https://www.google.com/maps?q=Rua+Carlos+Gomes+1839+Centro+Sertaozinho+SP+14160-530&output=embed";
const MAPS_LINK_URL =
  "https://www.google.com/maps/search/?api=1&query=Rua+Carlos+Gomes+1839+Centro+Sertaozinho+SP+14160-530";

const ContactSection = () => {
  const { toast } = useToast();
  const [loading, setLoading] = useState(false);
  const [formData, setFormData] = useState({
    name: "",
    email: "",
    phone: "+55 ",
    specialty: "",
    message: "",
  });

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    
    if (!formData.name) {
      toast({
        title: "Campo obrigatório",
        description: "Por favor, preencha o seu nome.",
        variant: "destructive",
      });
      return;
    }

    setLoading(true);

    try {
      const response = await fetch("/apicrmesteticabio/save_lead.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(formData),
      });

      const data = await response.json();

      if (data?.status === "success") {
        toast({
          title: "Mensagem enviada!",
          description: "Obrigado pelo contato. Retornaremos em breve.",
        });
        setFormData({ name: "", email: "", phone: "+55 ", specialty: "", message: "" });
      } else {
        toast({
          title: "Erro no envio",
          description: "Houve um erro ao enviar sua mensagem. Tente novamente.",
          variant: "destructive",
        });
      }
    } catch (error) {
      toast({
        title: "Erro de conexão",
        description: "Não foi possível conectar ao servidor.",
        variant: "destructive",
      });
    } finally {
      setLoading(false);
    }
  };

  return (
    <section id="contato" className="bg-muted/50 py-20 md:py-28">
      <div className="container mx-auto px-4">
        <div className="mx-auto max-w-2xl text-center">
          <h2 className="text-3xl font-bold tracking-tight md:text-4xl">
            Fale com a EstéticaBio
          </h2>
          <p className="mt-4 text-muted-foreground">
            Solicite uma cotação ou tire suas dúvidas. Respondemos em até 2 horas úteis.
          </p>
        </div>

        <div className="mx-auto mt-16 grid max-w-4xl gap-12 md:grid-cols-2">
          <form className="flex flex-col gap-4" onSubmit={handleSubmit}>
            <Input 
              placeholder="Seu nome" 
              value={formData.name}
              onChange={(e) => setFormData({ ...formData, name: e.target.value })}
              required
            />
            <Input 
              type="email" 
              placeholder="Seu e-mail" 
              value={formData.email}
              onChange={(e) => setFormData({ ...formData, email: e.target.value })}
            />
            <Input 
              type="tel" 
              placeholder="DDI + DDD + Seu WhatsApp..." 
              value={formData.phone}
              onChange={(e) => setFormData({ ...formData, phone: e.target.value })}
            />
            <Select value={formData.specialty} onValueChange={(val) => setFormData({ ...formData, specialty: val })}>
              <SelectTrigger>
                <SelectValue placeholder="Sua especialidade" />
              </SelectTrigger>
              <SelectContent>
                <SelectItem value="Biomédico">Biomédico</SelectItem>
                <SelectItem value="Farmacêutico">Farmacêutico</SelectItem>
                <SelectItem value="Dentista">Dentista</SelectItem>
                <SelectItem value="Enfermeiro">Enfermeiro</SelectItem>
                <SelectItem value="Médico">Médico</SelectItem>
                <SelectItem value="Esteticista">Esteticista</SelectItem>
                <SelectItem value="Biólogo">Biólogo</SelectItem>
                <SelectItem value="Fisioterapeuta">Fisioterapeuta</SelectItem>
                <SelectItem value="Outras Especialidades">Outras Especialidades</SelectItem>
              </SelectContent>
            </Select>
            <Textarea 
              placeholder="Sua mensagem ou produtos de interesse" 
              className="min-h-[120px]" 
              value={formData.message}
              onChange={(e) => setFormData({ ...formData, message: e.target.value })}
            />
            <Button type="submit" size="lg" disabled={loading}>
              {loading ? "Enviando..." : "Enviar Mensagem"}
            </Button>
          </form>

          <div className="flex flex-col justify-center gap-6">
            <div className="flex items-start gap-4">
              <div className="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-primary/10">
                <MapPin className="h-5 w-5 text-primary" />
              </div>
              <div>
                <p className="text-sm font-semibold">Endereço</p>
                <a
                  href={MAPS_LINK_URL}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="text-sm text-muted-foreground hover:text-primary"
                >
                  {ADDRESS_LINE}
                </a>
              </div>
            </div>

            <div className="flex items-start gap-4">
              <div className="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-primary/10">
                <Mail className="h-5 w-5 text-primary" />
              </div>
              <div>
                <p className="text-sm font-semibold">E-mail</p>
                <p className="text-sm text-muted-foreground">contato@esteticabio.com.br</p>
              </div>
            </div>

            <div className="flex items-start gap-4">
              <div className="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-primary/10">
                <Phone className="h-5 w-5 text-primary" />
              </div>
              <div>
                <p className="text-sm font-semibold">Telefone</p>
                <p className="text-sm text-muted-foreground">(16) 3524-1764</p>
              </div>
            </div>

            <div className="flex items-start gap-4">
              <div className="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-whatsapp/10">
                <MessageCircle className="h-5 w-5 text-whatsapp" />
              </div>
              <div>
                <p className="text-sm font-semibold">WhatsApp</p>
                <a
                  href="https://wa.me/5516991232051"
                  target="_blank"
                  rel="noopener noreferrer"
                  className="text-sm font-semibold text-whatsapp underline-offset-4 hover:underline"
                >
                  Falar com especialista agora
                </a>
              </div>
            </div>
          </div>
        </div>

        {/* Mapa com endereço */}
        <div className="mx-auto mt-16 max-w-5xl overflow-hidden rounded-2xl border bg-background shadow-sm">
          <iframe
            src={MAPS_EMBED_URL}
            title="Localização da EstéticaBio no Google Maps"
            width="100%"
            height="420"
            style={{ border: 0 }}
            loading="lazy"
            referrerPolicy="no-referrer-when-downgrade"
            allowFullScreen
          />
        </div>
      </div>
    </section>
  );
};

export default ContactSection;
