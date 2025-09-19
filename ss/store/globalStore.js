// Estado global compartido entre todas las vistas
class GlobalStore {
  constructor() {
    this.tickets = [
      // Biomédicos
      { id: "BIO-001", origin: "Biomédico 2024", description: "Mantenimiento preventivo de ventilador mecánico", date: "2024-05-08", time: "14:30:07", status: "Abierto", type: "biomedicos" },
      { id: "BIO-002", origin: "Biomédico 2024", description: "Calibración de monitor de signos vitales", date: "2024-05-07", time: "10:15:30", status: "En Proceso", type: "biomedicos" },
      { id: "BIO-003", origin: "Biomédico 2024", description: "Reparación de bomba de infusión", date: "2024-05-06", time: "16:45:12", status: "Cerrado", type: "biomedicos" },
      // Industriales
      { id: "IND-001", origin: "Industrial 2024", description: "Mantenimiento de sistema de aire acondicionado", date: "2024-05-08", time: "08:00:00", status: "Abierto", type: "industriales" },
      { id: "IND-002", origin: "Industrial 2024", description: "Revisión de sistema eléctrico", date: "2024-05-07", time: "14:20:15", status: "En Proceso", type: "industriales" },
      { id: "IND-003", origin: "Industrial 2024", description: "Reparación de ascensor", date: "2024-05-06", time: "11:30:45", status: "Cerrado", type: "industriales" },
      // Transporte
      { id: "TRA-001", origin: "Transporte 2024", description: "Mantenimiento de ambulancia", date: "2024-05-08", time: "07:15:30", status: "Abierto", type: "transporte" },
      { id: "TRA-002", origin: "Transporte 2024", description: "Revisión técnico-mecánica", date: "2024-05-07", time: "13:45:20", status: "En Proceso", type: "transporte" },
      { id: "TRA-003", origin: "Transporte 2024", description: "Cambio de llantas", date: "2024-05-06", time: "09:20:10", status: "Cerrado", type: "transporte" }
    ];
    
    this.listeners = [];
  }

  subscribe(callback) {
    this.listeners.push(callback);
    return () => {
      this.listeners = this.listeners.filter(listener => listener !== callback);
    };
  }

  notify() {
    this.listeners.forEach(callback => callback(this.tickets));
  }

  getTickets() {
    return [...this.tickets];
  }

  getTicketsByType(type) {
    return this.tickets.filter(ticket => ticket.type === type);
  }

  addTicket(ticket) {
    const newTicket = {
      ...ticket,
      id: `${ticket.type.toUpperCase().slice(0,3)}-${Date.now()}`,
      date: ticket.date || new Date().toISOString().split('T')[0],
      time: ticket.time || new Date().toLocaleTimeString(),
      status: ticket.status || "Abierto"
    };
    this.tickets.push(newTicket);
    this.notify();
    return newTicket;
  }

  updateTicket(id, updates) {
    const index = this.tickets.findIndex(ticket => ticket.id === id);
    if (index !== -1) {
      this.tickets[index] = { ...this.tickets[index], ...updates };
      this.notify();
      return this.tickets[index];
    }
    return null;
  }

  deleteTicket(id) {
    const index = this.tickets.findIndex(ticket => ticket.id === id);
    if (index !== -1) {
      const deleted = this.tickets.splice(index, 1)[0];
      this.notify();
      return deleted;
    }
    return null;
  }

  getStats() {
    const total = this.tickets.length;
    const abiertos = this.tickets.filter(t => t.status === 'Abierto').length;
    const enProceso = this.tickets.filter(t => t.status === 'En Proceso').length;
    const cerrados = this.tickets.filter(t => t.status === 'Cerrado').length;
    
    return { total, abiertos, enProceso, cerrados };
  }
}

const globalStore = new GlobalStore();
export default globalStore;