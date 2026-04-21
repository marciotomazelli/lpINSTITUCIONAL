import { useState } from "react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "@/components/ui/table";
import { useToast } from "@/hooks/use-toast";
import { MessageCircle, Trash2 } from "lucide-react";

type Lead = {
  id: number;
  name: string;
  email: string;
  phone: string;
  specialty: string;
  message: string;
  status: string;
  created_at: string;
};

const STATUS_OPCOES = ["Novo", "Em Contato", "Fechado"];

const Crm = () => {
  const [password, setPassword] = useState("");
  const [isAuthenticated, setIsAuthenticated] = useState(false);
  const [leads, setLeads] = useState<Lead[]>([]);
  const [loading, setLoading] = useState(false);
  const { toast } = useToast();

  const handleLogin = async (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);
    
    try {
      const response = await fetch("/apicrmesteticabio/get_leads.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ password }),
      });
      
      const data = await response.json();
      
      if (data.status === "success") {
        setIsAuthenticated(true);
        setLeads(data.data);
      } else {
        toast({
          title: "Acesso negado",
          description: data.message || "Senha incorreta",
          variant: "destructive",
        });
      }
    } catch (error) {
      toast({
        title: "Erro de conexão",
        description: "Servidor não respondeu.",
        variant: "destructive",
      });
    } finally {
      setLoading(false);
    }
  };

  const refreshLeads = async () => {
    try {
      const response = await fetch("/apicrmesteticabio/get_leads.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ password }),
      });
      const data = await response.json();
      if (data.status === "success") {
        setLeads(data.data);
      }
    } catch (error) {
      console.error(error);
    }
  };

  const handleDelete = async (id: number) => {
    if (!window.confirm("Certeza que deseja excluir este Lead?")) return;
    
    try {
      const response = await fetch("/apicrmesteticabio/delete_lead.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ password, id }),
      });
      const data = await response.json();
      
      if (data.status === "success") {
        setLeads((prev) => prev.filter(l => l.id !== id));
        toast({ title: "Excluído", description: "O lead foi apagado definitivamente." });
      } else {
        toast({ title: "Erro", description: "Não foi possível excluir", variant: "destructive" });
      }
    } catch (error) {
      console.error(error);
    }
  };

  const handleStatusChange = async (id: number, newStatus: string) => {
    // Atualiza localmente para rapidez
    setLeads((prev) => prev.map((l) => l.id === id ? { ...l, status: newStatus } : l));
    
    try {
      const response = await fetch("/apicrmesteticabio/update_status.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ password, id, status_text: newStatus }),
      });
      const data = await response.json();
      if (data.status !== "success") {
        refreshLeads(); // reverte se falhar
        toast({ title: "Erro", description: "Falha ao salvar status", variant: "destructive" });
      }
    } catch (error) {
      refreshLeads();
    }
  };

  const openWhatsApp = (phone: string, name: string) => {
    if (!phone) return;
    // limpa tudo que não for número
    let limpo = phone.replace(/\D/g, "");
    
    // Se digitou sem DDI (ex: 1699999999), adiciona o 55
    if (limpo.length <= 11) {
      limpo = "55" + limpo;
    }
    
    const text = encodeURIComponent(`Olá ${name}, vi que buscou contato com a EstéticaBio...`);
    window.open(`https://wa.me/${limpo}?text=${text}`, "_blank");
  };

  if (!isAuthenticated) {
    return (
      <div className="flex min-h-screen items-center justify-center bg-muted/50 p-4">
        <form onSubmit={handleLogin} className="w-full max-w-sm rounded-xl border bg-background p-8 shadow-sm">
          <div className="mb-6 text-center">
            <h1 className="text-2xl font-bold tracking-tight">EstéticaBio CRM</h1>
            <p className="text-sm text-muted-foreground">Insira a senha para acessar os leads</p>
          </div>
          <div className="flex flex-col gap-4">
            <Input
              type="password"
              placeholder="Senha de acesso"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              disabled={loading}
              autoFocus
            />
            <Button type="submit" className="w-full" disabled={loading}>
              {loading ? "Acessando..." : "Entrar"}
            </Button>
          </div>
        </form>
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-muted/20 p-4 md:p-8">
      <div className="mx-auto max-w-7xl">
        <div className="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
          <div>
            <h1 className="text-3xl font-bold tracking-tight">Painel de Leads</h1>
            <p className="text-muted-foreground">Gerencie os contatos recebidos pelo site</p>
          </div>
          <div className="flex gap-2">
             <Button onClick={() => window.location.href = '/'} variant="outline">Ir pro Site</Button>
             <Button onClick={refreshLeads}>Atualizar</Button>
          </div>
        </div>

        <div className="rounded-xl border bg-background shadow-sm overflow-hidden">
          {leads.length === 0 ? (
            <div className="p-8 text-center text-muted-foreground">Nenhum lead encontrado ainda.</div>
          ) : (
            <div className="overflow-x-auto">
              <Table>
                <TableHeader>
                  <TableRow>
                    <TableHead>Data</TableHead>
                    <TableHead>Contato</TableHead>
                    <TableHead>Especialidade</TableHead>
                    <TableHead>Mensagem</TableHead>
                    <TableHead>Status</TableHead>
                    <TableHead className="text-right">Ação</TableHead>
                  </TableRow>
                </TableHeader>
                <TableBody>
                  {leads.map((lead) => (
                    <TableRow key={lead.id}>
                      <TableCell className="whitespace-nowrap text-muted-foreground">
                        {new Date(lead.created_at).toLocaleDateString("pt-BR", {
                          day: "2-digit",
                          month: "2-digit",
                          hour: "2-digit",
                          minute: "2-digit",
                        })}
                      </TableCell>
                      <TableCell>
                        <div className="font-medium">{lead.name}</div>
                        <div className="text-xs text-muted-foreground">{lead.email}</div>
                        <div className="text-xs text-muted-foreground mt-1">{lead.phone || "S/ Número"}</div>
                      </TableCell>
                      <TableCell>{lead.specialty}</TableCell>
                      <TableCell className="max-w-xs truncate" title={lead.message}>
                        {lead.message}
                      </TableCell>
                      <TableCell>
                        <select
                          value={lead.status || "Novo"}
                          onChange={(e) => handleStatusChange(lead.id, e.target.value)}
                          className="rounded border border-input bg-background px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-ring"
                        >
                          {STATUS_OPCOES.map((opt) => (
                            <option key={opt} value={opt}>{opt}</option>
                          ))}
                        </select>
                      </TableCell>
                      <TableCell className="text-right">
                        <div className="flex items-center justify-end gap-2">
                          {lead.phone && (
                            <Button
                              size="icon"
                              variant="outline"
                              className="h-8 w-8 text-whatsapp border-whatsapp hover:bg-whatsapp hover:text-white"
                              title="Chamar no WhatsApp"
                              onClick={() => openWhatsApp(lead.phone, lead.name)}
                            >
                              <MessageCircle className="h-4 w-4" />
                            </Button>
                          )}
                          <Button
                            size="icon"
                            variant="outline"
                            className="h-8 w-8 text-destructive hover:bg-destructive hover:text-white border-destructive/50"
                            title="Apagar Lead"
                            onClick={() => handleDelete(lead.id)}
                          >
                            <Trash2 className="h-4 w-4" />
                          </Button>
                        </div>
                      </TableCell>
                    </TableRow>
                  ))}
                </TableBody>
              </Table>
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

export default Crm;
